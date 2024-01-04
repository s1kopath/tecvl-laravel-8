<?php

namespace Modules\Addons\Entities;

use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\Artisan;
use Modules\Addons\Entities\Addon;

class AddonManager
{
        
    /**
     * upload
     *
     * @param  request $addonZip
     * @return collection
     */
    public static function upload($addonZip)
    {
        if (!class_exists('ZipArchive')) {
            return false;
        }

        $zipped_file_name = pathinfo($addonZip->getClientOriginalName(), PATHINFO_FILENAME);
        
        $zip = new ZipArchive;
        $res = $zip->open($addonZip);

        if ($res === true) {
            $res = $zip->extractTo(base_path('Modules'));
            $zip->close();
        }

        self::migrateAndSeed($zipped_file_name);

        return Addon::findOrFail($zipped_file_name);
    }
    
    /**
     * migrateAndSedd
     *
     * @param  mixed $name
     * @return void
     */
    protected static function migrateAndSeed($name)
    {
        Artisan::call('module:migrate-rollback ' . $name);
        Artisan::call('module:migrate ' . $name);
        Artisan::call('module:seed ' . $name);
    }
}
