<?php

namespace Modules\Report\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Report\Http\Models\Report;
use App\Models\OrderStatus;
use Modules\Shipping\Entities\Shipping;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data['reportTypes'] = (new Report)->reportType();
        $data['orderStatus'] = (new OrderStatus)->get();
        $data['shippingMethod'] = (new Shipping)->get();
        $report = [];
        $orderStatus = [];
        $reportName = '';
        if(isset(request()->type) && !empty(request()->type)) {
            $reportTypes = (new Report)->reportType();
            $header = (new Report)->tableRow();
            
            if(request()->type == 'coupons_report') {
                $reportName = __('Coupon Report');
                $res = (new Report)->getCouponReport(request()->from, request()->to, request()->couponCode);
                foreach($res as $key => $value) {
                    $report[] = [
                        'date' => $value->start_date . '-' . $value->end_date,
                        'name' => $value->name,
                        'code' => $value->code,
                        'order' => formatCurrencyAmount($value->coupon_redeems_count),
                        'total' => formatNumber($value->coupon_redeems_sum_discount_amount)
                    ];                    
                }
            } else if (request()->type == 'branded_products_report') {
                $reportName = __('Branded Product Report');
                $res = (new Report)->getBrandReport(request()->brandName);
                foreach($res as $key => $value) {
                    $report[] = [
                        'name' => $value->name,
                        'total' => formatCurrencyAmount($value->item_count),
                    ];                    
                }
            } else if(request()->type == 'categorized_products_report') {
                $reportName = __('Categorized Product Report');
                $res = (new Report)->getCategoreizedProductReport(request()->categoryName);
                foreach($res as $key => $value) {
                    $report[] = [
                        'name' => $value->name,
                        'total' => formatCurrencyAmount($value->item_category_count),
                    ];                    
                }
            } else if(request()->type == 'product_stock_report') {
                $reportName = __('Product Stock Report');
                $res = (new Report)->getProductStockReport(request()->qtyAbove, request()->qtybellow, request()->stockAvailability);
                foreach($res as $key => $value) {
                    $report[] = [
                        'name' => $value->name . ' (' . json_decode($value->payloads)->label[0] . ')' ,
                        'total' => formatCurrencyAmount($value->quantity),
                        'status' => $value->quantity > 0 ? 'In Stock' : 'Out of Stock',
                    ];                    
                }
            } else if(request()->type == 'tagged_products_report') {
                $reportName = __('Tagged Report');
                $res = (new Report)->getTagReport(request()->tagName);
                foreach($res as $key => $value) {
                    $report[] = [
                        'name' => $value->name,
                        'total' => formatCurrencyAmount($value->item_tag_count),
                    ];                    
                }
            } else if(request()->type == 'customers_order_report') {
                $reportName = __('Customer Order Report');
                $res = (new Report)->getCustomerOrderReport(request()->from, request()->to, request()->customerName, request()->customerEmail, request()->orderStatus);
                foreach($res as $key => $value) {
                    $report[] = [
                        'name' => optional($value->user)->name,
                        'email' => optional($value->user)->email,
                        'order' => formatCurrencyAmount($value->totalOrder),
                        'product' => formatCurrencyAmount($value->totalQty),
                        'total' => formatNumber($value->totalamount),
                    ];                    
                }
            } else if(request()->type == 'shipping_report') {
                $reportName = __('Shipping Report');
                $res = (new Report)->getShippingReport(request()->from, request()->to, request()->orderStatus, request()->shippingMethod);
                foreach($res as $key => $value) {
                    $report[] = [
                        'name' => $value->name,
                        'order' => formatCurrencyAmount($value->order_details_count),
                        'total' => formatNumber($value->order_details_sum_price),
                    ];                    
                }
            } else if(request()->type == 'commitions_report') {
                $reportName = __('Commitions Report');
                $res = (new Report)->getCommitionReport(request()->vendorName);
                foreach($res as $key => $value) {
                    $totalValue[$value->vendor_id] = formatCurrencyAmount(($value->OrderDetail->price * $value->OrderDetail->quantity) * ($value->amount / 100));
                    $name[] = optional($value->vendor)->name;
                    $order[] = $value->OrderDetail->price * $value->OrderDetail->quantity;
                }
                foreach($totalValue as $key => $value) {
                    $report[] = [
                        'name' => $name[$key],
                        'order' => formatCurrencyAmount($order[$key]),
                        'total' => $value,
                    ];
                }
            } else if(request()->type == 'sale_report') {
                $reportName = __('Sale Report');
                $res = (new Report)->getSaleReport(request()->from, request()->to, request()->orderStatus);
                foreach($res as $key => $value) {
                    $report[] = [
                        'date' => $value->order_date,
                        'orders' => $value->totalOrder,
                        'products' => $value->totalProduct,
                        'total' => formatNumber($value->total),
                        'shipping' => formatNumber($value->order_details_sum_shipping_charge),
                        'discount' => formatNumber($value->order_details_sum_discount_amount),
                        'tax' => formatNumber($value->order_details_sum_tax_charge),
                        'summary' => formatNumber(($value->total + $value->order_details_sum_shipping_charge + $value->order_details_sum_tax_charge) - $value->order_details_sum_discount_amount),
                    ];                    
                }
            }
            $list = view('report::coupon.list', compact('report', 'header', 'reportName'))->render();
            return response(['list' => $list]);
		} else {
            return view('report::index', $data);
        }
    }
}
