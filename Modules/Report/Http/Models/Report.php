<?php
/**
 * @package Report Model
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 20-03-2022
 */

namespace Modules\Report\Http\Models;

use App\Models\Model;
use Modules\Coupon\Http\Models\Coupon;
use App\Models\{
    Brand,
    Item,
    Category,
    ItemDetail,
    Tag,
    Order,
    Vendor,
    OrderDetail
};
use Modules\Shipping\Entities\Shipping;
use Modules\Commission\Http\Models\OrderCommission;
use DB;


class Report extends Model
{
    public function reportType()
    {
        return $reportType = [
            'coupons_report' => 'Coupons Report',
            'customers_order_report' => 'Customers Order Report',
            'commitions_report' => 'Commitions Report',
            'products_view_report' => 'Products View Report',
            'branded_products_report' => 'Branded Products Report',
            'categorized_products_report' => 'Categorized Products Report',
            'product_stock_report' => 'Product Stock Report',
            'tagged_products_report' => 'Tagged Products Report',
            'search_report' => ' Search Report',
            'sale_report' => ' Sale Report',
            'shipping_report' => 'Shipping Report',
        ];

    }

    public function tableRow()
    {
        return $products = array(
            'coupons_report' => array('Date', 'Coupon Name', 'Coupon Code', 'Order', 'Total'),
            'customers_order_report' => array('Name', 'Email', 'Orders', 'Products', 'Total'),
            'products_view_report' => array('Demo', 'Demo', 'Demo'),
            'branded_products_report' => array('Brand', 'Total Product'),
            'product_stock_report' => array('Product', 'Qty', 'Availability'),
            'categorized_products_report' => array('Category', 'Total Product'),
            'tagged_products_report' => array('Tag', 'Product Count'),
            'sale_report' => array('Date', 'Order', 'Product', 'Subtotal', 'Shipping', 'Discount', 'Tax', 'Total'),
            'shipping_report' => array('Shipping Methods', 'Order', 'Total'),
            'commitions_report' => array('Vendor Name', 'Total Order', 'Total Commition'),
          ); 

    }

    public function getCouponReport($from = null, $to = null, $couponCode = null)
    {
        $coupon = Coupon::has('couponRedeems');
        if (!empty($from)) {
            $coupon->where('start_date', '>=', DbDateFormat($from));
        }  
        if (!empty($to)) {
            $coupon->where('start_date', '<=', DbDateFormat($to));
        }  
        if (!empty($couponCode)) {
            $coupon->where('code', $couponCode);
        } 

        return $coupon->withSum('couponRedeems', 'discount_amount')->withCount('couponRedeems')->get();
    }

    public function getBrandReport($brandName = null)
    {
        $brand =  Brand::has('item');
        if(!empty($brandName)) {
            $brand->where('name', $brandName);
        }
        return $brand->select('id', 'name')->withCount('item')->get();
    }

    public function getCategoreizedProductReport($categoryName = null)
    {
        $category = Category::has('itemCategory');
        if(!empty($categoryName)) {
            $category->where('name', $categoryName);
        }
        return $category->select('name', 'id')->withCount('itemCategory')->get();
    }

    public function getProductStockReport($qtyAbove, $qtyBellow, $stockAvailability)
    {
        $data = DB::table('item_details')
        ->where('item_details.is_track_inventory' , 1)
        ->leftjoin('item_options', 'item_options.item_id', '=', 'item_details.item_id')
        ->leftjoin('inventories', 'inventories.item_option_id', '=', 'item_options.id')
        ->leftjoin('items', 'items.id', '=', 'item_options.item_id')
        ->select('item_details.item_id', 'item_details.is_track_inventory', 'item_options.id', 'item_options.item_id', 'item_options.payloads', 'inventories.id', 'inventories.item_option_id', 'inventories.quantity', 'items.name');
        if (!empty($qtyAbove)) {
            $data ->where('inventories.quantity','>', $qtyAbove);
        }
        if (!empty($qtyBellow)) {
            $data ->where('inventories.quantity','<', $qtyBellow);
        }
        if (!empty($stockAvailability)) {
            if ($stockAvailability == 'in_stock') {
                $data->where('inventories.quantity','>', 0);
            } else {
                $data->where('inventories.quantity','=', 0);
            }    
        }
        return $data->get();
    }

    public function getTagReport($tagName = null)
    {
        $tag = Tag::has('itemTag');
        if (!empty($tagName)) {
            $tag->where('name', $tagName);
        }
        return $tag->select('id', 'name')->withCount('itemTag')->get();
    }

    public function getCustomerOrderReport($from = null, $to = null, $custonename = null, $customerEmail = null, $orderStatus= null)
    {
        $order =  Order::with('user:id,name,email');
            if (!empty($custonename)) {
                $order->orWhereHas('user', function($query) use($custonename)
                {
                    $query->where('name', $custonename);
                });
            } 
            if (!empty($orderStatus)) {
                $order->orWhereHas('orderDetails', function($query) use($orderStatus)
                {
                    $query->where('order_status_id', $orderStatus);
                });
            }
            if (!empty($customerEmail)) {
                $order->orWhereHas('user', function($query) use($customerEmail)
                {
                    $query->where('email', $customerEmail);
                });
            }
            if (!empty($from)) {
                $order->where('order_date', '>=', DbDateFormat($from));
            }  
            if (!empty($to)) {
                $order->where('order_date', '<=', DbDateFormat($to));
            }  

          return $order->select('id', 'total', 'total_quantity', 'user_id')->selectRaw(DB::raw("SUM(total) as totalamount, SUM(total_quantity) as totalQty, COUNT(id) as totalOrder"))->groupBy('user_id')->get();
    }

    public function getShippingReport($from = null, $to = null, $orderStatus= null, $shippingMethod = null)
    {

        $shippingReport = Shipping::has('orderDetails');
        if (!empty($orderStatus)) {
            $shippingReport->WhereHas('orderDetails', function($query) use($orderStatus)
            {
                $query->where('order_status_id', $orderStatus);
            });
        }
        if (!empty($shippingMethod)) {
            $shippingReport->where('id', $shippingMethod);
        }
        return $shippingReport->withSum('orderDetails', 'price')->withCount(['orderDetails' => function($query) {
            $query->select(DB::raw('count(distinct(order_id))'));
        }])->where('status', 'Active')->get();
    }

    public function getCommitionReport($vendor = null)
    {
        $orderCommition =  OrderCommission::with(['OrderDetail:id,item_name,price,quantity', 'vendor:id,name']);
        if (!empty($vendor)) {
            $orderCommition->orWhereHas('vendor', function($query) use($vendor)
            {
                $query->where('name', $vendor);
            });
        }    
        return $orderCommition->get();
    }

    public function getSaleReport($from = null, $to = null, $orderStatus = null)
    {
        $order =  Order::has('orderDetails');
        
        if (!empty($orderStatus)) {
            $order->where('order_status_id', $orderStatus);
        }  
     
        if (!empty($from)) {
            $order->where('order_date', '>=', DbDateFormat($from));
        }  
        if (!empty($to)) {
            $order->where('order_date', '<=', DbDateFormat($to));
        }  
        return $order->withSum('orderDetails', 'price')->withSum('orderDetails', 'discount_amount')->withSum('orderDetails', 'shipping_charge')->withSum('orderDetails', 'tax_charge')->selectRaw(DB::raw('count(id) as totalOrder'))->selectRaw(DB::raw('SUM(total_quantity) as totalProduct'))->groupBy('order_date')->get();
    }
    

}
