<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // -- trigger on after insert wishlist
        \DB::unprepared('
            CREATE TRIGGER `wishlists_AINS` AFTER INSERT ON `wishlists`
            FOR EACH ROW UPDATE items SET wish_count = (select count(item_id) from wishlists WHERE item_id = items.id) WHERE items.id = NEW.item_id
        ');

        // -- trigger on after delete wishlist
        \DB::unprepared('
            CREATE TRIGGER `wishlists_ADEL` AFTER DELETE ON `wishlists`
            FOR EACH ROW UPDATE items SET wish_count = (select count(item_id) from wishlists WHERE item_id = items.id) WHERE items.id = OLD.item_id
        ');

        // -- trigger on after insert review
        \DB::unprepared('
            CREATE TRIGGER `reviews_AINS` AFTER INSERT ON `reviews`
            FOR EACH ROW UPDATE items SET review_count = (select count(item_id) from reviews WHERE item_id = items.id AND is_public = "1" AND status = "Active"), review_average = (select avg(rating) from reviews WHERE item_id = items.id AND is_public = "1" AND status = "Active") WHERE items.id = NEW.item_id
        ');

        // -- trigger on after update review
        \DB::unprepared('
            CREATE TRIGGER `reviews_AUPD` AFTER UPDATE ON `reviews`
            FOR EACH ROW UPDATE items SET review_count = (select count(item_id) from reviews WHERE item_id = items.id AND is_public = "1" AND status = "Active"), review_average = (select avg(rating) from reviews WHERE item_id = items.id AND is_public = "1" AND status = "Active") WHERE items.id = NEW.item_id
        ');

        // -- trigger on after delete review
        \DB::unprepared('
            CREATE TRIGGER `reviews_ADEL` AFTER DELETE ON `reviews`
            FOR EACH ROW UPDATE items SET review_count = (select count(item_id) from reviews WHERE item_id = items.id AND is_public = "1" AND status = "Active"), review_average = (select avg(rating) from reviews WHERE item_id = items.id AND is_public = "1" AND status = "Active") WHERE items.id = OLD.item_id
        ');

        // -- trigger on after insert order details
        \DB::unprepared('
            CREATE TRIGGER `order_details_AINS` AFTER INSERT ON `order_details`
            FOR EACH ROW UPDATE items SET purchase_count = (select count(item_id) from order_details WHERE item_id = items.id) WHERE items.id = NEW.item_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared('DROP TRIGGER `order_details_AINS`');
        \DB::unprepared('DROP TRIGGER `reviews_ADEL`');
        \DB::unprepared('DROP TRIGGER `reviews_AINS`');
        \DB::unprepared('DROP TRIGGER `reviews_AUPD`');
        \DB::unprepared('DROP TRIGGER `wishlists_ADEL`');
        \DB::unprepared('DROP TRIGGER `wishlists_AINS`');
    }
}
