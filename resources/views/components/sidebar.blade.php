<div class="relative c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show c-sidebar-show" x-data="{ open: false }" @click.away="open = false"@close.stop="open = false" id="sidebar">

        <div class="c-sidebar-brand d-md-down-none">
            <p>Menu </p>
        </div>
        <ul class="c-sidebar-nav">
            @if(Auth::check() && Auth::user()->level == "2")
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/laporan">
                    Buat Laporan
                </a>
            </li>
	   @endif
	   
           @if(Auth::check() && Auth::user()->level == "2")
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/show">
                    Laporan anda
                </a>
            </li>
          @endif

            @if(Auth::check() && Auth::user()->level == "admin")
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/admin/kelola">
                    Kelola Laporan (Admin)
                </a>
            </li>
            @endif

            @if(Auth::check() && Auth::user()->level == "admin")
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/admin/showdata">
                    Lihat Data Laporan (Admin)
                </a>
            </li>
            @endif
            
            @if(Auth::check() && Auth::user()->level == "admin")
                <li class="c-sidebar-nav-title">Pengaturan</li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/action">
                     Pengaturan Admin</a></li>
            @endif
        </ul>
        
</div>
