<div id="kt_aside" class="aside px-5" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="true"
    data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '285px'}"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 me-n4 pe-4" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_footer"
            data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="2px">
            <div class="menu menu-column menu-sub-indention menu-active-bg menu-state-primary menu-title-gray-700 fs-6 menu-rounded w-100 fw-semibold"
                id="#kt_aside_menu" data-kt-menu="true">
                <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                    @php
                        $listMenu = \App\Http\Controllers\HelperController::sidebarControll();
                    @endphp
                    @foreach ($listMenu as $item)
                        @if (array_intersect(session()->get('list_tipe_user'), $item['role']))
                            @if ($item['route'] == null)
                                <div data-kt-menu-trigger="click"
                                    class="menu-item menu-accordion @if (in_array($item['active'], $active)) show @endif">
                                    <span class="menu-link @if (in_array($item['active'], $active)) active @endif">
                                        <span class="menu-icon">
                                            <span class="svg-icon svg-icon-2">
                                                <?= $item['icon'] ?>
                                            </span>
                                        </span>
                                        <span class="menu-title">{{ $item['nama'] }}</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion">
                                        @foreach ($item['children'] as $child)
                                            @if (array_intersect(session()->get('list_tipe_user'), $child['role']))
                                                <div class="menu-item">
                                                    <a class="menu-link @if (in_array($child['active'], $active)) active @endif"
                                                        href="{{ route($child['route']) }}">
                                                        <span class="menu-bullet">
                                                            <?= $child['icon'] ?>
                                                        </span>
                                                        <span class="menu-title">{{ $child['nama'] }}</span>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="menu-item">
                                    <a class="menu-link @if (in_array($item['active'], $active)) active @endif"
                                        href="{{ route($item['route']) }}">
                                        <span class="menu-icon">
                                            <span class="svg-icon svg-icon-2">
                                                <?= $item['icon'] ?>
                                            </span>
                                        </span>
                                        <span class="menu-title">{{ $item['nama'] }}</span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="aside-footer flex-column-auto pt-3 pb-7" id="kt_aside_footer">
        <a href="javascript:" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover"
            data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label">Docs & Components</span>
            <span class="svg-icon btn-icon svg-icon-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3"
                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                        fill="currentColor" />
                    <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
                    <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
                    <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                </svg>
            </span>
        </a>
    </div> --}}
</div>
