<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
    <!--begin::Header Menu-->
    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">

        @if(Setting::get('theme_aside_enable') == 0)
        <!--begin::Header Logo-->
        <div class="header-logo">
            <a href="{{ route("admin.dashboard") }}" title="{{ trans('global.dashboard') }}" >
                <img src="{{ asset('uploads/settings/logo.svg') }}" alt="{{ config('cms.site_title') }}"  class="w-100px" />
            </a>
        </div>
        <!--end::Header Logo-->
        @endif

        <!--begin::Header Nav-->
        <ul class="menu-nav">

            @if(Setting::get('theme_header_menu') != 0)
            <li class="menu-item {{ request()->is(config('cms.admin_panel_url')) ? "menu-item-active" : "" }}" aria-haspopup="true">
                <a href="{{ route("admin.dashboard") }}" title="{{ trans('global.dashboard') }}" class="menu-link">
                    <i class="menu-icon la la-home"></i>
                    <span class="menu-text">{{ trans('global.dashboard') }}</span>
                </a>
            </li>
            @if($menu_pages === true)
            <li class="{{ request()->is(config('cms.admin_panel_url') . "/page/*") ? "menu-item-active" : "" }}  menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon la la-file-text-o"></i>
                    <span class="menu-text">{{ trans('global.pages') }}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                    <ul class="menu-subnav">
                        <!--CRUD-NEW-PAGE-->
                    </ul>
                </div>
            </li>
            @endif
            @if($menu_modules === true)
            <li class="{{ request()->is(config('cms.admin_panel_url') . "/module/*") ? "menu-item-active" : "" }}  menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon la la-list-alt"></i>
                    <span class="menu-text">{{ trans('global.modules') }}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                    <ul class="menu-subnav">
                        <!--CRUD-NEW-ITEM-->
                    </ul>
                </div>
            </li>
            @endif
            <li class="{{ request()->is(config('cms.admin_panel_url') . "/core/*") ? "menu-item-active" : "" }}  menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon la la-gear"></i>
                    <span class="menu-text">{{ trans('global.settings') }}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                    <ul class="menu-subnav">
                        @can('filemanager_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/core/filemanager") || request()->is(config('cms.admin_panel_url')."/core/filemanager") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
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
                </div>
            </li>
            @endif

        </ul>
        <!--end::Header Nav-->
    </div>
    <!--end::Header Menu-->
</div>