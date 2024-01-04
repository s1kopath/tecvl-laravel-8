<?php
/**
 * @package PopupFilter
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 29-03-2022
 */

namespace Modules\Popup\Filters;

use App\Filters\Filter;

class PopupFilter extends Filter
{
    /**
     * set the rules of query string
     *
     * @var array
     */
    protected $filterRules = [
        'status' => 'in:Active,Inactive',
        'login_enabled' => 'bool'
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
     * filter by login required  query string
     *
     * @param int $isLogin
     * @return query builder
     */
    public function loginEnabled($isLogin)
    {
        return $this->query->where('login_enabled', $isLogin);
    }

}
