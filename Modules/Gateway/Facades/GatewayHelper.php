<?php

namespace Modules\Gateway\Facades;

use Illuminate\Support\Facades\Facade;

class GatewayHelper extends Facade
{
    /**
     * Cart alias
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'GatewayHelper';
    }
}
