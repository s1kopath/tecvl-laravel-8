<?php

/**
 * @package ShippingController
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 27-12-2021
 */

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\CMS\Entities\Component;
use Modules\CMS\Entities\ComponentProperty;
use Modules\CMS\Entities\Layout;
use Modules\CMS\Entities\LayoutType;
use Modules\CMS\Entities\Page;
use Modules\MediaManager\Http\Models\ObjectFile;

class BuilderController extends Controller
{

    /**
     * Fields to ignore when inserting component properties
     */
    private $ignoreableFields = ['component', 'level', '_token', 'layout', 'section_name', 'file_id', 'file_id[]'];

    /**
     * Get component edit form
     * @param Request $request
     * @return mixed
     */
    public function editElement(Request $request)
    {
        if (!isset($request['file'])) {
            return false;
        }

        $layout = Layout::with('layoutType')->firstWhere('file', $request->file);

        if (!$layout) {
            return false;
        }

        $editorClosed = false;
        return response(['body' => [
            'html' => view('cms::edit.' . $request->file, compact('layout', 'editorClosed'))->render(),
            'header' => view('cms::pieces.header-badges', ['layout' => $layout])->render(),
            'title' => $layout->name
        ]], 200);
    }

    /**
     * Edit Page
     * @param string $slug
     * @return Renderable
     */
    public function edit($slug)
    {
        $page = Page::with(['components' => function ($q) {
            $q->orderBy('level')->with(['properties', 'layout' => function ($q) {
                $q->with('layoutType:id,name');
            }]);
        }])->slug($slug)->first();
        $layouts = LayoutType::with(['layouts'])->get();
        $selector = view('cms::edit.selector', compact('layouts'));
        return view('cms::builder', compact('layouts', 'page', 'selector'));
    }


    /**
     * Update component settings
     * @param Request $request
     * @return response()
     */
    public function updateComponent(Request $request)
    {
        $component = $this->getComponent($request);

        $properties = $this->prepareProperties($component->id, $request);
        if (count($properties) > 0) {
            DB::table('component_properties')->upsert($properties, ['name', 'component_id'], ['value']);
            $componentProperties = ComponentProperty::where('component_id', $component->id)->where('name', 'like', 'image%')->get();
            foreach ($componentProperties->where('value', '!=', null) as $property) {
                $this->uploadImage($property);
            }
        }
        return response(['body' => $component->id], 200);
    }


    /**
     * Delete a component
     * @param Request $request
     * @return boolean
     */
    public function deleteComponent(Request $request)
    {
        $p = ComponentProperty::where('component_id', $request->data)->delete();
        $c = Component::where('id', $request->data)->delete();
        return response()->json(['body' => $p && $c]);
    }

    /**
     * Update component orders
     * @param Request $request
     * @return boolean
     */
    public function orderComponent(Request $request)
    {
        if (!empty($request->data)) {
            $list = json_decode($request->data);
            if (json_last_error() == JSON_ERROR_NONE && is_array($list)) {
                foreach ($list as $item) {
                    if (isset($item->id) && isset($item->level)) {
                        Component::where('id', $item->id)->update(['level' => $item->level]);
                    }
                }
                return true;
            }
        }
        return false;
    }


    /**
     * Process input value
     * @param mixed $value
     * @return mixed
     */
    private function processValue($value)
    {
        if (is_array($value)) {
            return json_encode($value);
        }
        return $value;
    }


    /**
     * Provide component
     * @param Request $request
     * @return Component
     */
    private function getComponent($request)
    {
        if ($request->component) {
            $component = Component::findOrFail($request->component);
            if ($component->level <> $request->level) {
                $component->componentReorder($component->page_id, $component->level, $request->level);
            }
            $component->level = $request->level;
            $component->save();
        } else {
            Component::componentReorder($request->id, 0, $request->level);
            $component = Component::create([
                'page_id' => $request->id,
                'layout_id' => $request->layout,
                'level' => $request->level
            ]);
        }
        return $component;
    }


    /**
     * Prepare properties for component
     * @param int $component
     * @param array
     */
    private function prepareProperties($component, $request)
    {
        $properties = [];
        foreach ($request->all() as $key => $value) {
            if (!in_array($key, $this->ignoreableFields)) {
                $value = $this->processValue($value);
                $properties[] = [
                    'name' => $key,
                    'value' => $value,
                    'component_id' => $component
                ];
            }
        }
        return $properties;
    }


    /**
     * Upload image
     * @param string $image
     * @return boolean
     */
    private function uploadImage($object)
    {
        ObjectFile::storeInObjectFiles($object->getObjectType(), $object->getObjectId(), [$object->value]);
    }
}
