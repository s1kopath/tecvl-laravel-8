<?php
/**
 * @package CheckDuplicateItem
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 17-10-2021
 */
namespace App\Rules;

use App\Models\{Item, ItemCrossSale, ItemRelate, ItemUpsale};
use Illuminate\Contracts\Validation\Rule;

class CheckDuplicateItem implements Rule
{
    protected $type;
    protected $itemId;
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type = null, $itemId = null)
    {
        $this->type = $type;
        $this->itemId = $itemId;
        $this->message = __('Duplicate :x entry error!', ['x' => __('Item')]);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $allData = [];
        if ($this->type == 'relate') {
            $relatedItem = ItemRelate::getAll()->where('item_id', $this->itemId)->pluck('related_item_id')->toArray();
            foreach ($value as $item) {
                if (!in_array($item, $allData) && !in_array($item, $relatedItem)) {
                    $itemExist = Item::where("id", $item);
                    if ($item == $this->itemId || !$itemExist->exists()) {
                        $this->message = __('Invalid :x', ['x' => __('Item')]);
                        return false;
                    }
                    $allData[] = $item;
                    continue;
                } else {
                    return false;
                }
            }
        } elseif ($this->type == 'cross') {
            $crossItem = ItemCrossSale::getAll()->where('item_id', $this->itemId)->pluck('cross_sale_item_id')->toArray();
            foreach ($value as $item) {
                if (!in_array($item, $allData) && !in_array($item, $crossItem)) {
                    $itemExist = Item::where("id", $item);
                    if ($item == $this->itemId || !$itemExist->exists()) {
                        $this->message = __('Invalid :x', ['x' => __('Item')]);
                        return false;
                    }
                    $allData[] = $item;
                    continue;
                } else {
                    return false;
                }
            }
        } elseif ($this->type == 'up') {
            $upSaleItem = ItemUpsale::getAll()->where('item_id', $this->itemId)->pluck('upsale_item_id')->toArray();
            foreach ($value as $item) {
                if (!in_array($item, $allData) && !in_array($item, $upSaleItem)) {
                    $itemExist = Item::where("id", $item);
                    if ($item == $this->itemId || !$itemExist->exists()) {
                        $this->message = __('Invalid :x', ['x' => __('Item')]);
                        return false;
                    }
                    $allData[] = $item;
                    continue;
                } else {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
