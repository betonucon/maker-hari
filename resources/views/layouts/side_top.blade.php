<ul class="nav navbar-nav">
    <li class="@if($link=='home') active @endif"><a href="{{url('/')}}">Home </a></li>
    <li class="@if($link=='cek_lokasi') active @endif"><a href="{{url('/cek_lokasi')}}">Cek Lokasi Pertanian </a></li>
    <li class="@if($link=='lokasi') active @endif"><a href="{{url('/lokasi')}}">Daftar Lokasi Pertanian </a></li>
    <li class="@if($link=='tanaman') active @endif"><a href="{{url('/tanaman')}}">Daftar Tanaman </a></li>
    <!-- <li class="@if($link=='laporan') active @endif"><a href="{{url('laporan')}}">Laporan Keuangan </a></li> -->
   
    <!-- <li><a href="#">Link</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
        </ul>
    </li> -->
</ul>