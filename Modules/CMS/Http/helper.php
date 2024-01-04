<?php

if (!function_exists('getComponentProperties')) {
    /**
     * Get component properties in associative array
     * @param $component
     * @return boolean|array
     */
    function getComponentProperties($component)
    {
        if (!$component) {
            return false;
        }
        $array = [];
        if ($component && $component->properties) {
            foreach ($component->properties as $item) {
                $array[$item->name] = $item->value;
            }
        }
        return $array;
    }
}

if (!function_exists('hasAnotherSlider')) {
    /**
     * It checks if the current component has another slider
     * @param array $data Component data
     * @param int $index Index of next slider
     * @return mixed
     */
    function hasAnotherSlider($data, $index)
    {
        if (isset($data['title_slider' . $index])) {
            return $data['title_slider' . $index];
        }
        return false;
    }
}

if (!function_exists('builderGetValue')) {
    /**
     * Get value from given array
     * @param array $array
     * @param string $key
     * @param mixed $return
     * @return mixed
     */
    function builderGetValue($data, $key, $return = null)
    {
        if ($data && isset($data[$key]) && $data[$key]) {
            return $data[$key];
        }
        return $return;
    }
}

if (!function_exists('hasAnotherItem')) {
    /**
     * Check if has another item similar to a specific item
     * @param array $data
     * @param string $field Name of the item we are checking
     * @param int $index Next item number
     * @return mixed
     */
    function hasAnotherItem($data, $field, $index)
    {
        if (isset($data) && isset($data[$field . $index])) {
            return $data[$field . $index];
        }
        return false;
    }
}

if (!function_exists('totalSimilarItems')) {
    /**
     * Check how many similar items are in the same section
     * @param array $data
     * @param string $field Basic field name
     * @return int|boolean
     */
    function totalSimilarItems($data, $field)
    {
        if (!isset($data)) {
            return false;
        }
        $count = 0;
        while (true) {
            if (!isset($data[$field . ($count + 1)])) {
                break;
            }
            $count++;
        }
        return $count;
    }
}

if (!function_exists('componentValue')) {
    /**
     * Get property of given component
     *
     * @param \Modules\CMS\Entities\Component $component The component of which you want the property
     * @param String $name Name of the field
     * @param mixed $return what the function should return in case no data found
     *
     * @return mixed
     */
    function componentValue($component, $name, $return = null)
    {
        if ($component) {
            $property = $component->properties->firstWhere('name', $name);
            if ($property && $property->value) {
                return $property->value;
            }
        }
        return $return;
    }
}


if (!function_exists('randomString')) {
    /**
     * Generate random string
     * @param int $length
     * @return string
     */
    function randomString($length = 5)
    {
        return substr(str_shuffle('examghfgh786868plestringletsgo'), 0, $length);
    }
}


if (!function_exists('slugMe')) {
    /**
     * Slugify string
     * @param string|array $string
     * $return $string
     */
    function slugMe($string)
    {
        if (is_array($string)) {
            $slug = '';
            foreach ($string as $str) {
                $slug .= slugMe($str) . '-';
            }
            return $slug;
        }
        return str_replace(" ", "-", $string);
    }
}


if (!function_exists('getBlockThumbnail')) {
    /**
     * Get block thumbnail
     * @param string $file
     * @return string
     */
    function getBlockThumbnail($file = '')
    {
        if (strlen($file) < 1) {
            return join('/', [url('/'), defaultImage('items')]);
        }
        return asset('Modules/CMS/Resources/assets/img/blocks/' . $file);
    }
}


if (!function_exists('formatString')) {
    /**
     * Format string to a specific length
     * @param string $string
     * @param int $length
     * @return string
     */
    function formatString($string, $length = 75)
    {
        if (strlen($string) <= $length) {
            return $string;
        }
        return substr($string, 0, $length - 3) . '...';
    }
}
