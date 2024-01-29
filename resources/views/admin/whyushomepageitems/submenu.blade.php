<!--CRUD-ITEM-WHYUSHOMEPAGEITEM-SUBMENU START-->
@can('whyushomepageitem_access')
@if(config('cms.submenu_only_icons') == true)
<a href="{{ route('admin.whyushomepageitems.index') }}" data-toggle="tooltip" data-theme="dark" title="{{ trans('global.list') }}" class="btn btn-light-primary btn-icon font-weight-bold mr-3">
    <i class="fas fa-list"></i>
</a>
@else
<a href="{{ route('admin.whyushomepageitems.index') }}" class="btn btn-light-primary font-weight-bold mr-3">
    <i class="fas fa-list"></i>
    {{ trans('global.list') }}
</a>
@endif
@endcan
<!--CRUD-ITEM-WHYUSHOMEPAGEITEM-SUBMENU END-->
<!--CRUD-NEW-WHYUSHOMEPAGEITEM-SUBMENU-->