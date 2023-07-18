@extends('layouts.app_top_home')
<style>
    th{
        font-size:12px;
        background:#b0e6e6;
    }
    td{
        font-size:12px;
    }
    .ttd{
        border:solid 10x #000;
        background:#fff;
        padding:5px;
    }
</style>

@push('maap')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

    
@endpush
@section('content')
<section class="content-header">
    <h1>
        GIS Pertanian
        <small>Kota CIlegon</small>
    </h1>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          
            
                        

                <div class="col-md-8" style="padding-left: 0px;">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                <div class="item active">
                                    <img src="https://selatsunda.com/wp-content/uploads/2020/07/PROJEK-CILEGON-KOTA.mp4_000011752.jpg" style="width:100%;height:360px" alt="First slide">

                                    <div class="carousel-caption">
                                    First Slide
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="http://www.setda.cilegon.go.id/system/application/views/main-web/images/head2.jpg" style="width:100%;height:360px" alt="First slide">

                                    <div class="carousel-caption">
                                    First Slide
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="http://www.setda.cilegon.go.id/system/application/views/main-web/images/head2.jpg" style="width:100%;height:360px" alt="First slide">

                                    <div class="carousel-caption">
                                    First Slide
                                    </div>
                                </div>
                                
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                                </a>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-4" style="padding-left: 0px;">
                    <div class="box box-solid">
                        <div class="box-header with-border" style="background: #78c5c5;">
                            <h3 class="box-title">KOTA CILEGON</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="padding:4px;vertical-align:top;background-image:url({{url('img/map.png')}});height:330px;background-size:80%">
                            <div style="font-weight:bold;text-align:center">
                                Selamat Datang di Website Dinas Ketahanan Pangan dan Pertanian Kota Cilegon
                            </div>
                            <div style="font-weight:normal;padding:4%;background:#f9f9f9a3">
                                e-Government merupakan implementasi sistem manajemen pemerintahan berbasis teknologi informasi, dengan tujuan utama untuk 
                                meningkatkan kualitas layanan publik serta efisiensi, efektivitas, transparansi, dan akuntabilitas pemerintahan. e-Government 
                                merupakan bagian dari implementasi Cilegon Smart City pada elemen Smart Governance, melalui pemanfaatan website sebagai media 
                                omunikasi dalam konteks Government to Government, Government to Business, dan Government to Citizen.
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;">
                    <div class="box box-solid">
                        <div class="box-header with-border" style="border: 1px solid #f4f4f4;background:#f5e8e8">
                            <h3 class="box-title"> DINAS PERTANIAN KOTA CILEGON</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="border: 1px solid #f4f4f4;">

                                <b>"</b>Pertanian adalah kegiatan pemanfaatan sumber daya hayati yang dilakukan manusia untuk menghasilkan bahan pangan, bahan 
                                baku industri, atau sumber energi, serta untuk mengelola lingkungan hidupnya.[1] Kegiatan pemanfaatan sumber daya hayati yang 
                                termasuk dalam pertanian biasa dipahami orang sebagai budidaya tanaman atau bercocok tanam (bahasa Inggris: crop cultivation) 
                                serta pembesaran hewan ternak (raising), meskipun cakupannya dapat pula berupa pemanfaatan mikroorganisme dan bioenzim dalam 
                                pengolahan produk lanjutan, seperti pembuatan keju dan tempe, atau sekadar ekstraksi semata, seperti penangkapan ikan atau 
                                eksploitasi hutan. Bagian terbesar penduduk dunia bermata pencaharian dalam bidang-bidang di lingkup pertanian, namun pertanian 
                                hanya menyumbang 4% dari PDB dunia. Sejarah Indonesia sejak masa kolonial sampai sekarang tidak dapat dipisahkan dari sektor 
                                pertanian dan perkebunan, karena sektor - sektor ini memiliki arti yang sangat penting dalam menentukan pembentukan berbagai 
                                realitas ekonomi dan sosial masyarakat di berbagai wilayah Indonesia. Berdasarkan data BPS tahun 2002, bidang pertanian di 
                                Indonesia menyediakan lapangan kerja bagi sekitar 44,3% penduduk meskipun hanya menyumbang sekitar 17,3% dari total pendapatan 
                                domestik bruto.<b>"</b>

                        </div>
                    </div>
                </div>


            
        </div>
        <div class="col-xs-12">
            <div style="width:100%;height:30px;background:#dfdff3">
                  <small class="label pull-left bg-warning" style="background:#000;padding:7px;margin-right:0.3%"><i class="fa fa-bars"></i> KATEGORI</small>
                  @foreach(jenistanaman() as $jentam)
                    <a href="#" onclick="cari('{{$jentam['name']}}')"><small class="label pull-left bg-primary" style="padding:7px;margin-right:0.3%"><i class="fa fa-search"></i> {{$jentam['name']}}</small></a>
                  @endforeach 
            </div>
            <div id="map" style="width: 100%; height: 400px;"></div>
          
        
            
          <!-- /.box -->
        </div>
        <div class="col-xs-12">
          
            
                        

                
                <div class="col-md-12" style="padding-left: 0px;">
                    <div class="box box-solid">
                        <div class="box-header with-border" style="border: 1px solid #f4f4f4;background:#f5e8e8">
                            <h3 class="box-title"> DINAS PERTANIAN KOTA CILEGON</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="border: 1px solid #f4f4f4;">

                                <b>"</b>Pertanian adalah kegiatan pemanfaatan sumber daya hayati yang dilakukan manusia untuk menghasilkan bahan pangan, bahan baku industri, atau sumber energi, serta untuk mengelola lingkungan hidupnya.[1] Kegiatan pemanfaatan sumber daya hayati yang termasuk dalam pertanian biasa dipahami orang sebagai budidaya tanaman atau bercocok tanam (bahasa Inggris: crop cultivation) serta pembesaran hewan ternak (raising), meskipun cakupannya dapat pula berupa pemanfaatan mikroorganisme dan bioenzim dalam pengolahan produk lanjutan, seperti pembuatan keju dan tempe, atau sekadar ekstraksi semata, seperti penangkapan ikan atau eksploitasi hutan.

                                Bagian terbesar penduduk dunia bermata pencaharian dalam bidang-bidang di lingkup pertanian, namun pertanian hanya menyumbang 4% dari PDB dunia. Sejarah Indonesia sejak masa kolonial sampai sekarang tidak dapat dipisahkan dari sektor pertanian dan perkebunan, karena sektor - sektor ini memiliki arti yang sangat penting dalam menentukan pembentukan berbagai realitas ekonomi dan sosial masyarakat di berbagai wilayah Indonesia. Berdasarkan data BPS tahun 2002, bidang pertanian di Indonesia menyediakan lapangan kerja bagi sekitar 44,3% penduduk meskipun hanya menyumbang sekitar 17,3% dari total pendapatan domestik bruto.<b>"</b>

                        </div>
                    </div>
                </div>


            
        </div>
    </div>
</section>



<div class="modal fade" id="modalcetak" style="display: none;">
    <div class="modal-dialog" style="margin-top: 0%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Detail Lokasi</h4>
            </div>
            <div class="modal-body" >
               <div class="form-group">
                    <div id="gambar"></div>
                </div>
               <div class="form-group">
                    <label>Lokasi Pertanian</label>
                    <p id="name" ></p>
                </div>
               <div class="form-group">
                    <label>Jenis Tanaman</label>
                    <p id="jenis_tanaman" ></p>
                </div>
               <div class="form-group">
                    <label>Alamat Pertanian</label>
                    <p id="alamat" ></p>
                </div>
               <div class="form-group">
                    <label>Luas Tanah</label>
                    <p id="pemilik" ></p>
                </div>
               <div class="form-group">
                    <label>Kordinat </label>
                    <p id="link" ></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
                
            </div>
        </div>
    </div>
</div>

<div class="modal modal-fullscreen fade" id="modalloading" >
    <div class="modal-dialog" style="margin-top: 15%;">
        <div class="modal-content" style="background: transparent;">
            
            <div class="modal-body" style="text-align:center">
                <img src="{{url(url_link().'/img/loading.gif')}}" width="10%">
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('datatable')
    <script type="text/javascript">
        var locations = [
            @foreach(get_lokasi($jenistanam) as $lokasi)
			["{{$lokasi['name']}}", {{$lokasi['kordinat_1']}},{{$lokasi['kordinat_2']}},'{{$lokasi['pemilik']}}','<img src="{{url(url_link().'_file/'.$lokasi['file'])}}" style="width:100%;height:300px">','{{$lokasi['alamat']}}','{{$lokasi['jenis_tanaman']}}','{{$lokasi->jenistanaman['icon']}}'],
			@endforeach
        ];

        var LeafIcon = L.Icon.extend({
            options: {
                // shadowUrl: 'img/leaf-shadow.png',
                iconSize:     [30, 35],
                shadowSize:   [50, 64],
                iconAnchor:   [22, 94],
                shadowAnchor: [4, 62],
                popupAnchor:  [-3, -76]
            }
        });

       

		var map = L.map('map').setView([-5.9700368,106.040216], 12);
		mapLink =
		  '<a href="http://openstreetmap.org">OpenStreetMap</a>';
			L.tileLayer(
				'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '&copy; ' + mapLink + ' Contributors',
				maxZoom: 15,
		  }).addTo(map);

        for (var i = 0; i < locations.length; i++) {
             var greenIcon = new LeafIcon({iconUrl: locations[i][7]});
			  marker = new L.marker([locations[i][1], locations[i][2]],{
                icon: greenIcon,
                name: locations[i][0],
                pemilik: locations[i][3],
                alamat: locations[i][5],
                jenis_tanaman: locations[i][6],
                gambar:  locations[i][4]
              })
			 .bindPopup('Lokasi :'+locations[i][0]+'<br>Luas Tanah :'+locations[i][3]+'<br>Kordinat :'+locations[i][1]+','+locations[i][2]+'<br>Alamat :'+locations[i][5]+'<br>Tanaman :'+locations[i][6])
			 .on('click', markerOnClick).addTo(map);
		}

        function markerOnClick(e){
            var name = this.options.name;
            var pemilik = this.options.pemilik;
            var alamat = this.options.alamat;
            var jenis_tanaman = this.options.jenis_tanaman;
            var gambar = this.options.gambar;
            var coord=e.latlng.toString().split(',');
            var lat=coord[0].split('(');
            var long=coord[1].split(')');
            // alert("you clicked the map at LAT: "+ lat[1]+" and LONG:"+long[0])
            $('#ling').html(lat[1]+','+long[0]);
            $('#name').html(name);
            $('#pemilik').html(pemilik);
            $('#jenis_tanaman').html(jenis_tanaman);
            $('#alamat').html(alamat);
            $('#gambar').html(gambar);
            $('#modalcetak').modal('show');
        }
    </script>
    <script>


        
        function tambah(){
            $('#modal-default').modal({backdrop: 'static', keyboard: false});
        }

        //$('#modalcetak').modal({backdrop: 'static', keyboard: false});
       
        $(document).ready(function() {
            $.ajax({
               type: 'GET',
               url: "{{url('view_data_home?jenis='.$jenistanam)}}",
               data: "id=id",
               success: function(msg){
                    $('#modalloading').modal('hide');
                   $("#tampilkan").html(msg);
                  
               }
           });

        });

        function cari(a){
           
            window.location.assign("{{url('/')}}?jenis="+a);
            
        }
        function cek(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('kasir/cek')}}/"+a,
               data: "id=id",
               success: function(msg){
                    $('#modalloading').modal('hide');
                    $("#tampilkan").load("{{url('kasir/view_data')}}");
                  
               }
           });
            
        }
        function uncek(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('kasir/uncek')}}/"+a,
               data: "id=id",
               success: function(msg){
                    $('#modalloading').modal('hide');
                    $("#tampilkan").load("{{url('kasir/view_data')}}");
                  
               }
           });
            
        }
        function kirim_email()
        {
           var idnya=$('#idnya').val();
           $.ajax({
               type: 'GET',
               url: "{{url('kasir/kirim_email')}}/"+idnya,
               data: "id=id",
               beforeSend: function(){
                    $('#modalloading').modal({backdrop: 'static', keyboard: false});
               },
               success: function(msg){
                   $('#modalloading').modal('hide');
                   $("#notifcetak").html(msg);
                  
               }
           });
            
        }

        function hapus(a){
            if (confirm('Apakah yakin akan menghapus data ini?')) {
                $.ajax({
                    type: 'GET',
                    url: "{{url('kasir/hapus')}}/"+a,
                    data: "id=id",
                    beforeSend: function(){
                                $('#modalloading').modal({backdrop: 'static', keyboard: false});
                        },
                    success: function(msg){
                            $('#modalloading').modal('hide');
                            $("#tampilkan").load("{{url('kasir/view_data')}}");
                        
                    }
                });
            }

        }
        
        function ubah(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('kasir/ubah')}}/"+a,
               data: "id=id",
               success: function(msg){
                   $("#tampilkanubah").html(msg);
                   $('#modalubah').modal({backdrop: 'static', keyboard: false});
                  
               }
           });
            
        }

        function cetak(a){
           
            $("#printableArea").load("{{url('kasir/cetak')}}/"+a);
            $('#modalcetak').modal({backdrop: 'static', keyboard: false});
            
        }

        function simpan_data(){
            var form=document.getElementById('mysimpan_data');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/kasir/simpan')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('#modalloading').modal({backdrop: 'static', keyboard: false});
                    },
                    success: function(msg){
                        var res = msg.split("|");
                        if(res[0]=='ok'){
                            $('#modal-default').modal('hide');
                            $('#modalloading').modal('hide');
                            $("#tampilkan").load("{{url('kasir/view_data')}}");
                            $("#printableArea").load("{{url('kasir/cetak')}}/"+res[1]);
                            $('#modalcetak').modal({backdrop: 'static', keyboard: false});
                               
                        }else{
                            $('#modalloading').modal('hide');
                            $('#simpan_data').show();
                            $('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 

        function ubah_data(){
            var form=document.getElementById('myubah_data');
                var id=$('#id').val();
                $.ajax({
                    type: 'POST',
                    url: "{{url('/kasir/ubah_data')}}/"+id,
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('#modalloading').modal({backdrop: 'static', keyboard: false});
                    },
                    success: function(msg){
                        
                        if(msg=='ok'){
                            $('#modalubah').modal('hide');
                            $('#modalloading').modal('hide');
                            $("#tampilkan").load("{{url('kasir/view_data')}}");
                        }else{
                            $('#modalloading').modal('hide');
                            $('#notifikasiubah').html(msg);
                        }
                        
                        
                    }
                });

        } 

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
    
@endpush