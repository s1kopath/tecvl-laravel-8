<?php
/**
 * @package VendorTransactionDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 12-05-2022
 */
namespace App\DataTables;

use App\Models\Transaction;

class VendorTransactionDataTable extends DataTable
{
    public function ajax()
    {
        $transactions = $this->query();
        return datatables()
            ->of($transactions)
            ->addColumn('user.name', function ($transactions) {
                return '<a href="' . route('users.edit', ['id' => optional($transactions->user)->id]) . '">' . wrapIt(optional($transactions->user)->name, 10) . '</a>';
                return optional($transactions->user)->name;
            })->addColumn('currency.name', function ($transactions) {
                return optional($transactions->currency)->name;
            })->editColumn('withdrawal_method.method_name', function ($transactions) {
                if ($transactions->transaction_type == 'Withdrawal') {
                    return optional($transactions->withdrawalMethod)->method_name;
                } elseif ($transactions->transaction_type == 'Order') {
                    return optional(optional($transactions->order)->paymentMethod)->gateway;
                } else {
                    return null;
                }
            })->addColumn('amount', function ($transactions) {
                return formatCurrencyAmount($transactions->amount);
            })->addColumn('total_amount', function ($transactions) {
                return formatCurrencyAmount($transactions->total_amount);
            })->addColumn('charge_amount', function ($transactions) {
                return formatCurrencyAmount($transactions->charge_amount + $transactions->commission_amount + $transactions->discount_amount);
            })->addColumn('status', function ($transactions) {
                return statusBadges($transactions->status);
            })->addColumn('transaction_date', function ($transactions) {
                return formatDate($transactions->transaction_date);
            })
            ->rawColumns(['user.name', 'withdrawal_method.name', 'currency_id', 'withdrawal_method_id', 'amount', 'charge_amount', 'commission_amount', 'discount_amount', 'total_amount', 'transaction_type', 'status', 'transaction_date'])

            ->make(true);
    }

    public function query()
    {
        $transactions = Transaction::select('transactions.id', 'user_id', 'currency_id', 'transactions.status', 'withdrawal_method_id', 'amount', 'charge_amount', 'commission_amount', 'discount_amount', 'total_amount', 'transaction_type', 'order_id', 'transaction_date')
            ->where('vendor_id', session()->get('vendorId'))
            ->with(['user:id,name', 'currency:id,name', 'withdrawalMethod:id,method_name', 'order'])
            ->filter();
        return $this->applyScopes($transactions);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => __('Payer')])
            ->addColumn(['data' => 'currency.name', 'name' => 'currency.name', 'title' => __('Currency')])
            ->addColumn(['data' => 'withdrawal_method.method_name', 'name' => 'withdrawalMethod.method_name', 'title' => __('Method')])
            ->addColumn(['data' => 'amount', 'name' => 'amount', 'title' => __('Amount')])
            ->addColumn(['data' => 'charge_amount', 'name' => 'charge_amount', 'title' => __('Fees')])
            ->addColumn(['data' => 'total_amount', 'name' => 'total_amount', 'title' => __('Total')])
            ->addColumn(['data' => 'transaction_type', 'name' => 'transaction_type', 'title' => __('Type')])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])
            ->addColumn(['data' => 'transaction_date', 'name' => 'transaction_date', 'title' => __('Date')])
            ->parameters(dataTableOptions());
    }
}
