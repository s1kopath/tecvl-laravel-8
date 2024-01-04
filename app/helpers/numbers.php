<?php

use App\Models\Currency;


if (!function_exists('formatCurrencyAmount')) {
    function formatCurrencyAmount($value)
    {
        if (!is_int($value)) {
            $array = explode('.', $value);
            $value = substr($value, 0, (strlen($array[0]) + 1 + preference('decimal_digits')));
        }
        if (preference('thousand_separator') == ".") {
            return number_format((float) $value, preference('decimal_digits'), ',', '.');
        } else {
            return number_format((float) $value, preference('decimal_digits'), '.', ',');
        }
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($value, $symbol = null)
    {
        $amount = formatCurrencyAmount($value);
        if (empty($symbol)) {
            $symbol = Currency::getAll()->where('id', preference('dflt_currency_id'))->first()->symbol;
        }
        if (preference('symbol_position') == 'before') {
            return $symbol . $amount;
        }
        return $amount . $symbol;
    }
}


if (!function_exists('validateNumbers')) {
    function validateNumbers($number)
    {
        if (preference('thousand_separator') == ".") {
            $number = str_replace(".", "", $number);
        } else {
            $number = str_replace(",", "", $number);
        }
        $number = floatval(str_replace(",", ".", $number));
        return $number;
    }
}


if (!function_exists('getCurrencyRate')) {
    /**
     * Currency Conversion
     * @param  string $from
     * @param  string $to
     * @param  object $service
     * @return float
     */
    function getCurrencyRate($from = null, $to = null, $service = null)
    {
        if (isset($service->slug) && $service->slug == "exchange_rate_api" && isset($service->api_key)) {
            return exchangeRateApi($from, $to, $service->api_key);
        } else if (isset($service->slug) && $service->slug == "currency_converter_api" && isset($service->api_key)) {
            return currencyConverterApi($from, $to, $service->api_key);
        }
    }
}

if (!function_exists('exchangeRateApi')) {
    /**
     * Call Exchange Rate Api
     * @param  string $from
     * @param  string $to
     * @param  string $apiKey
     * @return float
     */
    function exchangeRateApi($from = null, $to = null, $apiKey = null)
    {
        // Fetching JSON
        $req_url = 'https://v6.exchangerate-api.com/v6/' . $apiKey . '/latest/' . $from;

        $response_json = file_get_contents($req_url);
        // Continuing if we got a result
        if (false !== $response_json) {
            // Decoding
            $response = json_decode($response_json, true);
            // Check for success
            if ('success' === $response['result']) {
                return $response['conversion_rates'][$to];
            }
        }
    }
}

if (!function_exists('currencyConverterApi')) {
    /**
     * Call Currency Converter Api
     * @param  string $from
     * @param  string $to
     * @param  string $apiKey
     * @return float
     */
    function currencyConverterApi($from = null, $to = null, $apiKey = null)
    {
        $url = "https://free.currconv.com/api/v7/convert?q=$from" . "_" . "$to&compact=ultra&apiKey=" . $apiKey;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        $variable = $from . "_" . $to;
        return json_decode($result)->$variable;
    }
}
