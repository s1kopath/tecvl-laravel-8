<?php
/**
 * @package VendorFilter
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 29-03-2022
 */

namespace App\Filters;

use App\Filters\Filter;

class VendorFilter extends Filter
{
    /**
     * set the rules of query string
     *
     * @var array
     */
    protected $filterRules = [
        'status' => 'in:Active,Inactive,Pending'
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

}
