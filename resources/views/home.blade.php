@extends('layouts.app_top')
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
        Daftar Lokasi Pertanian
        <small>Kota CIlegon</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Top Navigation</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
                <div id="map" style="width: 100%; height: 400px;"></div>
          </div>
          <div class="box">
            <div class="box-header" style="margin-bottom:1%">
              <!-- <h3 class="box-title"><span class="btn btn-success btn-sm" onclick="tambah()">Tambah Baru</span></h3> -->

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 400px;">
                  <select name="table_search" onchange="cari(this.value)" class="form-control pull-right" placeholder="Search">
                    <option value="all">Semua Tanaman</option>
                    @foreach(jenistanaman() as $jenis)
                        <option value="{{$jenis['name']}}">{{$jenis['name']}}</option>
                    @endforeach
                  </select>

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" ><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" id="tampilkan">
              
                
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
                    <label>Pemilik Pertanian</label>
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
				maxZoom: 20,
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
			 .bindPopup('Lokasi :'+locations[i][0]+'<br>Pemilik :'+locations[i][3]+'<br>Kordinat :'+locations[i][1]+','+locations[i][2]+'<br>Alamat :'+locations[i][5]+'<br>Tanaman :'+locations[i][6])
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
               url: "{{url('lokasi/view_data_2?jenis='.$jenistanam)}}",
               data: "id=id",
               success: function(msg){
                    $('#modalloading').modal('hide');
                   $("#tampilkan").html(msg);
                  
               }
           });

        });

        function cari(a){
           
            window.location.assign("{{url('home')}}?jenis="+a);
            
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