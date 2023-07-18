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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4MbxSp2ECycQtzfmNM6wBodUjfiYdqfg&callback=initMap" async defer></script>
 
<script type="text/javascript">
    function initMap() {
    
            var locations = [
                    ['<h5>Masjiiiid</h5>', -6.018509,106.1125405] 
            
            ];
        
            var infowindow = new google.maps.InfoWindow();
            var options = {
                zoom: 10, 
                center: new google.maps.LatLng(-5.9681588,105.9777304),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
        

            // Pembuatan petanya
            var map = new google.maps.Map(document.getElementById('map_canvas'), options);
            var marker, i;

            // proses penambahan marker pada masing-masing lokasi yang berbeda
            for (i = 0; i < locations.length; i++) {  
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
        
            });
            
            // marker.addListener("click", () => {
            //         alert(marker.getPosition());
            // });
        
            // Menampilkan informasi pada masing-masing marker yang diklik 
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
                }
            })(marker, i));
            }
    
    };
 </script>
@endpush
@section('content')
<section class="content-header">
    <h1>
        Daftar Transaksi E-Kasir
        <small>EB_17   asaas</small>
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
                <div id="map_canvas" style="width: 100%; height: 600px;"></div>
          </div>
          <div class="box">
            <div class="box-header" style="margin-bottom:1%">
              <h3 class="box-title"><span class="btn btn-success btn-sm" onclick="tambah()">Tambah Baru</span></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 400px;">
                  <input type="text" name="table_search" onkeyup="cari(this.value)" class="form-control pull-right" placeholder="Search">

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

<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog" style="margin-top: 2%;">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Trasaksi Baru</h4>
            </div>
            <div class="modal-body">
                <div id="notifikasi"></div>
                <form method="post" id="mysimpan_data" enctype="multipart/form-data">
                    @csrf
                    
                        <div class="form-group">
                            <label>Nama Konsumen </label>
                            <input type="text"  name="name"  value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email </label>
                            <input type="email"  name="email"  value="" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"  rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text"  name="harga" id="rupiah" value="" class="form-control">
                        </div>
                        
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpan_data()">Simpan Data</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalubah" style="display: none;">
    <div class="modal-dialog" style="margin-top: 5%;">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Trasaksi Baru</h4>
            </div>
            <div class="modal-body">
                <div id="notifikasiubah"></div>
                <form method="post" id="myubah_data" enctype="multipart/form-data">
                    @csrf
                    
                    <div id="tampilkanubah"></div>
                        
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="ubah_data()">Simpan Data</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalcetak" style="display: none;">
    <div class="modal-dialog" style="margin-top: 5%;">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Cetak</h4>
            </div>
            <div id="notifcetak"></div>
            <div class="modal-body" id="printableArea" style="background:aqua;text-align:center">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printDiv('printableArea')">Cetak</button>
                <button type="button" class="btn btn-default pull-left" onclick="kirim_email()">Kirim Email</button>
                
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
 
    <script>


        
        function tambah(){
            $('#modal-default').modal({backdrop: 'static', keyboard: false});
        }

        //$('#modalcetak').modal({backdrop: 'static', keyboard: false});
       
        $(document).ready(function() {
            $.ajax({
               type: 'GET',
               url: "{{url('kasir/view_data')}}",
               data: "id=id",
               beforeSend: function(){
                    $('#modalloading').modal({backdrop: 'static', keyboard: false});
                    
               },
               success: function(msg){
                    $('#modalloading').modal('hide');
                   $("#tampilkan").html(msg);
                  
               }
           });

        });

        function cari(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('kasir/view_data')}}?name="+a,
               data: "id=id",
               success: function(msg){
                    $('#modalloading').modal('hide');
                   $("#tampilkan").html(msg);
                  
               }
           });
            
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