@if (array_intersect(['Modules\Blog\Http\Controllers\BlogCategoryController@index',
'Modules\Blog\Http\Controllers\BlogController@index'
], $prms)
)
<li data-username="Customer Supplier Team" class="nav-item pcoded-hasmenu {{ $menu == 'blog_category' ? 'pcoded-trigger active' : '' }}">
    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="fab fa-blogger-b"></i></span><span class="pcoded-mtext">{{ __('Blog') }}</span></a>
    <ul class="pcoded-submenu">
        @if (hasPermission('Modules\Blog\Http\Controllers\BlogCategoryController@index'))
            <li class="{{ isset($sub_menu) && $sub_menu == 'blog_category' ? 'active' : '' }}"><a href="{{ route('blog.category.index') }}" class="">{{ __('Category') }}</a></li>
        @endif
        @if (hasPermission('Modules\Blog\Http\Controllers\BlogController@index'))
            <li class="{{ isset($sub_menu) && $sub_menu == 'blog' ? 'active' : '' }}"><a href="{{ route('blog.index') }}" class="">{{ __('Post') }}</a></li>
        @endif
    </ul>
</li>
@endif