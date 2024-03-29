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
                        <!--CRUD-ITEM-HOMEPAGES START-->
                        @can('homepage_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/page/homepage") || request()->is(config('cms.admin_panel_url')."/page/homepage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.homepages.edit", 1) }}" title="{{ trans('cruds.homepage') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.homepage') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-HOMEPAGES END-->
                        <!--CRUD-ITEM-SERVICESPAGES START-->
                        @can('servicespage_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/page/servicespage") || request()->is(config('cms.admin_panel_url')."/page/servicespage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.servicespages.edit", 1) }}" title="{{ trans('cruds.servicespage') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.servicespage') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-SERVICESPAGES END-->
                        <!--CRUD-ITEM-PORTFOLIOPAGES START-->
                        @can('portfoliopage_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/page/portfoliopage") || request()->is(config('cms.admin_panel_url')."/page/portfoliopage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.portfoliopages.edit", 1) }}" title="{{ trans('cruds.portfoliopage') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.portfoliopage') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-PORTFOLIOPAGES END-->
                        <!--CRUD-ITEM-APPROACHPAGES START-->
                        @can('approachpage_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/page/approachpage") || request()->is(config('cms.admin_panel_url')."/page/approachpage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.approachpages.edit", 1) }}" title="{{ trans('cruds.approachpage') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.approachpage') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-APPROACHPAGES END-->
                        <!--CRUD-ITEM-ABOUTUSPAGES START-->
                        @can('aboutuspage_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/page/aboutuspage") || request()->is(config('cms.admin_panel_url')."/page/aboutuspage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.aboutuspages.edit", 1) }}" title="{{ trans('cruds.aboutuspage') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.aboutuspage') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-ABOUTUSPAGES END-->
                        <!--CRUD-ITEM-BLOGPAGES START-->
                        @can('blogpage_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/page/blogpage") || request()->is(config('cms.admin_panel_url')."/page/blogpage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.blogpages.edit", 1) }}" title="{{ trans('cruds.blogpage') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.blogpage') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-BLOGPAGES END-->
                        <!--CRUD-ITEM-CONTACTSPAGES START-->
                        @can('contactspage_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/page/contactspage") || request()->is(config('cms.admin_panel_url')."/page/contactspage/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.contactspages.edit", 1) }}" title="{{ trans('cruds.contactspage') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.contactspage') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-CONTACTSPAGES END-->
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
                        <!--CRUD-ITEM-SERVICEITEMS START-->
                        @can('serviceitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/serviceitems") || request()->is(config('cms.admin_panel_url')."/module/serviceitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.serviceitems.index") }}" title="{{ trans('cruds.serviceitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.serviceitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-SERVICEITEMS END-->
                        <!--CRUD-ITEM-WHYUSHOMEPAGEITEMS START-->
                        @can('whyushomepageitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/whyushomepageitems") || request()->is(config('cms.admin_panel_url')."/module/whyushomepageitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.whyushomepageitems.index") }}" title="{{ trans('cruds.whyushomepageitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.whyushomepageitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-WHYUSHOMEPAGEITEMS END-->
                        <!--CRUD-ITEM-TESTIMONIALSITEMS START-->
                        @can('testimonialsitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/testimonialsitems") || request()->is(config('cms.admin_panel_url')."/module/testimonialsitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.testimonialsitems.index") }}" title="{{ trans('cruds.testimonialsitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.testimonialsitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-TESTIMONIALSITEMS END-->
                        <!--CRUD-ITEM-APPPROACHITEMS START-->
                        @can('appproachitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/appproachitems") || request()->is(config('cms.admin_panel_url')."/module/appproachitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.appproachitems.index") }}" title="{{ trans('cruds.appproachitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.appproachitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-APPPROACHITEMS END-->
                        <!--CRUD-ITEM-PORTFOLIOITEMS START-->
                        @can('portfolioitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/portfolioitems") || request()->is(config('cms.admin_panel_url')."/module/portfolioitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.portfolioitems.index") }}" title="{{ trans('cruds.portfolioitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.portfolioitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-PORTFOLIOITEMS END-->
                        <!--CRUD-ITEM-BLOGITEMS START-->
                        @can('blogitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/blogitems") || request()->is(config('cms.admin_panel_url')."/module/blogitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.blogitems.index") }}" title="{{ trans('cruds.blogitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.blogitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-BLOGITEMS END-->
                        <!--CRUD-ITEM-REQUESTSITEMS START-->
                        @can('requestsitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/requestsitems") || request()->is(config('cms.admin_panel_url')."/module/requestsitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.requestsitems.index") }}" title="{{ trans('cruds.requestsitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.requestsitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-REQUESTSITEMS END-->
                        <!--CRUD-ITEM-SYSTEMPAGESITEMS START-->
                        @can('systempagesitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/systempagesitems") || request()->is(config('cms.admin_panel_url')."/module/systempagesitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.systempagesitems.index") }}" title="{{ trans('cruds.systempagesitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.systempagesitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-SYSTEMPAGESITEMS END-->
                        <!--CRUD-ITEM-SERVICEPOINTITEMS START-->
                        @can('servicepointitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/servicepointitems") || request()->is(config('cms.admin_panel_url')."/module/servicepointitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.servicepointitems.index") }}" title="{{ trans('cruds.servicepointitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.servicepointitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-SERVICEPOINTITEMS END-->
                        <!--CRUD-ITEM-VALUESITEMS START-->
                        @can('valuesitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/valuesitems") || request()->is(config('cms.admin_panel_url')."/module/valuesitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.valuesitems.index") }}" title="{{ trans('cruds.valuesitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.valuesitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-VALUESITEMS END-->
                        <!--CRUD-ITEM-BLOGCATEGORYITEMS START-->
                        @can('blogcategoryitem_access')
                        <li class="{{ request()->is(config('cms.admin_panel_url')."/module/blogcategoryitems") || request()->is(config('cms.admin_panel_url')."/module/blogcategoryitems/*") ? "menu-item-active" : "" }} menu-item" aria-haspopup="true">
                            <a href="{{ route("admin.blogcategoryitems.index") }}" title="{{ trans('cruds.blogcategoryitems') }}" class="menu-link">
                                <i class="menu-icon la la-file"></i>
                                <span class="menu-text">{{ trans('cruds.blogcategoryitems') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!--CRUD-ITEM-BLOGCATEGORYITEMS END-->
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