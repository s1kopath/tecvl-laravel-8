<?php

namespace Modules\CMS\Utility;

use Illuminate\Support\Facades\Facade;

class CMSUtility extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CMSUtility';
    }
}
