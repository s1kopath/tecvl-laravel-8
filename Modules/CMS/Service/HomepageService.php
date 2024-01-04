<?php

namespace Modules\CMS\Service;

use App\Models\Brand;
use App\Models\Category;
use App\Models\File;
use App\Models\Item;
use Modules\Blog\Http\Models\Blog;
use Modules\CMS\Entities\Page;
use Modules\CMS\Http\Models\Slide;

class HomepageService
{
    private $catTitles = [
        'popularItems' => 'Most Popular',
        'featureItems' => 'Featured Products',
        'newArrivals' => 'New Arrivals',
        'bestSeller' => 'Best Seller',
        'flashSales' => 'Flash Sales'
    ];


    /**
     * Returns dynamic homepage components
     * @return mixed
     */
    public function home()
    {
        $page = Page::default()->with(['components' => function ($q) {
            $q->with(['properties', 'layout:id,file'])->orderBy('level', 'asc');
        }])->first();
        if ($page) {
            return $page;
        }
        return false;
    }

    /**
     * Get specific category/type of products
     *
     * @param string $type product category/type
     * @param int $limit maximum number of product
     *
     * @return mixed
     */
    public function getProducts($type, $limit = 10)
    {
        try {
            return Item::$type($limit);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get banner
     * @return Collection
     */
    public function getBanner($id = 1)
    {
        return Slide::get()->where('slider_id', 1);
    }


    /**
     * returns product types name
     * @param string $name
     * @return string
     */
    public function getCategoryTitle($name)
    {
        if (isset($this->catTitles[$name])) {
            return $this->catTitles[$name];
        } else {
            return ucfirst($name);
        }
    }


    /**
     * Get sidebar file name
     * @param String $type Sidebar type
     * @return string View file name
     */
    public function getSidebar($type)
    {
        $sidebars = [
            'slider' => 'cms::partials.gridbox_slider',
            'banner' => 'cms::partials.gridbox_banner',
            'flash_sale' => 'cms::partials.flash',
        ];
        return isset($sidebars[$type]) ? $sidebars[$type] : null;
    }


    /**
     * Get category list of specific type
     * @param string $type
     * @param array $ids
     *
     * @return Collection
     */
    public function categories($type, $return = null, $ids = [])
    {
        try {
            if ($type == 'selectedCategories') {
                if (count($ids) > 0) {
                    return Category::whereIn('id', $ids)->get();
                }
                return Category::limit(10)->get();
            }
            return Category::$type();
        } catch (\Exception $e) {
            return $return;
        }
    }


    /**
     * Get brands
     * @param string $type
     * @param mixed $return Default return value if no data found
     * @return collection
     */
    public function getBrands($type, $return = null)
    {
        try {
            return Brand::$type();
        } catch (\Exception $e) {
            return $return;
        }
    }


    public function getBlogs($type, $limit = 10, $return = null)
    {
        try {
            return (new Blog)->latestBlogs($limit);
        } catch (\Exception $e) {
            return $return;
        }
    }

    public function getImage($imageId = null, $getFile = false)
    {
        if (!$imageId) {
            return url(defaultImage('default'));
        }
        $file = File::whereKey($imageId)->first();
        if (is_null($file)) {
            return url(defaultImage('default'));
        }
        if (!file_exists($this->filePathNew($file->file_name))) {
            return url(defaultImage('default'));
        }

        if ($getFile) {
            return $file;
        }
        return url($this->filePathNew($file->file_name));
    }

    protected function filePathNew($fileName)
    {
        return join(DIRECTORY_SEPARATOR, [$this->uploadPathNew(), $fileName]);
    }

    protected function uploadPathNew()
    {
        return createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads']));
    }
}
