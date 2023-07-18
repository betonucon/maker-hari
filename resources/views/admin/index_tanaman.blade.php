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
 <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
 
 <script>
  function initialize() {
  
        var locations = [
                ['<h5>Ibukota Provinsi Aceh</h5>', 5.550176, 95.319263],
                ['<h5>Ibukota Kab.Aceh Jaya</h5>', 4.727890, 95.601373],
                ['<h5>Ibukota Abdya</h5>', 3.818570, 96.831841],
                ['<h5>Ibukota Kotamadya Langsa</h5>', 4.476020, 97.952447],
                ['<h5>Ibukota Kotamadya Sabang</h5>', 5.909284, 95.304742]  
        
        ];
    
        var infowindow = new google.maps.InfoWindow();
        var options = {
            zoom: 8, 
            center: new google.maps.LatLng(4.845582, 96.271539),
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
        Daftar Tanaman
        <small>Kota Cilegon</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Daftar Tanaman</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          
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
    <div class="modal-dialog" style="margin-top: 0%;">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Tanaman Baru</h4>
            </div>
            <div class="modal-body">
                <div id="notifikasi"></div>
                <form method="post" id="mysimpan_data" enctype="multipart/form-data">
                    @csrf
                    
                        <div class="form-group">
                            <label>Nama Tanaman </label>
                            <input type="text"  name="name"  value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>icon</label>
                            <input type="file"  name="file"  value="" class="form-control">
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
            <h4 class="modal-title">Ubah Tanaman</h4>
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
               url: "{{url('tanaman/view_data')}}",
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
               url: "{{url('tanaman/view_data')}}?name="+a,
               data: "id=id",
               success: function(msg){
                    $('#modalloading').modal('hide');
                   $("#tampilkan").html(msg);
                  
               }
           });
            
        }
        

        function hapus(a){
            if (confirm('Apakah yakin akan menghapus data ini?')) {
                $.ajax({
                    type: 'GET',
                    url: "{{url('tanaman/hapus')}}/"+a,
                    data: "id=id",
                    beforeSend: function(){
                                $('#modalloading').modal({backdrop: 'static', keyboard: false});
                        },
                    success: function(msg){
                            $('#modalloading').modal('hide');
                            $("#tampilkan").load("{{url('tanaman/view_data')}}");
                        
                    }
                });
            }

        }
        
        function ubah(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('tanaman/ubah')}}/"+a,
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
                    url: "{{url('/tanaman/simpan')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        var res = msg.split("|");
                        if(res[0]=='ok'){
                            $('#modal-default').modal('hide');
                            $("#tampilkan").load("{{url('tanaman/view_data')}}");
                            
                        }else{
                            $('#simpan_data').show();
                            $('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 

        function ubah_data(){
            var form=document.getElementById('myubah_data');
                
                $.ajax({
                    type: 'POST',
                    url: "{{url('/tanaman/ubah_data')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        
                        if(msg=='ok'){
                            $('#modalubah').modal('hide');
                            
                            $("#tampilkan").load("{{url('tanaman/view_data')}}");
                        }else{
                            
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