<?php
/**
 * @package ThemeOptionController
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 27-12-2021
 */
namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\CMS\DataTables\PageDataTable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Http\Models\ThemeOption;

class ThemeOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('cms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function list()
    {
        return view('cms::theme.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $formData =  [];
        parse_str($request->data, $formData);
        unset($formData['_token']);
        $listSwitch = ThemeOption::pluck('name')->toArray();
        foreach($listSwitch as $switch) {
            if (!array_key_exists($switch, $formData)) {
                $formData[$switch] = 'off';
            }
        }
        if ((new ThemeOption)->store($formData)) {
            return ['status' => 1, 'message' => __('Successfully Saved')];
        }
        return ['status' => 0, 'message' => __('Something went wrong')];
    }
    
}
