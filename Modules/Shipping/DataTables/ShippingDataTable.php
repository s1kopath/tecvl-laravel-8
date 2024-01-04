<?php
/**
 * @package ShippingDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 18-11-2021
 */

namespace Modules\Shipping\DataTables;

use App\DataTables\DataTable;
use Modules\Shipping\Entities\Shipping;

class ShippingDataTable extends DataTable
{
    public function ajax()
    {
        $shipping = $this->query();
        return datatables()
            ->of($shipping)

            ->addColumn('name', function ($shipping) {
                return  wrapIt($shipping->name, 10, ['columns' => 1, 'trim' => true, 'trimLength' => 20]);
            })->addColumn('cost', function ($shipping) {
                return  formatNumber($shipping->cost);
            })->addColumn('minimum_amount', function ($shipping) {
                return formatNumber($shipping->minimum_amount);
            })->addColumn('status', function ($shipping) {
                return statusBadges(lcfirst($shipping->status));
            })->addColumn('action', function ($shipping) {
                $edit = '<a title="' . __('Edit :x', ['x' => __('Shipping')]) . '" href="' . route('shipping.edit', ['id' => $shipping->id]) . '" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>&nbsp';

                $delete = '<form method="post" action="' . route('shipping.delete', ['id' => $shipping->id]) . '" id="delete-shipping-'. $shipping->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete :x', ['x' => __('Shipping')]) . '" class="btn btn-xs btn-danger" type="button" data-id=' . $shipping->id . ' data-label="Delete" data-delete="shipping" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Shipping')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';
                $str = '';
                if ($this->hasPermission(['Modules\Shipping\Http\Controllers\ShippingController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['Modules\Shipping\Http\Controllers\ShippingController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['name', 'cost', 'minimum_amount', 'status', 'action'])
            ->filter(function ($instance){
                if (isset(request('search')['value'])) {
                    $keyword = xss_clean(request('search')['value']);
                    $instance->where(function ($query) use ($keyword) {
                        $query->WhereLike('name', $keyword)
                            ->OrWhereLike('status', $keyword)
                            ->OrWhereLike('minimum_amount', $keyword)
                            ->OrWhereLike('cost', $keyword);
                    });
                }
            })
            ->make(true);
    }

    public function query()
    {
        if (isset(request('order')[0]['dir']) && request('order')[0]['dir'] == 'asc' || isset(request('order')[0]['dir']) && request('order')[0]['dir'] == 'desc') {
            $shippings = Shipping::select('shippings.*');
            return $this->applyScopes($shippings->get());
        } else {
            $shippings = Shipping::query()->orderBy('id', 'DESC');
            return $this->applyScopes($shippings);
        }
    }

    public function html()
    {
        return $this->builder()

        ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])
        ->addColumn(['data' => 'cost', 'name' => 'cost', 'title' => __('Cost')])
        ->addColumn(['data' => 'minimum_amount', 'name' => 'minimum_amount', 'title' => __('Minimum Amount')])
        ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])

        ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
        'visible' => $this->hasPermission(['Modules\Shipping\Http\Controllers\ShippingController@edit', 'Modules\Shipping\Http\Controllers\ShippingController@destroy']),
        'orderable' => false, 'searchable' => false])

        ->parameters(dataTableOptions());
    }
}
