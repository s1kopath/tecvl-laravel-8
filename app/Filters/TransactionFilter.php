<?php
/**
 * @package TransactionFilter
 * @author techvillage <support@techvill.org>
 * @contributor AH Millat <[millat.techvill@gmail.com]>
 * @created 24-03-2022
 */

namespace App\Filters;

use App\Filters\Filter;

class TransactionFilter extends Filter
{
    /**
     * set the rules of query string
     *
     * @var array
     */
    protected $filterRules = [
        'status' => 'in:Accepted,Rejected,Pending',
        'transaction_type' => 'required',
        'user_id' => 'required',
        'start_date' => 'required',
        'end_date' => 'required'
    ];

    /**
     * filter status  query string
     *
     * @param string $status
     * @return query builder
     */
    public function status($status)
    {
        return $this->query->where('transactions.status', $status);
    }

    /**
     * filter by role query string
     *
     * @param int $type
     * @return void
     */
    public function transactionType($type)
    {
        return $this->query->where('transaction_type', $type);
    }

    /**
     * filter by role query string
     *
     * @param int $type
     * @return void
     */
    public function userId($userId)
    {
        return $this->query->where('user_id', $userId);
    }

    public function startDate($startDate)
    {
        if ($startDate != 'null') {
            return $this->query->where('transaction_date', '>=', DbDateFormat($startDate));
        }
    }

    public function endDate($endDate)
    {
        if ($endDate != 'null') {
            return $this->query->where('transaction_date', '<=', DbDateFormat($endDate));
        }
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

        if (!empty($value)) {
            return $this->query->where(function ($query) use ($value) {
                $query->WhereLike('transactions.status', $value)
                    ->OrWhereLike('amount', $value)
                    ->OrWhereLike('total_amount', $value)
                    ->OrWhereLike('transaction_type', $value)
                    ->orWhereHas('withdrawalMethod', function ($query) use ($value) {
                        $query->WhereLike('method_name', $value);
                    })
                    ->orWhereHas('currency', function ($query) use ($value) {
                        $query->WhereLike('currencies.name', $value);
                    })
                    ->orWhereHas('user', function ($query) use ($value) {
                        $query->where('users.name', 'like', '%' . $value . '%');
                    });
            });
        }
    }
}
