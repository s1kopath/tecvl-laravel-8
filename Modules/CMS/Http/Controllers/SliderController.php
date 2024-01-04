<?php
/**
 * @package SliderController
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 01-05-2022
 */
namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Http\Requests\SliderRequest;
use Modules\CMS\Http\Models\Slider;
use Session;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['sliders'] = Slider::with('slides')->get();
        return view('cms::slider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SliderRequest $request)
    {
        $data = ['status' => 'fail', 'message' => __('Invalid Request')];
        if((new Slider)->store($request->only('name', 'status'))) {
            $data['status'] = 'success';
            $data['message'] = __('The :x has been successfully saved.', ['x' => __('Slide')]);
        }
        Session::flash($data['status'], $data['message']);
        return redirect()->route('slider.index');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SliderRequest $request)
    {
        $data = ['status' => 'fail', 'message' => __('Invalid Request')];
        if ((new Slider)->updateData($request->only('name', 'status', 'id'))) {
            $data['status'] = 'success';
            $data['message'] = __('The :x has been successfully updated.', ['x' => __('Slide')]);
        }

        Session::flash($data['status'], $data['message']);
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
        $response = (new Slider)->remove($id);
        Session::flash($response['status'], $response['message']);
        return redirect()->route('slider.index');
    }
}
