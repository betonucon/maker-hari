<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lokasi;
use App\Jenistanaman;
use PDF;
use Session;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LokasiController extends Controller
{
    public function index(request $request){
        $link='lokasi';
        
        return view('admin.index',compact('link'));
    }
    public function index_tanaman(request $request){
        $link='tanaman';
        
        return view('admin.index_tanaman',compact('link'));
    }
    
    public function hapus($id){
        $data=Lokasi::where('id',$id)->delete();
        echo'ok';
    }
    public function hapus_tanaman($id){
        $data=Jenistanaman::where('id',$id)->delete();
        echo'ok';
    }

    

    public function ubah($id){
        $data=Lokasi::where('id',$id)->first();
        echo'
                <input type="hidden" name="id" id="id" value="'.$data['id'].'">
                <div class="form-group">
                    <label>Nama Lokasi </label>
                    <input type="text"  name="name"  value="'.$data['name'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kordinat 1 </label>
                    <input type="text"  name="kordinat_1"  value="'.$data['kordinat_1'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kordinat 2 </label>
                    <input type="text"  name="kordinat_2"  value="'.$data['kordinat_2'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text"  name="alamat"  value="'.$data['alamat'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label>Luas Tanah</label>
                    <input type="text"  name="pemilik"  value="'.$data['pemilik'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tanaman</label>
                    <select  name="jenis_tanaman"  class="form-control">
                        <option value="">Pilih Tanaman</option>';
                        foreach(jenistanaman() as $jenis){
                            if($data['jenis_tanaman']==$jenis['name']){$cek='selected';}else{$cek='';}
                            echo'<option value="'.$jenis['name'].'" '.$cek.'>'.$jenis['name'].'</option>';
                        }
                     echo'
                    </select>

                </div>
                <div class="form-group">
                    <label>Background</label>
                    <input type="file"  name="file"   class="form-control">
                    <input type="hidden"  name="edit_file"  value="'.$data['file'].'" class="form-control">
                </div>';

    }
    public function ubah_tanaman($id){
        $data=Jenistanaman::where('id',$id)->first();
        echo'
                <input type="hidden" name="id" id="id" value="'.$data['id'].'">
                <div class="form-group">
                    <label>Nama Tanaman </label>
                    <input type="text"  name="name"  value="'.$data['name'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label>icon</label>
                    <input type="file"  name="file"   class="form-control">
                    <input type="hidden"  name="edit_file"  value="'.$data['icon'].'" class="form-control">
                </div>';

    }
    public function cetak($id){
        $data=Kasir::where('id',$id)->first();
        echo'
            <input type="hidden" name="idnya" id="idnya" value="'.$data['id'].'">
            <table width="100%" bgcolor="#fff">
                <tr>
                    <td class="ttd" width="10%"></td>
                    <td class="ttd">No</td>
                    <td class="ttd">Keterangan</td>
                    <td class="ttd">Harga</th>
                    <td class="ttd" width="10%">&nbsp;</td>
                </tr>
                <tr>
                    <td class="ttd"></td>
                    <td  colspan="3" style="padding:0px;background:#fff" ><hr style="border:dotted 1px #000;margin:0px"></td>
                    <td class="ttd"></td>
                </tr>
                <tr>
                    <td class="ttd"></td>
                    <td class="ttd">1</td>
                    <td class="ttd">'.$data['keterangan'].'</td>
                    <td class="ttd">'.uang($data['harga']).'</td>
                    <td class="ttd"> </td>
                </tr>
            </table>';

    }
    public function view_data(request $request){
        $cek=strlen($request->jenis);
        echo'
            <table class="table table-hover" id="tampilkan">
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama</th>
                    <th>Alamat</th>
                    <th width="12%">Kordinat 1</th>
                    <th width="12%">Kordinat 2</th>
                    <th width="12%">Luas Tanah</th>
                    <th width="10%">Tanaman</th>
                    <th width="5%">file</th>
                    <th width="8%">Act</th>
                </tr>';
                if($cek>0){
                    $data=Lokasi::with(['jenistanaman'])->where('name','LIKE','%'.$request->name.'%')->orWhere('pemilik','LIKE','%'.$request->name.'%')->orWhere('alamat','LIKE','%'.$request->name.'%')->orderBy('id','Desc')->get();
                }else{
                    $data=Lokasi::with(['jenistanaman'])->orderBy('id','Desc')->get();
                }
                
                foreach($data as $no=>$o){
                    echo'    
                        <tr>
                            <td>'.($no+1).'</td>
                            <td>'.$o['name'].'</td>
                            <td>'.$o['alamat'].'</td>
                            <td>'.$o['kordinat_1'].'</td>
                            <td>'.$o['kordinat_2'].'</td>
                            <td>'.$o['pemilik'].'</td>
                            <td>'.$o['jenis_tanaman'].'</td>
                            <td><a href="_file/'.$o['file'].'" target="_blank"><span class="btn btn-success btn-xs"><i class="fa fa-clone"></i></span></a></td>
                            <td>
                                <span class="btn btn-success btn-xs" onclick="ubah('.$o['id'].')"><i class="fa fa-pencil"></i></span>_
                                <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                            </td>
                         </tr>';
                }
         echo'
            </table>
        ';
    }
    public function view_data_2(request $request){
        $cek=strlen($request->jenis);
        echo'
            <table class="table table-hover" id="tampilkan">
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama</th>
                    <th>Alamat</th>
                    <th width="12%">Kordinat 1</th>
                    <th width="12%">Kordinat 2</th>
                    <th width="12%">Pemilik</th>
                    <th width="10%">Tanaman</th>
                    <th width="5%">file</th>
                    <th width="8%">Act</th>
                </tr>';
                if($request->jenis=='all'){
                    $data=Lokasi::orderBy('id','Desc')->get();
                }else{
                    
                    $data=Lokasi::where('jenis_tanaman',$request->jenis)->orderBy('id','Desc')->get();
                }
               
                
                
                foreach($data as $no=>$o){
                    echo'    
                    <tr>
                        <td>'.($no+1).'</td>
                        <td>'.$o['name'].'</td>
                        <td>'.$o['alamat'].'</td>
                        <td>'.$o['kordinat_1'].'</td>
                        <td>'.$o['kordinat_2'].'</td>
                        <td>'.$o['pemilik'].'</td>
                        <td>'.$o['jenis_tanaman'].'</td>
                        <td><a href="_file/'.$o['file'].'" target="_blank"><span class="btn btn-success btn-xs"><i class="fa fa-clone"></i></span></a></td>
                        <td>
                            <span class="btn btn-success btn-xs" onclick="ubah('.$o['id'].')"><i class="fa fa-pencil"></i></span>_
                            <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                        </td>
                    </tr>';
                }
         echo'
            </table>
        ';
    }

    public function view_data_tanaman(request $request){
        $cek=strlen($request->jenis);
        echo'
            <table class="table table-hover" id="tampilkan">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th width="20%">Icon</th>
                    <th width="8%">Act</th>
                </tr>';
                if($cek>0){
                    $data=Jenistanaman::where('name',$request->jenis)->orderBy('id','Desc')->get();
                    
                }else{
                    $data=Jenistanaman::orderBy('id','Desc')->get();
                    
                }
               
                
                
                foreach($data as $no=>$o){
                    echo'    
                    <tr>
                        <td>'.($no+1).'</td>
                        <td>'.$o['name'].'</td>
                        <td><a href="'.$o['icon'].'" target="_blank"><span class="btn btn-success btn-xs"><i class="fa fa-clone"></i></span></a></td>
                        <td>
                            <span class="btn btn-success btn-xs" onclick="ubah('.$o['id'].')"><i class="fa fa-pencil"></i></span>_
                            <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                        </td>
                    </tr>';
                }
         echo'
            </table>
        ';
    }
    public function view_data_home(request $request){
        $cek=strlen($request->jenis);
        echo'
            <table class="table table-hover" id="tampilkan">
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama</th>
                    <th>Alamat</th>
                    <th width="12%">Kordinat 1</th>
                    <th width="12%">Kordinat 2</th>
                    <th width="12%">Luas Tanah</th>
                    <th width="10%">Tanaman</th>
                    <th width="5%">file</th>
                    <th width="8%">Act</th>
                </tr>';
                if($request->jenis=='all'){
                    $data=Lokasi::orderBy('id','Desc')->get();
                }else{
                    
                    $data=Lokasi::where('jenis_tanaman',$request->jenis)->orderBy('id','Desc')->get();
                }
               
                
                
                foreach($data as $no=>$o){
                    echo'    
                    <tr>
                        <td>'.($no+1).'</td>
                        <td>'.$o['name'].'</td>
                        <td>'.$o['alamat'].'</td>
                        <td>'.$o['kordinat_1'].'</td>
                        <td>'.$o['kordinat_2'].'</td>
                        <td>'.$o['pemilik'].'</td>
                        <td>'.$o['jenis_tanaman'].'</td>
                        <td><a href="_file/'.$o['file'].'" target="_blank"><span class="btn btn-success btn-xs"><i class="fa fa-clone"></i></span></a></td>
                        <td>
                            <span class="btn btn-success btn-xs" onclick="ubah('.$o['id'].')"><i class="fa fa-pencil"></i></span>_
                            <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                        </td>
                    </tr>';
                }
         echo'
            </table>
        ';
    }

    
    public function simpan(request $request){
        if (trim($request->name) == '') {$error[] = '- Nama  harus diisi';}
        if (trim($request->alamat) == '') {$error[] = '- Email  harus diisi';}
        if (trim($request->kordinat_1) == '') {$error[] = '- Kordinat 1  harus diisi';}
        if (trim($request->kordinat_2) == '') {$error[] = '- Kordinat 2  harus diisi';}
        if (trim($request->pemilik) == '') {$error[] = '- Pemilik harus diisi';}
        if (trim($request->jenis_tanaman) == '') {$error[] = '- Jenis Tanaman harus diisi';}
        if (trim($request->file) == '') {$error[] = '- Background  harus diisi';}
        
        if (isset($error)) {echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $patr='/([^0-9]+)/';
            // $harga=preg_replace($patr,'',$request->harga);

            $file=$_FILES['file']['name'];
            $size=$_FILES['file']['size'];
            $asli=$_FILES['file']['tmp_name'];
            $ukuran=getimagesize($_FILES["file"]['tmp_name']);
            $tipe=explode('/',$_FILES['file']['type']);
            $filename=date('Ymdhis').'.'.$tipe[1];
            $lokasi='_file/';

            if($tipe[0]=='image'){
                if(move_uploaded_file($asli, $lokasi.$filename)){
                    $data               =new Lokasi;
                    $data->alamat       = $request->alamat;
                    $data->name         = $request->name;
                    $data->pemilik      = $request->pemilik;
                    $data->kordinat_1   = $request->kordinat_1;
                    $data->kordinat_2   = $request->kordinat_2;
                    $data->jenis_tanaman   = $request->jenis_tanaman;
                    $data->file         = $filename;
                    $data->save();

                    if($data){
                        echo'ok';
                    }
                }
            }else{
                echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br /> File Harus Gambar</p>';
            }
                
        }
    }
    
    public function simpan_tanaman(request $request){
        if (trim($request->name) == '') {$error[] = '- Nama Tanaman harus diisi';}
        if (trim($request->file) == '') {$error[] = '- Icon  harus diisi';}
        
        if (isset($error)) {echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $patr='/([^0-9]+)/';
            // $harga=preg_replace($patr,'',$request->harga);

            $file=$_FILES['file']['name'];
            $size=$_FILES['file']['size'];
            $asli=$_FILES['file']['tmp_name'];
            $ukuran=getimagesize($_FILES["file"]['tmp_name']);
            $tipe=explode('/',$_FILES['file']['type']);
            $filename=date('Ymdhis').'.'.$tipe[1];
            $lokasi='img/';

            if($tipe[0]=='image'){
                if(move_uploaded_file($asli, $lokasi.$filename)){
                    $data               =new Jenistanaman;
                    $data->name         = $request->name;
                    $data->icon         = $filename;
                    $data->save();

                    if($data){
                        echo'ok';
                    }
                }
            }else{
                echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br /> File Harus Gambar</p>';
            }
                
        }
    }

    public function ubah_data(request $request){
        if (trim($request->name) == '') {$error[] = '- Nama  harus diisi';}
        if (trim($request->alamat) == '') {$error[] = '- Email  harus diisi';}
        if (trim($request->kordinat_1) == '') {$error[] = '- Kordinat 1  harus diisi';}
        if (trim($request->kordinat_2) == '') {$error[] = '- Kordinat 2  harus diisi';}
        if (trim($request->pemilik) == '') {$error[] = '- Pemilik harus diisi';}
        if (trim($request->jenis_tanaman) == '') {$error[] = '- Jenis Tanaman harus diisi';}
        if (isset($error)) {echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
           if($request->edit_file==''){
                $file=$_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $asli=$_FILES['file']['tmp_name'];
                $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                $tipe=explode('/',$_FILES['file']['type']);
                $filename=date('Ymdhis').'.'.$tipe[1];
                $lokasi='_file/';

                if($tipe[0]=='image'){
                    if(move_uploaded_file($asli, $lokasi.$filename)){
                        $data               =Lokasi::find($request->id);
                        $data->alamat       = $request->alamat;
                        $data->name         = $request->name;
                        $data->pemilik      = $request->pemilik;
                        $data->kordinat_1   = $request->kordinat_1;
                        $data->kordinat_2   = $request->kordinat_2;
                        $data->jenis_tanaman   = $request->jenis_tanaman;
                        $data->file         = $filename;
                        $data->save();

                        if($data){
                            echo'ok';
                        }
                    }
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br /> File Harus Gambar</p>';
                }
                
           }else{
               if($request->file==''){
                    $data               = Lokasi::find($request->id);
                    $data->alamat       = $request->alamat;
                    $data->name         = $request->name;
                    $data->pemilik      = $request->pemilik;
                    $data->kordinat_1   = $request->kordinat_1;
                    $data->jenis_tanaman   = $request->jenis_tanaman;
                    $data->kordinat_2   = $request->kordinat_2;
                    $data->save();
        
                    if($data){
                        echo'ok';
                    }
                    
               }else{
                    $file=$_FILES['file']['name'];
                    $size=$_FILES['file']['size'];
                    $asli=$_FILES['file']['tmp_name'];
                    $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                    $tipe=explode('/',$_FILES['file']['type']);
                    $filename=date('Ymdhis').'.'.$tipe[1];
                    $lokasi='_file/';

                    if($tipe[0]=='image'){
                        if(move_uploaded_file($asli, $lokasi.$filename)){
                            $data               =Lokasi::find($request->id);
                            $data->alamat       = $request->alamat;
                            $data->name         = $request->name;
                            $data->pemilik      = $request->pemilik;
                            $data->kordinat_1   = $request->kordinat_1;
                            $data->kordinat_2   = $request->kordinat_2;
                            $data->jenis_tanaman   = $request->jenis_tanaman;
                            $data->file         = $filename;
                            $data->save();

                            if($data){
                                echo'ok';
                            }
                        }
                    }else{
                        echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br /> File Harus Gambar</p>';
                    }
               }
           }


           
        }
    }

    public function ubah_data_tanaman(request $request){
        if (trim($request->name) == '') {$error[] = '- Nama Tanaman harus diisi';}
         
        if (isset($error)) {echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
           if($request->edit_file==''){
                $file=$_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $asli=$_FILES['file']['tmp_name'];
                $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                $tipe=explode('/',$_FILES['file']['type']);
                $filename=date('Ymdhis').'.'.$tipe[1];
                $lokasi='img/';

                if($tipe[0]=='image'){
                    if(move_uploaded_file($asli, $lokasi.$filename)){
                        $data               =Jenistanaman::find($request->id);
                        $data->name         = $request->name;
                        $data->icon         = $filename;
                        $data->save();

                        if($data){
                            echo'ok';
                        }
                    }
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br /> File Harus Gambar</p>';
                }
                
           }else{
               if($request->file==''){
                    $data               =Jenistanaman::find($request->id);
                    $data->name         = $request->name;
                    $data->save();

                    if($data){
                        echo'ok';
                    }
                    
               }else{
                    $file=$_FILES['file']['name'];
                    $size=$_FILES['file']['size'];
                    $asli=$_FILES['file']['tmp_name'];
                    $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                    $tipe=explode('/',$_FILES['file']['type']);
                    $filename=date('Ymdhis').'.'.$tipe[1];
                    $lokasi='img/';

                    if($tipe[0]=='image'){
                        if(move_uploaded_file($asli, $lokasi.$filename)){
                            $data               =Jenistanaman::find($request->id);
                            $data->name         = $request->name;
                            $data->icon         = $filename;
                            $data->save();

                            if($data){
                                echo'ok';
                            }
                        }
                    }else{
                        echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br /> File Harus Gambar</p>';
                    }
               }
           }


           
        }
    }

    public function cetak_pdf($mulai,$sampai){
       
        error_reporting(0);
        $data=Kasir::whereBetween('tanggal',[$mulai,$sampai])->orderBy('id','Desc')->get();

        $pdf = PDF::loadView('pdf.index', ['data'=>$data,'mulai'=>$mulai,'sampai'=>$sampai]);
        return $pdf->stream();
        
    }
}
