@if(count(config('cms.admin_languages', [])) > 1)
<div class="dropdown">
    <!--begin::Toggle-->
    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
            <img class="h-20px w-20px rounded-sm" src="{{ asset('uploads/settings/languages/' . mb_strtolower(app()->getLocale(), 'UTF-8') . '.png') }}" alt="" />
        </div>
    </div>
    <!--end::Toggle-->
    <!--begin::Dropdown-->
    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
        <!--begin::Nav-->
        <ul class="navi navi-hover py-4">
            <!--begin::Item-->
            @foreach(config('cms.admin_languages') as $langLocale => $langName)
            <li class="navi-item">
                <a href="{{ url()->current() }}?change_language={{ $langLocale }}" class="navi-link">
                    <span class="symbol symbol-20 mr-3">
                        <img src="{{ asset('uploads/settings/languages/' . mb_strtolower($langLocale, 'UTF-8') . '.png') }}" alt="{{ $langName }}" />
                    </span>
                    <span class="navi-text">{{ strtoupper($langLocale) }} ({{ $langName }})</span>
                </a>
            </li>
            @endforeach
            <!--end::Item-->
        </ul>
        <!--end::Nav-->
    </div>
    <!--end::Dropdown-->
</div>
@endif