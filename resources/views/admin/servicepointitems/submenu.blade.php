<!--CRUD-ITEM-SERVICEPOINTITEM-SUBMENU START-->
@can('servicepointitem_access')
@if(config('cms.submenu_only_icons') == true)
<a href="{{ route('admin.servicepointitems.index') }}" data-toggle="tooltip" data-theme="dark" title="{{ trans('global.list') }}" class="btn btn-light-primary btn-icon font-weight-bold mr-3">
    <i class="fas fa-list"></i>
</a>
@else
<a href="{{ route('admin.servicepointitems.index') }}" class="btn btn-light-primary font-weight-bold mr-3">
    <i class="fas fa-list"></i>
    {{ trans('global.list') }}
</a>
@endif
@endcan
<!--CRUD-ITEM-SERVICEPOINTITEM-SUBMENU END-->
<!--CRUD-NEW-SERVICEPOINTITEM-SUBMENU-->