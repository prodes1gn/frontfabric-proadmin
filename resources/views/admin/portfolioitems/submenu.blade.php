<!--CRUD-ITEM-PORTFOLIOITEM-SUBMENU START-->
@can('portfolioitem_access')
@if(config('cms.submenu_only_icons') == true)
<a href="{{ route('admin.portfolioitems.index') }}" data-toggle="tooltip" data-theme="dark" title="{{ trans('global.list') }}" class="btn btn-light-primary btn-icon font-weight-bold mr-3">
    <i class="fas fa-list"></i>
</a>
@else
<a href="{{ route('admin.portfolioitems.index') }}" class="btn btn-light-primary font-weight-bold mr-3">
    <i class="fas fa-list"></i>
    {{ trans('global.list') }}
</a>
@endif
@endcan
<!--CRUD-ITEM-PORTFOLIOITEM-SUBMENU END-->
<!--CRUD-NEW-PORTFOLIOITEM-SUBMENU-->