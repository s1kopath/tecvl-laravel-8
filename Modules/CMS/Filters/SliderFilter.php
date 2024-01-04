<?php
/**
 * @package SliderFilter
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 24-03-2022
 */

namespace Modules\CMS\Filters;

use App\Filters\Filter;

class SliderFilter extends Filter
{
    /**
     * set the rules of query string
     *
     * @var array
     */
    protected $filterRules = [
        'status' => 'in:Active,Inactive',
        'name' => 'string'
    ];

    /**
     * filter status  query string
     *
     * @param string $status
     * @return query builder
     */
    public function status($status)
    {
        return $this->query->where('status', $status);
    }

    /**
     * filter by name query string
     *
     * @param string $name
     * @return void
     */
    public function name($name)
    {
        return $this->query->where('name', $name);
    }

    /**
     * filter by search query string
     *
     * @param string $value
     * @return query builder
     */
    public function search($value)
    {
        $value = xss_clean($value['value']);

        return $this->query->where(function ($query) use ($value) {
            $query->whereLike('name', $value)
                ->OrWhereLike('status', $value);
        });
    }
}
