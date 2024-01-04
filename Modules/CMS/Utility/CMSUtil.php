<?php

namespace Modules\CMS\Utility;

use App\Models\Category;

class CMSUtil
{


    public static function randomStr()
    {
        return substr(str_shuffle('examplestringletsgo'), 0, 5);
    }


    /**
     * Get category type options
     *
     * @return array
     */
    public function categoryOptions()
    {
        return [
            'bestCategory' => __('Best Categories'),
            'popularCategories' => __('Popular Categories'),
            'topCategories' => __('Top Categories'),
            'randomCategories' => __('Random Categories'),
            'selectedCategories' => __('Selected Categories'),
        ];
    }


    /**
     * Get brands type array
     *
     * @return array
     */
    public function brandsOptions()
    {
        return [
            'topBrands' => __('Top Brands'),
            'bestSeller' => __('Best Seller'),
            'popularBrand' => __('Popular Brands'),
        ];
    }

    /**
     * Get Blogs type
     *
     * @return array
     */
    public function blogsOptions()
    {
        return [
            'latestBlogs' => __('Latest Blogs')
        ];
    }


    public function getCategoryList()
    {
        return Category::activeCategories();
    }


    public static function productTypes()
    {
        return [
            'popularItems' => __('Popular Items'),
            'featureItems' => __('Featured Items'),
            'newArrivals' => __('New Arrivals'),
            'flashSales' => __('Flash Sales')
        ];
    }
}
