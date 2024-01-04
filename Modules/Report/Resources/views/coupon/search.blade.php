<div id="filter-data">
    <div class="form-group" id="date-picker-field">
        <label for="to">{{ __('Date Range') }}</label>
        <button type="button" class="form-control date-range" id="daterange-btn">
            <span class="float-left">
              <i class="fa fa-calendar"></i>
              {{ __('Pick a date range')  }}
            </span>
            <i class="fa fa-caret-down float-right pt-1"></i>
        </button>
        <input class="form-control" id="startfrom" type="hidden" name="from" value="<?= isset($from) ? $from : '' ?>">
        <input class="form-control" id="endto" type="hidden" name="to" value="<?= isset($to) ? $to : '' ?>">
    </div>
    <div class="form-group" id="coupon-field">
        <label for="customer-name">{{ __('Coupon Code') }}</label>
        <input type="text" name="coupon_code" class="form-control" id="coupon-code" value="">
    </div>
    <div class="form-group" id="brand-field">
        <label for="customer-name">{{ __('Brand') }}</label>
        <input type="text" name="brand_name" class="form-control" id="brand-name" value="">
    </div> 
    <div class="form-group" id="category-field">
        <label for="customer-name">{{ __('Category') }}</label>
        <input type="text" name="category_name" class="form-control" id="category-name" value="">
    </div>
    <button type="submit" class="btn btn-default search-btn" data-loading="">
        {{ __('Filter') }}
    </button>
</div>

