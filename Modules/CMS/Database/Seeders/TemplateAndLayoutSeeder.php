<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CMS\Entities\Component;
use Modules\CMS\Entities\ComponentProperty;
use Modules\CMS\Entities\Layout;
use Modules\CMS\Entities\LayoutType;

class TemplateAndLayoutSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        LayoutType::insert([
            [
                'id' => 1,
                'name' => 'Call To Action',
                'description' => 'Call to action',
            ],
            [
                'id' => 2,
                'name' => 'Product Blocks',
                'description' => 'Different Blocks',
            ],
            [
                'id' => 3,
                'name' => 'Categories',
                'description' => 'Categories',
            ],
            [
                'id' => 4,
                'name' => 'Brands',
                'description' => 'Product Brands',
            ],
            [
                'id' => 5,
                'name' => 'Blog',
                'description' => 'Blogs Layout',
            ],
        ]);

        Layout::insert([
            [
                'id' => 1,
                'layout_type_id' => 1,
                'name' => 'Brand Call To Action 1',
                'description' => 'Brand CTA 1',
                'file' => 'cta-banner-template-v1',
                'image' => 'cta-banner-template-v1.png'
            ],
            [
                'id' => 2,
                'layout_type_id' => 2,
                'name' => 'Grid with sidebar',
                'description' => 'Grid with left slider/banner',
                'file' => 'product-grid-with-sidebar-template-v1',
                'image' => 'product-grid-with-sidebar-template-v1.png'
            ],
            [
                'id' => 3,
                'layout_type_id' => 2,
                'name' => 'Product Grid Tabs',
                'description' => 'Product grid with tabs',
                'file' => 'product-tabs-grid-template-v1',
                'image' => 'product-tabs-grid-template-v1.png'
            ],
            [
                'id' => 4,
                'layout_type_id' => 1,
                'name' => 'Multiple Call To Action',
                'description' => 'Multiple CTA',
                'file' => 'cta-banner-template-v2',
                'image' => 'cta-banner-template-v2.png'
            ],
            [
                'id' => 5,
                'layout_type_id' => 3,
                'name' => 'Category Block 1',
                'description' => 'Categories Block',
                'file' => 'category-template-v1',
                'image' => 'category-template-v1.png'
            ],
            [
                'id' => 6,
                'layout_type_id' => 4,
                'name' => 'Brand Block',
                'description' => 'Brand Block',
                'file' => 'brands-template-v1',
                'image' => 'brands-template-v1.png'
            ],
            [
                'id' => 7,
                'layout_type_id' => 5,
                'name' => 'Blogs Grid',
                'description' => 'Blogs Grid',
                'file' => 'blogs-template-v1',
                'image' => 'blogs-template-v1.png'
            ]

        ]);

        \DB::table('components')->delete();

        Component::insert([
            [
                'id' => 4,
                'page_id' => 1,
                'layout_id' => 2,
                'level' => 0
            ],
            [
                'id' => 5,
                'page_id' => 1,
                'layout_id' => 2,
                'level' => 1
            ],
            [
                'id' => 7,
                'page_id' => 1,
                'layout_id' => 1,
                'level' => 2
            ],
            [
                'id' => 8,
                'page_id' => 1,
                'layout_id' => 2,
                'level' => 3
            ],
            [
                'id' => 9,
                'page_id' => 1,
                'layout_id' => 3,
                'level' => 4
            ],
            [
                'id' => 10,
                'page_id' => 1,
                'layout_id' => 4,
                'level' => 5
            ],
            [
                'id' => 12,
                'page_id' => 1,
                'layout_id' => 6,
                'level' => 6
            ],
            [
                'id' => 13,
                'page_id' => 1,
                'layout_id' => 7,
                'level' => 7
            ],
            [
                'id' => 14,
                'page_id' => 1,
                'layout_id' => 5,
                'level' => 8
            ],
            [
                'id' => 15,
                'page_id' => 2,
                'layout_id' => 2,
                'level' => 8
            ],
            [
                'id' => 16,
                'page_id' => 2,
                'layout_id' => 2,
                'level' => 7
            ],
            [
                'id' => 18,
                'page_id' => 2,
                'layout_id' => 1,
                'level' => 6
            ],
            [
                'id' => 19,
                'page_id' => 2,
                'layout_id' => 2,
                'level' => 5
            ],
            [
                'id' => 20,
                'page_id' => 2,
                'layout_id' => 3,
                'level' => 4
            ],
            [
                'id' => 21,
                'page_id' => 2,
                'layout_id' => 4,
                'level' => 3
            ],
            [
                'id' => 23,
                'page_id' => 2,
                'layout_id' => 6,
                'level' => 2
            ],
            [
                'id' => 24,
                'page_id' => 2,
                'layout_id' => 7,
                'level' => 1
            ],
            [
                'id' => 25,
                'page_id' => 2,
                'layout_id' => 5,
                'level' => 0
            ],
        ]);

        \DB::table('component_properties')->delete();

        ComponentProperty::insert([
            ["component_id" => 4, "name" => "title", "value" => "BEST DEALS OF THE WEEK"],
            ["component_id" => 4, "name" => "see_more", "value" => 0],
            ["component_id" => 4, "name" => "more_link", "value" => null],
            ["component_id" => 4, "name" => "sidebar", "value" => "banner"],
            ["component_id" => 4, "name" => "sidebar_position", "value" => "left"],
            ["component_id" => 4, "name" => "showcase_type", "value" => "flashSales"],
            ["component_id" => 4, "name" => "u_subtitle_slide", "value" => "LIVING & LIFESTYLE"],
            ["component_id" => 4, "name" => "l_subtitle_banner", "value" => "DECORATE"],
            ["component_id" => 4, "name" => "title_banner", "value" => "YOUR HOME"],
            ["component_id" => 4, "name" => "image_banner", "value" => "https://images.unsplash.com/photo-1582131503261-fca1d1c0589f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"],
            ["component_id" => 4, "name" => "button_banner", "value" => "Shop Now"],
            ["component_id" => 4, "name" => "link_banner", "value" => null],
            ["component_id" => 4, "name" => "u_subtitle_slider1", "value" => null],
            ["component_id" => 4, "name" => "l_subtitle_slider1", "value" => null],
            ["component_id" => 4, "name" => "title_slider1", "value" => null],
            ["component_id" => 4, "name" => "image_slider1", "value" => null],
            ["component_id" => 4, "name" => "button_slider1", "value" => null],
            ["component_id" => 4, "name" => "link_slider1", "value" => null],
            ["component_id" => 4, "name" => "u_subtitle_slider2", "value" => null],
            ["component_id" => 4, "name" => "l_subtitle_slider2", "value" => null],
            ["component_id" => 4, "name" => "title_slider2", "value" => null],
            ["component_id" => 4, "name" => "image_slider2", "value" => null],
            ["component_id" => 4, "name" => "button_slider2", "value" => null],
            ["component_id" => 4, "name" => "link_slider2", "value" => null],
            ["component_id" => 4, "name" => "u_subtitle_slider3", "value" => null],
            ["component_id" => 4, "name" => "l_subtitle_slider3", "value" => null],
            ["component_id" => 4, "name" => "title_slider3", "value" => null],
            ["component_id" => 4, "name" => "image_slider3", "value" => null],
            ["component_id" => 4, "name" => "button_slider3", "value" => null],
            ["component_id" => 4, "name" => "link_slider3", "value" => null],
            ["component_id" => 5, "name" => "title", "value" => "Flash Sales"],
            ["component_id" => 5, "name" => "see_more", "value" => 0],
            ["component_id" => 5, "name" => "more_link", "value" => null],
            ["component_id" => 5, "name" => "sidebar", "value" => "flash_sale"],
            ["component_id" => 5, "name" => "sidebar_position", "value" => "left"],
            ["component_id" => 5, "name" => "showcase_type", "value" => "flashSales"],
            ["component_id" => 5, "name" => "u_subtitle_slide", "value" => null],
            ["component_id" => 5, "name" => "l_subtitle_banner", "value" => null],
            ["component_id" => 5, "name" => "title_banner", "value" => null],
            ["component_id" => 5, "name" => "image_banner", "value" => null],
            ["component_id" => 5, "name" => "button_banner", "value" => null],
            ["component_id" => 5, "name" => "link_banner", "value" => null],
            ["component_id" => 5, "name" => "u_subtitle_slider1", "value" => null],
            ["component_id" => 5, "name" => "l_subtitle_slider1", "value" => null],
            ["component_id" => 5, "name" => "title_slider1", "value" => null],
            ["component_id" => 5, "name" => "image_slider1", "value" => null],
            ["component_id" => 5, "name" => "button_slider1", "value" => null],
            ["component_id" => 5, "name" => "link_slider1", "value" => null],
            ["component_id" => 5, "name" => "u_subtitle_slider2", "value" => null],
            ["component_id" => 5, "name" => "l_subtitle_slider2", "value" => null],
            ["component_id" => 5, "name" => "title_slider2", "value" => null],
            ["component_id" => 5, "name" => "image_slider2", "value" => null],
            ["component_id" => 5, "name" => "button_slider2", "value" => null],
            ["component_id" => 5, "name" => "link_slider2", "value" => null],
            ["component_id" => 5, "name" => "u_subtitle_slider3", "value" => null],
            ["component_id" => 5, "name" => "l_subtitle_slider3", "value" => null],
            ["component_id" => 5, "name" => "title_slider3", "value" => null],
            ["component_id" => 5, "name" => "image_slider3", "value" => null],
            ["component_id" => 5, "name" => "button_slider3", "value" => null],
            ["component_id" => 5, "name" => "link_slider3", "value" => null],
            ["component_id" => 5, "name" => "badge_text", "value" => "Limited time offer."],
            ["component_id" => 7, "name" => "upper_st", "value" => "NEW ARRIVALS"],
            ["component_id" => 7, "name" => "lower_st", "value" => "Starting from $9.99"],
            ["component_id" => 7, "name" => "title", "value" => "JEANS COLLECTION"],
            ["component_id" => 7, "name" => "btn_text", "value" => "SHOP NOW"],
            ["component_id" => 7, "name" => "btn_link", "value" => "#"],
            ["component_id" => 7, "name" => "image", "value" => "http://localhost/multivendor/public/frontend/asset..."],
            ["component_id" => 8, "name" => "title", "value" => "SPORTS ZONE"],
            ["component_id" => 8, "name" => "see_more", "value" => 1],
            ["component_id" => 8, "name" => "more_link", "value" => "#"],
            ["component_id" => 8, "name" => "sidebar", "value" => "slider"],
            ["component_id" => 8, "name" => "sidebar_position", "value" => "left"],
            ["component_id" => 8, "name" => "showcase_type", "value" => "newArrivals"],
            ["component_id" => 8, "name" => "u_subtitle_slide", "value" => null],
            ["component_id" => 8, "name" => "l_subtitle_banner", "value" => null],
            ["component_id" => 8, "name" => "title_banner", "value" => null],
            ["component_id" => 8, "name" => "image_banner", "value" => null],
            ["component_id" => 8, "name" => "button_banner", "value" => null],
            ["component_id" => 8, "name" => "link_banner", "value" => null],
            ["component_id" => 8, "name" => "u_subtitle_slider1", "value" => "SPORTS"],
            ["component_id" => 8, "name" => "l_subtitle_slider1", "value" => "SAFEGUARD YOUR"],
            ["component_id" => 8, "name" => "title_slider1", "value" => "MIND & BODY"],
            ["component_id" => 8, "name" => "image_slider1", "value" => "https://images.pexels.com/photos/6787498/pexels-photo-6787498.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"],
            ["component_id" => 8, "name" => "button_slider1", "value" => "GO NOW"],
            ["component_id" => 8, "name" => "link_slider1", "value" => "https://google.com"],
            ["component_id" => 8, "name" => "u_subtitle_slider2", "value" => "SPORTS"],
            ["component_id" => 8, "name" => "l_subtitle_slider2", "value" => "FLY HIGH WITH"],
            ["component_id" => 8, "name" => "title_slider2", "value" => "XDA BOOTS II"],
            ["component_id" => 8, "name" => "image_slider2", "value" => "https://images.pexels.com/photos/5851037/pexels-photo-5851037.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"],
            ["component_id" => 8, "name" => "button_slider2", "value" => "Go"],
            ["component_id" => 8, "name" => "link_slider2", "value" => "#"],
            ["component_id" => 8, "name" => "u_subtitle_slider3", "value" => "SPORTS"],
            ["component_id" => 8, "name" => "l_subtitle_slider3", "value" => "POWER UP YOUR"],
            ["component_id" => 8, "name" => "title_slider3", "value" => "ADVENTURES"],
            ["component_id" => 8, "name" => "image_slider3", "value" => "https://cdn.pixabay.com/photo/2020/05/26/07/43/skateboard-5221914_1280.jpg"],
            ["component_id" => 8, "name" => "button_slider3", "value" => "SHOP NOW"],
            ["component_id" => 8, "name" => "link_slider3", "value" => "#"],
            ["component_id" => 9, "name" => "title", "value" => "Popular Departments"],
            ["component_id" => 9, "name" => "disp_categories", "value" => '["flashSales","newArrivals"]'],
            ["component_id" => 9, "name" => "max", "value" => 10],
            ["component_id" => 10, "name" => "upper_st1", "value" => "ELECTRONICS"],
            ["component_id" => 10, "name" => "lower_st1", "value" => "ELECTROFY"],
            ["component_id" => 10, "name" => "title_1", "value" => "YOUR LIFE"],
            ["component_id" => 10, "name" => "full_card1", "value" => 1],
            ["component_id" => 10, "name" => "btn_text1", "value" => "SHOP NOW"],
            ["component_id" => 10, "name" => "btn_link1", "value" => "#"],
            ["component_id" => 10, "name" => "upper_st2", "value" => "SHOES"],
            ["component_id" => 10, "name" => "lower_st2", "value" => "ADD STYLES TO"],
            ["component_id" => 10, "name" => "title_2", "value" => "YOUR FEET"],
            ["component_id" => 10, "name" => "full_card2", "value" => 0],
            ["component_id" => 10, "name" => "btn_text2", "value" => "SHOP NOW"],
            ["component_id" => 10, "name" => "btn_link2", "value" => "#"],
            ["component_id" => 10, "name" => "image1", "value" => "https://images.unsplash.com/photo-1623998021669-c8e8ad5145b6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"],
            ["component_id" => 10, "name" => "image2", "value" => "https://images.unsplash.com/photo-1575425939273-46ecee6d6931?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80"],
            ["component_id" => 10, "name" => "upper_st3", "value" => null],
            ["component_id" => 10, "name" => "lower_st3", "value" => null],
            ["component_id" => 10, "name" => "title_3", "value" => null],
            ["component_id" => 10, "name" => "btn_text3", "value" => null],
            ["component_id" => 10, "name" => "btn_link3", "value" => null],
            ["component_id" => 10, "name" => "image3", "value" => null],
            ["component_id" => 10, "name" => "full_card", "value" => 0],
            ["component_id" => 12, "name" => "title", "value" => "Top Brands"],
            ["component_id" => 12, "name" => "brand_type", "value" => "topBrands"],
            ["component_id" => 13, "name" => "title", "value" => "Latest Blogs"],
            ["component_id" => 13, "name" => "brand_type", "value" => "latestBlogs"],
            ["component_id" => 14, "name" => "title", "value" => "Our Top Categories"],
            ["component_id" => 14, "name" => "category_type", "value" => "selectedCategories"],
            ["component_id" => 14, "name" => "categories", "value" => '["41","498","500","497","38","61","48","50","60"]'],
            ["component_id" => 15, "name" => "title", "value" => "BEST DEALS OF THE WEEK"],
            ["component_id" => 15, "name" => "see_more", "value" => 0],
            ["component_id" => 15, "name" => "more_link", "value" => null],
            ["component_id" => 15, "name" => "sidebar", "value" => "banner"],
            ["component_id" => 15, "name" => "sidebar_position", "value" => "left"],
            ["component_id" => 15, "name" => "showcase_type", "value" => "flashSales"],
            ["component_id" => 15, "name" => "u_subtitle_slide", "value" => "LIVING & LIFESTYLE"],
            ["component_id" => 15, "name" => "l_subtitle_banner", "value" => "DECORATE"],
            ["component_id" => 15, "name" => "title_banner", "value" => "YOUR HOME"],
            ["component_id" => 15, "name" => "image_banner", "value" => "https://images.unsplash.com/photo-1582131503261-fca1d1c0589f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"],
            ["component_id" => 15, "name" => "button_banner", "value" => "Shop Now"],
            ["component_id" => 15, "name" => "link_banner", "value" => null],
            ["component_id" => 15, "name" => "u_subtitle_slider1", "value" => null],
            ["component_id" => 15, "name" => "l_subtitle_slider1", "value" => null],
            ["component_id" => 15, "name" => "title_slider1", "value" => null],
            ["component_id" => 15, "name" => "image_slider1", "value" => null],
            ["component_id" => 15, "name" => "button_slider1", "value" => null],
            ["component_id" => 15, "name" => "link_slider1", "value" => null],
            ["component_id" => 15, "name" => "u_subtitle_slider2", "value" => null],
            ["component_id" => 15, "name" => "l_subtitle_slider2", "value" => null],
            ["component_id" => 15, "name" => "title_slider2", "value" => null],
            ["component_id" => 15, "name" => "image_slider2", "value" => null],
            ["component_id" => 15, "name" => "button_slider2", "value" => null],
            ["component_id" => 15, "name" => "link_slider2", "value" => null],
            ["component_id" => 15, "name" => "u_subtitle_slider3", "value" => null],
            ["component_id" => 15, "name" => "l_subtitle_slider3", "value" => null],
            ["component_id" => 15, "name" => "title_slider3", "value" => null],
            ["component_id" => 15, "name" => "image_slider3", "value" => null],
            ["component_id" => 15, "name" => "button_slider3", "value" => null],
            ["component_id" => 15, "name" => "link_slider3", "value" => null],
            ["component_id" => 16, "name" => "title", "value" => "Flash Sales"],
            ["component_id" => 16, "name" => "see_more", "value" => 0],
            ["component_id" => 16, "name" => "more_link", "value" => null],
            ["component_id" => 16, "name" => "sidebar", "value" => "flash_sale"],
            ["component_id" => 16, "name" => "sidebar_position", "value" => "left"],
            ["component_id" => 16, "name" => "showcase_type", "value" => "flashSales"],
            ["component_id" => 16, "name" => "u_subtitle_slide", "value" => null],
            ["component_id" => 16, "name" => "l_subtitle_banner", "value" => null],
            ["component_id" => 16, "name" => "title_banner", "value" => null],
            ["component_id" => 16, "name" => "image_banner", "value" => null],
            ["component_id" => 16, "name" => "button_banner", "value" => null],
            ["component_id" => 16, "name" => "link_banner", "value" => null],
            ["component_id" => 16, "name" => "u_subtitle_slider1", "value" => null],
            ["component_id" => 16, "name" => "l_subtitle_slider1", "value" => null],
            ["component_id" => 16, "name" => "title_slider1", "value" => null],
            ["component_id" => 16, "name" => "image_slider1", "value" => null],
            ["component_id" => 16, "name" => "button_slider1", "value" => null],
            ["component_id" => 16, "name" => "link_slider1", "value" => null],
            ["component_id" => 16, "name" => "u_subtitle_slider2", "value" => null],
            ["component_id" => 16, "name" => "l_subtitle_slider2", "value" => null],
            ["component_id" => 16, "name" => "title_slider2", "value" => null],
            ["component_id" => 16, "name" => "image_slider2", "value" => null],
            ["component_id" => 16, "name" => "button_slider2", "value" => null],
            ["component_id" => 16, "name" => "link_slider2", "value" => null],
            ["component_id" => 16, "name" => "u_subtitle_slider3", "value" => null],
            ["component_id" => 16, "name" => "l_subtitle_slider3", "value" => null],
            ["component_id" => 16, "name" => "title_slider3", "value" => null],
            ["component_id" => 16, "name" => "image_slider3", "value" => null],
            ["component_id" => 16, "name" => "button_slider3", "value" => null],
            ["component_id" => 16, "name" => "link_slider3", "value" => null],
            ["component_id" => 18, "name" => "upper_st", "value" => "NEW ARRIVALS"],
            ["component_id" => 18, "name" => "lower_st", "value" => "Starting from $9.99"],
            ["component_id" => 18, "name" => "title", "value" => "JEANS COLLECTION"],
            ["component_id" => 18, "name" => "btn_text", "value" => "SHOP NOW"],
            ["component_id" => 18, "name" => "btn_link", "value" => "#"],
            ["component_id" => 18, "name" => "image", "value" => "http://localhost/multivendor/public/frontend/asset..."],
            ["component_id" => 19, "name" => "title", "value" => "SPORTS ZONE"],
            ["component_id" => 19, "name" => "see_more", "value" => 1],
            ["component_id" => 19, "name" => "more_link", "value" => "#"],
            ["component_id" => 19, "name" => "sidebar", "value" => "slider"],
            ["component_id" => 19, "name" => "sidebar_position", "value" => "right"],
            ["component_id" => 19, "name" => "showcase_type", "value" => "newArrivals"],
            ["component_id" => 19, "name" => "u_subtitle_slide", "value" => null],
            ["component_id" => 19, "name" => "l_subtitle_banner", "value" => null],
            ["component_id" => 19, "name" => "title_banner", "value" => null],
            ["component_id" => 19, "name" => "image_banner", "value" => null],
            ["component_id" => 19, "name" => "button_banner", "value" => null],
            ["component_id" => 19, "name" => "link_banner", "value" => null],
            ["component_id" => 19, "name" => "u_subtitle_slider1", "value" => "SPORTS"],
            ["component_id" => 19, "name" => "l_subtitle_slider1", "value" => "SAFEGUARD YOUR"],
            ["component_id" => 19, "name" => "title_slider1", "value" => "MIND & BODY"],
            ["component_id" => 19, "name" => "image_slider1", "value" => "https://images.pexels.com/photos/6787498/pexels-photo-6787498.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"],
            ["component_id" => 19, "name" => "button_slider1", "value" => "GO NOW"],
            ["component_id" => 19, "name" => "link_slider1", "value" => "https://google.com"],
            ["component_id" => 19, "name" => "u_subtitle_slider2", "value" => "SPORTS"],
            ["component_id" => 19, "name" => "l_subtitle_slider2", "value" => "FLY HIGH WITH"],
            ["component_id" => 19, "name" => "title_slider2", "value" => "XDA BOOTS II"],
            ["component_id" => 19, "name" => "image_slider2", "value" => "https://images.pexels.com/photos/5851037/pexels-photo-5851037.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"],
            ["component_id" => 19, "name" => "button_slider2", "value" => "Go"],
            ["component_id" => 19, "name" => "link_slider2", "value" => "#"],
            ["component_id" => 19, "name" => "u_subtitle_slider3", "value" => "SPORTS"],
            ["component_id" => 19, "name" => "l_subtitle_slider3", "value" => "POWER UP YOUR"],
            ["component_id" => 19, "name" => "title_slider3", "value" => "ADVENTURES"],
            ["component_id" => 19, "name" => "image_slider3", "value" => "https://cdn.pixabay.com/photo/2020/05/26/07/43/skateboard-5221914_1280.jpg"],
            ["component_id" => 19, "name" => "button_slider3", "value" => "SHOP NOW"],
            ["component_id" => 19, "name" => "link_slider3", "value" => "#"],
            ["component_id" => 20, "name" => "title", "value" => "Popular Departments"],
            ["component_id" => 20, "name" => "disp_categories", "value" => '["flashSales","newArrivals"]'],
            ["component_id" => 20, "name" => "max", "value" => 10],
            ["component_id" => 21, "name" => "upper_st1", "value" => "ELECTRONICS"],
            ["component_id" => 21, "name" => "lower_st1", "value" => "ELECTROFY"],
            ["component_id" => 21, "name" => "title_1", "value" => "YOUR LIFE"],
            ["component_id" => 21, "name" => "full_card1", "value" => 1],
            ["component_id" => 21, "name" => "btn_text1", "value" => "SHOP NOW"],
            ["component_id" => 21, "name" => "btn_link1", "value" => "#"],
            ["component_id" => 21, "name" => "upper_st2", "value" => "SHOES"],
            ["component_id" => 21, "name" => "lower_st2", "value" => "ADD STYLES TO"],
            ["component_id" => 21, "name" => "title_2", "value" => "YOUR FEET"],
            ["component_id" => 21, "name" => "full_card2", "value" => 0],
            ["component_id" => 21, "name" => "btn_text2", "value" => "SHOP NOW"],
            ["component_id" => 21, "name" => "btn_link2", "value" => "#"],
            ["component_id" => 21, "name" => "image1", "value" => "https://images.unsplash.com/photo-1623998021669-c8e8ad5145b6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"],
            ["component_id" => 21, "name" => "image2", "value" => "https://images.unsplash.com/photo-1575425939273-46ecee6d6931?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80"],
            ["component_id" => 21, "name" => "upper_st3", "value" => null],
            ["component_id" => 21, "name" => "lower_st3", "value" => null],
            ["component_id" => 21, "name" => "title_3", "value" => null],
            ["component_id" => 21, "name" => "btn_text3", "value" => null],
            ["component_id" => 21, "name" => "btn_link3", "value" => null],
            ["component_id" => 21, "name" => "image3", "value" => null],
            ["component_id" => 21, "name" => "full_card", "value" => 0],
            ["component_id" => 23, "name" => "title", "value" => "Top Brands"],
            ["component_id" => 23, "name" => "brand_type", "value" => "topBrands"],
            ["component_id" => 24, "name" => "title", "value" => "Latest Blogs"],
            ["component_id" => 24, "name" => "brand_type", "value" => "latestBlogs"],
            ["component_id" => 25, "name" => "title", "value" => "Our Top Categories"],
            ["component_id" => 25, "name" => "category_type", "value" => "selectedCategories"],
            ["component_id" => 25, "name" => "categories", "value" => '["41","498","500","497","38","61","48","50","60"]']
        ]);
    }
}
