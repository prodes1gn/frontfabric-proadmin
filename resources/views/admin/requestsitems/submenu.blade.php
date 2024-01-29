<!--CRUD-ITEM-REQUESTSITEM-SUBMENU START-->
@can('requestsitem_access')
@if(config('cms.submenu_only_icons') == true)
<a href="{{ route('admin.requestsitems.index') }}" data-toggle="tooltip" data-theme="dark" title="{{ trans('global.list') }}" class="btn btn-light-primary btn-icon font-weight-bold mr-3">
    <i class="fas fa-list"></i>
</a>
@else
<a href="{{ route('admin.requestsitems.index') }}" class="btn btn-light-primary font-weight-bold mr-3">
    <i class="fas fa-list"></i>
    {{ trans('global.list') }}
</a>
@endif
@endcan
<!--CRUD-ITEM-REQUESTSITEM-SUBMENU END-->
<!--CRUD-NEW-REQUESTSITEM-SUBMENU-->