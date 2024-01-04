<?php
/**
 * @package Compare
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 11-01-2022
 */
namespace App\Compare;
use Cache;
use Auth;

class Compare
{
    /**
     * add compare data
     *
     * @param $itemId
     * @return bool|void
     */
    public static function add($itemId)
    {
        $compare = self::getCompareData();
        if (!$compare) {
            $compare[] = $itemId;
            self::save($compare);
            return true;
        } elseif (!in_array($itemId, $compare)) {
            $compare[] = $itemId;
            self::save($compare);
            return true;
        }
    }

    /**
     * save compare data
     *
     * @param $compare
     * @return void
     */
    public static function save($compare)
    {
        if (isset(Auth::user()->id)) {
            Cache::put(config('cache.prefix') . '.compare.'.Auth::user()->id, $compare, 30 * 86400);
        } else {
            Cache::put(config('cache.prefix') . '.compare.'.getUniqueAddress(), $compare, 30 * 86400);
        }
    }

    /**
     * getCompare data
     *
     * @return mixed
     */
    public static function getCompareData()
    {
        return isset(Auth::user()->id) ? Cache::get(config('cache.prefix') . '.compare.'.Auth::user()->id) : Cache::get(config('cache.prefix') . '.compare.'.getUniqueAddress());
    }

    /**
     * compare data in collection method
     *
     * @return CompareCollection
     */
    public static function compareCollection()
    {
        return isset(Auth::user()->id) ? new CompareCollection(Cache::get(config('cache.prefix') . '.compare.'.Auth::user()->id)) : new CompareCollection(Cache::get(config('cache.prefix') . '.compare.'.getUniqueAddress()));
    }

    /**
     * total CompareData
     *
     * @return int
     */
    public static function totalItem()
    {
        $compare = self::compareCollection();
        return $compare->count();
    }

    /**
     * compare data destroy
     *
     * @param $id
     * @param $action
     * @return bool
     */
    public static function destroy($id, $action = 'single')
    {
        if ($action == 'single') {
            $compare = self::getCompareData();
            $index = array_search($id, $compare);
            unset($compare[$index]);
            self::save($compare);
        } else {
            isset(Auth::user()->id) ? Cache::forget(config('cache.prefix') . '.compare.'.Auth::user()->id) :  Cache::forget(config('cache.prefix') . '.compare.'.getUniqueAddress());
        }
        return true;
    }

    /**
     * compare data transfer local to user
     */
    public static function compareDataTransfer()
    {
        if (isset(Auth::user()->id) && empty(Cache::get(config('cache.prefix') . '.compare.'.Auth::user()->id))) {
            if (!empty(Cache::get(config('cache.prefix') . '.compare.'.getUniqueAddress()))) {
                Cache::put(config('cache.prefix') . '.compare.'.Auth::user()->id, Cache::get(config('cache.prefix') . '.compare.'.getUniqueAddress()), 30 * 86400);
            }
        } elseif (isset(Auth::user()->id) && !empty(Cache::get(config('cache.prefix') . '.compare.'.Auth::user()->id)) && !empty(Cache::get(config('cache.prefix') . '.compare.'.getUniqueAddress()))) {
            $userCompareList = Cache::get(config('cache.prefix') . '.compare.'.Auth::user()->id);
            foreach (Cache::get(config('cache.prefix') . '.compare.'.getUniqueAddress()) as $local) {
                if (!in_array($local, $userCompareList)) {
                    self::add($local);
                }
            }
            Cache::forget(config('cache.prefix') . '.compare.'.getUniqueAddress());
            Cache::put(config('cache.prefix') . '.compare.'.getUniqueAddress(), Cache::get(config('cache.prefix') . '.compare.'.Auth::user()->id), 30 * 86400);
        }
    }
}
