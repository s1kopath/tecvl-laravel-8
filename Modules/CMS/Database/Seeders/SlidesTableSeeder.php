<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;

class SlidesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('slides')->delete();

        \DB::table('slides')->insert(array (
            0 =>
            array (
                'id' => 1,
                'slider_id' => 1,
                'title_text' => 'Custom Men’s',
                'title_animation' => 'fadeIn',
                'title_delay' => 0.02,
                'title_font_color' => '#737373',
                'title_font_size' => 26,
                'title_direction' => 'left',
                'sub_title_text' => 'CASUAL SNEAKERS',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => 0.02,
                'sub_title_font_color' => '#000000',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'left',
                'description_title_text' => 'Sale up to 30% OFF',
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => 0.03,
                'description_title_font_color' => '#000000',
                'description_title_font_size' => 26,
                'description_title_direction' => 'left',
                'button_title' => 'Shop Now',
                'button_link' => 'https://www.google.com',
                'button_position' => 'Left',
                'is_open_in_new_window' => 'Yes',
            ),
            1 =>
            array (
                'id' => 2,
                'slider_id' => 1,
                'title_text' => 'Hena’s Lifestyle',
                'title_animation' => 'fadeIn',
                'title_delay' => 0.02,
                'title_font_color' => '#dcdbdb',
                'title_font_size' => 26,
                'title_direction' => 'left',
                'sub_title_text' => 'MODERN FURNITURES',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => 0.02,
                'sub_title_font_color' => '#ffffff',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'left',
                'description_title_text' => 'Sale up to 10% OFF',
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => 0.02,
                'description_title_font_color' => '#ffffff',
                'description_title_font_size' => 26,
                'description_title_direction' => 'left',
                'button_title' => 'Shop Now',
                'button_link' => 'https://www.google.com',
                'button_position' => 'Left',
                'is_open_in_new_window' => 'Yes',
            ),
            2 =>
            array (
                'id' => 3,
                'slider_id' => 1,
                'title_text' => 'Custom Men’s',
                'title_animation' => 'fadeIn',
                'title_delay' => 0.02,
                'title_font_color' => '#878787',
                'title_font_size' => 26,
                'title_direction' => 'left',
                'sub_title_text' => 'SPORTS GEAR',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => 0.02,
                'sub_title_font_color' => '#000000',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'left',
                'description_title_text' => 'Flash Sale up to 30% OFF',
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => 0.02,
                'description_title_font_color' => '#000000',
                'description_title_font_size' => 26,
                'description_title_direction' => 'left',
                'button_title' => 'Shop Now',
                'button_link' => 'https://www.google.com',
                'button_position' => 'Left',
                'is_open_in_new_window' => 'Yes',
            ),
            3 =>
            array (
                'id' => 4,
                'slider_id' => 1,
                'title_text' => 'CellHive Gadgets',
                'title_animation' => 'fadeIn',
                'title_delay' => 0.02,
                'title_font_color' => '#8c8c8c',
                'title_font_size' => 26,
                'title_direction' => 'left',
                'sub_title_text' => 'GEN V EARPHONES',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => 0.02,
                'sub_title_font_color' => '#000000',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'left',
                'description_title_text' => 'Sale up to 30% OFF',
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => 0.02,
                'description_title_font_color' => '#000000',
                'description_title_font_size' => 26,
                'description_title_direction' => 'left',
                'button_title' => 'Shop Now',
                'button_link' => 'https://www.google.com',
                'button_position' => 'Left',
                'is_open_in_new_window' => 'Yes',
            ),
        ));

    }
}
