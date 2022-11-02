<div class="relative c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show c-sidebar-show" x-data="{ open: false }" @click.away="open = false"@close.stop="open = false" id="sidebar">

        <div class="c-sidebar-brand d-md-down-none">
            {{ config('app.name', 'Laravel') }}
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/laporan">
                    Buat Laporan
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/show">
                    Laporan anda
                </a>
            </li>

            @if(Auth::check() && Auth::user()->level == "admin")
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/admin/kelola">
                    Kelola Laporan (Admin)
                </a>
            </li>
            @endif
            
            @if(Auth::check() && Auth::user()->level == "admin")
                <li class="c-sidebar-nav-title">Pengaturan</li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/action">
                     Action</a></li>
            @endif

            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="typography.html">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                </svg> Typography</a></li>

            <li class="c-sidebar-nav-title">Components</li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                </svg>
                Base</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"> Breadcrumb</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/cards.html"> Cards</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/carousel.html"> Carousel</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/collapse.html"> Collapse</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/jumbotron.html"> Jumbotron</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/list-group.html"> List group</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/navs.html"> Navs</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/pagination.html"> Pagination</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/popovers.html"> Popovers</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/progress.html"> Progress</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/scrollspy.html"> Scrollspy</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/switches.html"> Switches</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/tabs.html"> Tabs</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/tooltips.html"> Tooltips</a></li>
            </ul>
            </li>
        </ul>
        
</div>