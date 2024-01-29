<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item {{ request()->is(config('cms.admin_panel_url')) ? "menu-item-active" : "" }}" aria-haspopup="true">
                <a href="{{ route("admin.dashboard") }}" title="{{ trans('global.dashboard') }}" class="menu-link">
                    <i class="menu-icon la la-home"></i>
                    <span class="menu-text">{{ trans('global.dashboard') }}</span>
                </a>
            </li>
            @if($menu_pages === true)
            <li class="menu-section">
                <h4 class="menu-text">{{ trans('global.pages') }}</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            <!--CRUD-ITEM-HOMEPAGES START-->
            @can('homepage_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/page/homepage") || request()->is(config('cms.admin_panel_url')."/page/homepage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.homepages.edit", 1) }}" title="{{ trans('cruds.homepage') }}" class="menu-link">
                    <i class="menu-icon la la la-file"></i>
                    <span class="menu-text">{{ trans('cruds.homepage') }}</span>
                </a>
            </li>
            @endcan
            <!--CRUD-ITEM-HOMEPAGES END-->
            <!--CRUD-ITEM-SERVICESPAGES START-->
            @can('servicespage_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/page/servicespage") || request()->is(config('cms.admin_panel_url')."/page/servicespage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.servicespages.edit", 1) }}" title="{{ trans('cruds.servicespage') }}" class="menu-link">
                    <i class="menu-icon la la la-file"></i>
                    <span class="menu-text">{{ trans('cruds.servicespage') }}</span>
                </a>
            </li>
            @endcan
            <!--CRUD-ITEM-SERVICESPAGES END-->
            <!--CRUD-ITEM-PORTFOLIOPAGES START-->
            @can('portfoliopage_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/page/portfoliopage") || request()->is(config('cms.admin_panel_url')."/page/portfoliopage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.portfoliopages.edit", 1) }}" title="{{ trans('cruds.portfoliopage') }}" class="menu-link">
                    <i class="menu-icon la la la-file"></i>
                    <span class="menu-text">{{ trans('cruds.portfoliopage') }}</span>
                </a>
            </li>
            @endcan
            <!--CRUD-ITEM-PORTFOLIOPAGES END-->
            <!--CRUD-ITEM-APPROACHPAGES START-->
            @can('approachpage_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/page/approachpage") || request()->is(config('cms.admin_panel_url')."/page/approachpage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.approachpages.edit", 1) }}" title="{{ trans('cruds.approachpage') }}" class="menu-link">
                    <i class="menu-icon la la la-file"></i>
                    <span class="menu-text">{{ trans('cruds.approachpage') }}</span>
                </a>
            </li>
            @endcan
            <!--CRUD-ITEM-APPROACHPAGES END-->
            <!--CRUD-ITEM-ABOUTUSPAGES START-->
            @can('aboutuspage_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/page/aboutuspage") || request()->is(config('cms.admin_panel_url')."/page/aboutuspage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.aboutuspages.edit", 1) }}" title="{{ trans('cruds.aboutuspage') }}" class="menu-link">
                    <i class="menu-icon la la la-file"></i>
                    <span class="menu-text">{{ trans('cruds.aboutuspage') }}</span>
                </a>
            </li>
            @endcan
            <!--CRUD-ITEM-ABOUTUSPAGES END-->
            <!--CRUD-ITEM-BLOGPAGES START-->
            @can('blogpage_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/page/blogpage") || request()->is(config('cms.admin_panel_url')."/page/blogpage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.blogpages.edit", 1) }}" title="{{ trans('cruds.blogpage') }}" class="menu-link">
                    <i class="menu-icon la la la-file"></i>
                    <span class="menu-text">{{ trans('cruds.blogpage') }}</span>
                </a>
            </li>
            @endcan
            <!--CRUD-ITEM-BLOGPAGES END-->
            <!--CRUD-ITEM-CONTACTSPAGES START-->
            @can('contactspage_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/page/contactspage") || request()->is(config('cms.admin_panel_url')."/page/contactspage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.contactspages.edit", 1) }}" title="{{ trans('cruds.contactspage') }}" class="menu-link">
                    <i class="menu-icon la la la-file"></i>
                    <span class="menu-text">{{ trans('cruds.contactspage') }}</span>
                </a>
            </li>
            @endcan
            <!--CRUD-ITEM-CONTACTSPAGES END-->
            <!--CRUD-NEW-PAGE-->
            @endif
            @if($menu_modules === true)
            <li class="menu-section">
                <h4 class="menu-text">{{ trans('global.modules') }}</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            <!--CRUD-NEW-ITEM-->
            @endif
            <li class="menu-section">
                <h4 class="menu-text">{{ trans('global.settings') }}</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            @can('filemanager_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/core/filemanager") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("elfinder.index") }}" title="{{ trans('global.filemanager') }}" class="menu-link">
                    <i class="menu-icon la la-folder-open"></i>
                    <span class="menu-text">{{ trans('global.filemanager') }}</span>
                </a>
            </li>
            @endcan
            @can('translations_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/core/translations") || request()->is(config('cms.admin_panel_url')."/core/translations/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route('languages.translations.index', config('app.locale')) }}" title="{{ trans('global.translation') }}" class="menu-link">
                    <i class="menu-icon la la-language"></i>
                    <span class="menu-text">{{ trans('global.translation') }}</span>
                </a>
            </li>
            @endcan
            @can('settings_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/core/settings") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.settings.edit") }}" title="{{ trans('global.settings') }}" class="menu-link">
                    <i class="menu-icon la la-gear"></i>
                    <span class="menu-text">{{ trans('global.settings') }}</span>
                </a>
            </li>
            @endcan
            @can('role_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/core/roles") || request()->is(config('cms.admin_panel_url')."/core/roles/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.roles.index") }}" title="{{ trans('global.roles') }}" class="menu-link">
                    <i class="menu-icon la la-shield"></i>
                    <span class="menu-text">{{ trans('global.roles') }}</span>
                </a>
            </li>
            @endcan
            @can('user_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/core/users") || request()->is(config('cms.admin_panel_url')."/core/users/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("admin.users.index") }}" title="{{ trans('global.users') }}" class="menu-link">
                    <i class="menu-icon la la-user-cog"></i>
                    <span class="menu-text">{{ trans('global.users') }}</span>
                </a>
            </li>
            @endcan
            @can('health_access')
            <li class="{{ request()->is(config('cms.admin_panel_url')."/core/health/panel") || request()->is(config('cms.admin_panel_url')."/core/health/panel/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                <a href="{{ route("pragmarx.health.panel") }}" title="{{ trans('global.health_monitor') }}" class="menu-link">
                    <i class="menu-icon la la-tachometer-alt"></i>
                    <span class="menu-text">{{ trans('global.health_monitor') }}</span>
                </a>
            </li>
            @endcan
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>