<?php

use Modules\Gateway\Entities\GatewayModule;

function getPaymentGateways($addons)
{
    $gateways = array();

    foreach ($addons as $addon) {
        if ($addon->get('gateway')) {
            $gateways[] = $addon;
        }
    }

    return $gateways;
}


function moduleAvailable($name)
{
    try {
        return (GatewayModule::findOrFail($name))->isEnabled();
    } catch (\Exception $e) {
        return false;
    }
}


function paymentLog($e)
{
    Log::channel('payment')->error($e);
}

if (!function_exists('convert_currency')) {
    /**
     * Convert the currency
     */
    function convert_currency($from, $to, $amount)
    {
        return $amount;
    }
}

if (!function_exists('commaStringArray')) {
    function commaStringArray($string, $keepSpace = true)
    {
        if (!$keepSpace) {
            $string = str_replace(" ", "", $string);
        } else {
            $string = trim($string);
        }

        $array = array_filter(explode(",", $string));
        return array_map('trim', $array);
    }
}

if (!function_exists('arrayCommaString')) {
    function arrayCommaString($array, $delimiter = ",")
    {
        return implode($delimiter, $array);
    }
}

if (!function_exists('getValueForForm')) {
    function getValueForForm($module, $name)
    {
        if (isset($module) && isset($module->$name)) {
            if (is_array($module->$name)) {
                return arrayCommaString($module->$name);
            } else {
                return $module->$name;
            }
        }
        return null;
    }
}

if (!function_exists('bdcrypt')) {
    function bdcrypt($string)
    {
        return base64_decode($string);
    }
}

if (!function_exists('bncrypt')) {
    function bncrypt($string)
    {
        return base64_encode($string);
    }
}
