<?php
/**
 * @package WishlistController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 26-01-2022
 */
namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\{
    WishlistResource
};
use App\Models\{
    Wishlist,
};
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * User wishlist
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        $wishlist = Wishlist::where('user_id', auth()->guard('api')->user()->id);
        if ($wishlist->count() == 0) {
            return $this->notFoundResponse();
        }
        $itemName = isset($request->item_name) ? $request->item_name : null;
        if (!empty($itemName)) {
            $wishlist->whereHas("item", function ($q) use ($itemName) {
                $q->where('name', strtolower($itemName));
            })->with('item');
        }

        $date = isset($request->date) ? $request->date : null;
        if (!empty($date)) {
            $wishlist->where('created_at', $date);
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $wishlist->where(function ($query) use ($keyword) {
                    $query->where('id', $keyword)
                        ->orwhere('created_at', $keyword);
                });
            } else if (strlen($keyword) >= 2) {
                $wishlist->where(function ($query) use ($keyword) {
                    $query->whereHas("item", function ($q) use ($keyword) {
                            $q->where('name', 'LIKE', "%" . $keyword . "%");
                        })->with('item')
                        ->orwhere('created_at', $keyword);
                });
            }
        }
        return $this->response([
            'data' => WishlistResource::collection($wishlist->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($wishlist->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

    /**
     * Delete wishlist
     * @param int $id
     * @return json $response
     */
    public function destroy($id = null)
    {
        $response = $this->checkExistance($id, 'wishlists');
        if ($response['status']) {
            if (Wishlist::where('user_id', auth()->guard('api')->user()->id)->where('id', $id)->delete()) {
                return $this->okResponse([], __('The :x has been successfully deleted.', ['x' => __('Wishlist')]));
            }
            return $this->response([], 500, __('Something went wrong, please try again.'));
        }

        return $this->response([], $response['code'], $response['message']);
    }
}
