<!--CRUD-ITEM-SYSTEMPAGESITEM-SUBMENU START-->
@can('systempagesitem_access')
@if(config('cms.submenu_only_icons') == true)
<a href="{{ route('admin.systempagesitems.index') }}" data-toggle="tooltip" data-theme="dark" title="{{ trans('global.list') }}" class="btn btn-light-primary btn-icon font-weight-bold mr-3">
    <i class="fas fa-list"></i>
</a>
@else
<a href="{{ route('admin.systempagesitems.index') }}" class="btn btn-light-primary font-weight-bold mr-3">
    <i class="fas fa-list"></i>
    {{ trans('global.list') }}
</a>
@endif
@endcan
<!--CRUD-ITEM-SYSTEMPAGESITEM-SUBMENU END-->
<!--CRUD-NEW-SYSTEMPAGESITEM-SUBMENU-->