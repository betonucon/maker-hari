<?php
function url_link(){
   $data='';

   return $data;
}
function bulan($bulan)
{
   Switch ($bulan){
      case '01' : $bulan="Januari";
         Break;
      case '02' : $bulan="Februari";
         Break;
      case '03' : $bulan="Maret";
         Break;
      case '04' : $bulan="April";
         Break;
      case '05' : $bulan="Mei";
         Break;
      case '06' : $bulan="Juni";
         Break;
      case '07' : $bulan="Juli";
         Break;
      case '08' : $bulan="Agustus";
         Break;
      case '09' : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}

function bln($id){
   if($id>9){
      $data=$id;
   }else{
      $data='0'.$id; 
   }

   return $data;
}

function uang($id){
   $data=number_format($id,0);

   return $data;
}

function total_transaksi($mulai,$sampai){
   $data=App\Kasir::whereBetween('tanggal',[$mulai,$sampai])->sum('harga');
   return $data;
}
function get_lokasi($id){
   if($id=='all'){
      $data=App\Lokasi::with(['jenistanaman'])->get();
   }else{
      $data=App\Lokasi::with(['jenistanaman'])->where('jenis_tanaman',$id)->get();
   }
   
   return $data;
}
function lokasi(){
   $data=App\Lokasi::with(['jenistanaman'])->get();
   return $data;
}
function jenistanaman(){
   $data=App\Jenistanaman::all();
   return $data;
}


?>