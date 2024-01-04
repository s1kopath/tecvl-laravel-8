<?php

namespace Modules\MediaManager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MediaManager\Http\Requests\MediaManagerRequest;
use Modules\MediaManager\Http\Models\MediaManager;
use App\Models\File;
use DB, Response, Session;

class MediaManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('mediamanager::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('mediamanager::create');
    }
     /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(MediaManagerRequest $request)
    {
        $data = ['status' => 'fail'];
        if ((new MediaManager)->store($request->all())) {
            $data['status'] = 'success';
        };
        return $data;
    }

    public function upload(Request $request)
    {
        $data['files'] = File::whereIn('id', $request->file_id)->get();
        return view('mediamanager::image.uploded_image', $data);
    }

    public function uploadedFiles(Request $request)
    {
        $data['files'] = File::getAllFiles();
        return view('mediamanager::uploded_files', $data);
    }

    public function sortFiles(Request $request)
    {
        $data['files'] = File::getAllFiles();
        return view('mediamanager::image.sorted_image', $data);
    }

    public function paginateFiles(Request $request)
    {
        $data['files'] = File::getAllFiles();
        return view('mediamanager::image.sorted_image', $data);
    }

    public function maxFileId()
    {
        return File::orderBy('id', 'desc')->pluck('id')->first();
    }

    public function paginateData(Request $request)
    {
        if ($request->ajax()) {
            $data['files'] = File::simplePaginate(preference('row_per_page', 10));
            return view('mediamanager::image.child_paginate', $data)->render();
        }
    }

    public function download($id)
    {
        $file = File::where('id', $id)->first();
        if ($file) {
            $imageName = str_replace('\\' , '', $file->file_name);
            $image = public_path('uploads' . '\\'. $file->file_name);
            if (file_exists($image)) {
                switch (strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION))) {
                    case 'pdf':
                        $mime = 'application/pdf';
                        break;
                    case 'zip':
                        $mime = 'application/zip';
                        break;
                    case 'jpeg':
                    case 'jpg':
                        $mime = 'image/jpg';
                        break;
                    default:
                        $mime = 'application/force-download';
                }
                
                $headers = array(
                        'Content-Type' => $mime
                    );
                return Response::download($image, $imageName, $headers); 
            } else {
                if (file_exists(public_path('dist\img' .'\\'. 'default_product.jpg'))) {
                    return Response::download(public_path('dist\img' .'\\'. 'default_product.jpg'), 'default_product.jpg', ['image/jpg']);
                }
                $data = ['status' => 'fail', 'message' => __('The file you are looking for is not found.')];
                Session::flash($data['status'], $data['message']);
                return redirect()->back();
            }
            
        } else {
            $data = ['status' => 'fail', 'message' => __('This file does not exist.')];
            Session::flash($data['status'], $data['message']);
            return redirect()->back();
        }
    }

    public function deleteImage(Request $request)
    {
        $image = File::where('id', $request->id)->first();
        if ($image) {
            if (file_exists(public_path('\uploads\\' . $image->file_name))) {
                unlink(public_path('\uploads\\' . $image->file_name));
                return json_encode(["resp" => __("success")]);
            }
        }
        
        return json_encode(["resp" => __("error")]);
    }

}
