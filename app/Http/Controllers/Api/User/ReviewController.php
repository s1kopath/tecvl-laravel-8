<?php
/**
 * @package ReviewController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 26-01-2022
 */
namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\{
    ReviewResource,
};
use App\Models\{
    Review,
};
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * User review
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        $review = Review::where('user_id', auth()->guard('api')->user()->id);
        if ($review->count() == 0) {
            return $this->notFoundResponse();
        }
        $itemName = isset($request->item_name) ? $request->item_name : null;
        if (!empty($itemName)) {
            $review->whereHas("item", function ($q) use ($itemName) {
                $q->where('name', strtolower($itemName));
            })->with('item');
        }

        $comment = isset($request->comment) ? $request->comment : null;
        if (!empty($comment)) {
            $review->where('comments', strtolower($comment));
        }

        $status = isset($request->status) ? $request->status : null;
        if (!empty($status)) {
            $review->where('status', $status);
        }

        if (isset($request->is_public)) {
            $review->where('is_public', $request->is_public);
        }

        $rating = isset($request->rating) ? $request->rating : null;
        if (!empty($rating)) {
            $review->where('rating', $rating);
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $review->where('id', $keyword);
            } else if (strlen($keyword) >= 2) {
                $review->where(function ($query) use ($keyword) {
                    $query->whereHas("item", function ($q) use ($keyword) {
                            $q->where('name', 'LIKE', "%" . $keyword . "%");
                        })->with('item')
                        ->orwhere('comments', 'LIKE', "%" . $keyword . "%")
                        ->orwhere('status', $keyword);
                });
            }
        }
        return $this->response([
            'data' => ReviewResource::collection($review->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($review->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }
}
