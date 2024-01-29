<!--CRUD-ITEM-TESTIMONIALSITEM-SUBMENU START-->
@can('testimonialsitem_access')
@if(config('cms.submenu_only_icons') == true)
<a href="{{ route('admin.testimonialsitems.index') }}" data-toggle="tooltip" data-theme="dark" title="{{ trans('global.list') }}" class="btn btn-light-primary btn-icon font-weight-bold mr-3">
    <i class="fas fa-list"></i>
</a>
@else
<a href="{{ route('admin.testimonialsitems.index') }}" class="btn btn-light-primary font-weight-bold mr-3">
    <i class="fas fa-list"></i>
    {{ trans('global.list') }}
</a>
@endif
@endcan
<!--CRUD-ITEM-TESTIMONIALSITEM-SUBMENU END-->
<!--CRUD-NEW-TESTIMONIALSITEM-SUBMENU-->