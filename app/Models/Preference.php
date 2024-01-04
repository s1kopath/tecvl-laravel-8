<?php

/**
 * @package Preference
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @created 20-05-2021
 */

namespace App\Models;

use App\Models\Model;
use App\Rules\{
    CheckDateFormat,
    CheckDefaultTimeZone,
    CheckThousandSeparator,
    CheckValidEmail,
    CheckValidFile,
    CheckValidPhone
};
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;
use Cache;
use Modules\MediaManager\Http\Models\ObjectFile;
use Validator;

class Preference extends Model
{
    use ModelTrait, hasFiles;
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;
    protected $fillable = ['category', 'field', 'value'];

    /**
     * Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function validation($data = [])
    {
        $rules = [
            'row_per_page' => 'required|in:10,25,50,100',
            'date_sepa' => 'required|in:-,/,.',
            'decimal_digits' => 'required|in:1,2,3,4,5,6,7,8',
            'file_size' => 'required|integer|min:0|max:20',
            'symbol_position' => 'required|in:before,after',
            'thousand_separator' => ['required', new CheckThousandSeparator],
            'default_timezone' => ['required', new CheckDefaultTimeZone],
            'date_format' => ['required', new CheckDateFormat],
        ];
        return Validator::make($data, $rules);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected static function companySettingValidation($data = [])
    {
        $validator = Validator::make($data, [
            'company_name' => 'required|max:500',
            'site_short_name' => 'required|max:500',
            'company_email' => ['required', 'email', new CheckValidEmail],
            'company_phone' => ['required', 'min:10', 'max:45', new CheckValidPhone],
            'company_tax_id' => 'required|max:500',
            'company_street' => 'required|max:500',
            'company_city' => 'required|max:500',
            'company_state' => 'required|max:500',
            'company_zip_code' => 'required|max:500',
            'company_country' => 'required|max:500|exists:countries,id',
            'dflt_lang' => 'required|max:500|exists:languages,short_name',
            'dflt_currency_id' => 'required|max:500|exists:currencies,id',
            'company_logo' => ['nullable', new CheckValidFile(getFileExtensions(3))],
            'company_icon' => ['nullable', new CheckValidFile(getFileExtensions(4))],
        ]);

        return $validator;
    }

    /**
     * Store or Update
     * @param  array $data
     * @return boolean
     */
    public function storeOrUpdate($data = [])
    {

        if (parent::updateOrInsert(['category' => $data['category'], 'field' => $data['field']], $data)) {
            if (!empty(request()->file_id)) {
                foreach (request()->file_id as $key => $value) {
                    if ($value == request()->company_icon_id) {
                        $result = parent::where('field', 'company_icon');
                    } else {
                        $result = parent::where('field', 'company_logo');
                    }
                    request()->file_id = [$value];
                    $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
                }
            }

            self::forgetCache();
            Cache::forget(config('cache.prefix') . '-defaultCurrency');
            return true;
        }

        return false;
    }

    public function deleteFile($field = null, $category = null, $folder = null, $data = null)
    {
        $record = Preference::getAll()
            ->where('category', $category)
            ->where('field', $field)
            ->first();
        if (!empty($record)) {
            $record->value = '';
            $record->save();
            self::forgetCache();
            if (!empty($data) && !empty($folder)) {
                $dir = public_path("uploads/" . $folder . "/" . $data);
                if (file_exists($dir)) {
                    unlink($dir);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Get the specified option value.
     * If field not found default will return
     *
     * @param  string  $field
     * @param  mixed   $default
     * @return mixed
     */
    public function get($field, $default = null)
    {
        if ($preference = self::getAll()->where('field', $field)->first()) {
            return $preference->value;
        }

        return $default;
    }

    /**
     * Set a given option value.
     *
     * @param  array|string  $field
     * @param  mixed   $value
     * @return void
     */
    public function set($field, $value = null)
    {
        $fields = is_array($field) ? $field : [$field => $value];

        foreach ($fields as $field => $value) {
            if (is_array($value)) {
                foreach ($value as $sField => $sValue) {
                    self::updateOrCreate(['field' => $sField], ['category' => $field, 'field' => $sField, 'value' => $sValue]);
                }
            } else {
                self::updateOrCreate(['field' => $field], ['value' => $value]);
            }

            self::forgetCache();
            Cache::forget(config('cache.prefix') . '-defaultCurrency');
        }
    }
}
