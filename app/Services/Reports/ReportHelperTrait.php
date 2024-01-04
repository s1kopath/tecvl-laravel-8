<?php

namespace App\Services\Reports;

trait ReportHelperTrait
{

    /**
     * Stores processed value for return
     */
    private $return = null;

    /**
     * Stores temporary key for the first value which gets stored in $return
     */
    private $tempKey;


    /**
     * Limit of taking data
     */
    private $limit = 5;

    /**
     * Get date of certain offset / Today
     * @param string | null $offset Offset is how many days you want to differ from current date
     * @return string
     */
    private function offsetDate($offset = null)
    {
        if ($offset) {
            return date('Y-m-d', strtotime($offset . " day"));
        }
        return date('Y-m-d');
    }


    /**
     * Get the last weeks first & last day
     * @return array
     */
    private function lastWeek()
    {
        return [
            'start' => $this->offsetDate('-13'),
            'end' => $this->offsetDate('-6')
        ];
    }


    private function lastMonth()
    {
        return [
            'start' => $this->offsetDate('-60'),
            'end' => $this->offsetDate('-30')
        ];
    }

    private function lastYear()
    {
        return [
            'start' => $this->offsetDate('-730'),
            'end' => $this->offsetDate('-365')
        ];
    }

    /**
     * Get the last weeks first & last day
     * @return array
     */
    private function currentWeek()
    {
        return [
            'start' => $this->offsetDate('-7'),
            'end' => $this->offsetDate('-0')
        ];
    }


    private function currentMonth()
    {
        return [
            'start' => $this->offsetDate('-30'),
            'end' => $this->offsetDate('-0')
        ];
    }

    private function currentYear()
    {
        return [
            'start' => $this->offsetDate('-365'),
            'end' => $this->offsetDate('-0')
        ];
    }


    /**
     * Arraying the processed data
     * @return array
     */
    public function getArray()
    {
        if (!$this->return) {
            return [];
        } elseif (is_array($this->return)) {
            return $this->return;
        } else {
            if ($this->tempKey) {
                return [
                    $this->tempKey => $this->return
                ];
            }
            return [
                'value' => $this->return
            ];
        }
    }


    /**
     * Updates the $return property
     * @param mixed $value
     * @param string $key
     * @return void
     */
    private function setReturn($value, $key)
    {
        if ($this->return === null) {
            $this->tempKey = $key;
            $this->return = $value;
        } elseif (is_array($this->return)) {
            $this->return[$key] = $value;
        } else {
            $tempVal = $this->return;
            $this->return = [];
            $this->return[$this->tempKey] = $tempVal;
            $this->return[$key] = $value;
        }
    }


    /**
     * Returns the final processed value
     * @return mixed
     */
    public function get()
    {
        return $this->return;
    }


    /**
     * Returns data as API response
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response($this->get());
    }

    /**
     * First day of the current month
     * @return string
     */
    private function firstDayOfTheMonth()
    {
        return date('m-01-Y');
    }


    /**
     * Last day of the current month
     * @return string
     */
    private function lastDayOfTheMonth()
    {
        return date('m-t-Y');
    }

    /**
     * Tomorrow date
     * @return string
     */
    private function tomorrow()
    {
        return $this->offsetDate('+1');
    }


    /**
     * 1-31 day from date
     * @param string $date
     * @return int
     */
    private function getDay($date)
    {
        return (int) date('d', strtotime($date));
    }


    /**
     * Processes return value and return itself
     * @param mixed $data
     * @param string $key
     * @return mixed
     */
    private function complete($data, $key, $returnThis = true)
    {
        $this->setReturn($data, $key);
        if ($returnThis) {
            return $this;
        }
        return $data;
    }


    /**
     * Calculates growth rates
     * @param float $start
     * @param float $end
     * @return mixed
     */
    private function growthRate($present, $past)
    {
        if (!$present && !$past) {
            return null;
        } elseif ($past == 0) {
            return '&#8734;';
        }
        return round(($present - $past) / $past * 100);
    }


    /**
     * Returns value from the array
     * @param string $key
     * @return mixed
     */
    private function getValue($key)
    {
        if ($key && $key <> '' && isset($this->return[$key])) {
            return $this->return[$key];
        }

        return null;
    }


    /**
     * Get the limit
     * @return int
     */
    private function getLimit()
    {
        return $this->limit;
    }


    /**
     * Get vendor id
     * @return int
     */
    private function getVendorId()
    {
        if (!$this->vendorId) {
            $this->vendorId = auth()->user()->vendor()->id ?? auth()->user()->id;
        }
        return $this->vendorId;
    }
}
