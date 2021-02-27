<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Session;
Use App\Models\CekiModel;
Use App\Models\CekiUrunModel;

class CekiController extends Controller
{   

    public function cekikaydet(Request $req)
    {


      if(isset($req->duzenle))
      {
        $ceki =CekiModel::find($req->id);
        $ceki->musteri = $req->firma;
        $ceki->aciklama = $req->aciklama;
         $ceki->sevk_durum = $req->sevk_durum;
        $ceki->save();
      }
      else
      {
        $ceki = new CekiModel();
        $ceki->musteri = $req->firma;
         $ceki->aciklama = $req->aciklama;
        $ceki->sevk_durum = $req->sevk_durum;
        $ceki->save();
        $cekiurun = CekiUrunModel::where('ceki_id', Session::get('cekid'))->get();
        foreach($cekiurun as $value)
        {
          $value->ceki_id = $ceki->id;
          $value->save(); 
        }
       

        $req->session()->forget('cekid');
      }
        
        
        return redirect()->route('cekilistesi');
    }
    public function cekisil(Request $req)
    {
      $id = $_GET['id'];
      $ceki = CekiModel::find($id);
      $ceki->delete();

      $ceki_urun = CekiUrunModel::where('ceki_id', $id)->get();
      foreach($ceki_urun as $value)
        {
        
          $value->delete();
        }
        return redirect()->route('cekilistesi');
    }
    public function cekiurunsil(Request $req)
    {
      $cekiurun = CekiUrunModel::find($req->id);
      $cekiurun->delete();
      if(isset($req->typer))
      {
        foreach(\App\Models\CekiUrunModel::where('ceki_id', $req->typer)->orderBy('id','DESC')->get() as $val)
        {
      
         $kumas = \App\Models\KumasModel::where('id', $val->kumas_id)->first();
         $kalite = \App\Models\KaliteModel::where('barkod', $val->barkod)->first();
         echo '<tr>
         <td>'.$val->barkod.'</td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_kalite" class="form-control duzenle3" value="'.$val->kalite.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_parti" class="form-control duzenle3" value="'.$val->parti_no.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_metre" class="form-control duzenle3" value="'.$val->metre.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_kumas_tipi" class="form-control duzenle3" value="'.$kalite->kumas_tipi.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_lot_no"  class="form-control duzenle3" value="'.$kalite->lot.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_aciklama" class="form-control duzenle3" value="'.$val->aciklama.'"></td>
         <td><button type="button" onclick="CekiUrunSil('.$val->id.');" > Sil</button></td>
         </tr>';
        }
      }
      else
      {
        foreach(\App\Models\CekiUrunModel::where('ceki_id', $req->session()->get('cekid'))->orderBy('id','DESC')->get() as $val)
        {
       $kalite = \App\Models\KaliteModel::where('barkod', $val->barkod)->first();
         $kumas = \App\Models\KumasModel::where('id', $val->kumas_id)->first();
         
         echo '<tr>
         <td>'.$val->barkod.'</td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_kalite" class="form-control duzenle3" value="'.$val->kalite.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_parti" class="form-control duzenle3" value="'.$val->parti_no.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_metre" class="form-control duzenle3" value="'.$val->metre.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_kumas_tipi" class="form-control duzenle3" value="'.$kumas->kumas_tipi.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_lot_no"  class="form-control duzenle3" value="'.$kumas->lot_no.'"></td>
         <td> <input  data-id="'.$val->id.'" data-type="kumas_aciklama" class="form-control duzenle3" value="'.$val->aciklama.'"></td>
         <td><button type="button" onclick="CekiUrunSil('.$val->id.');" > Sil</button></td>
         </tr>';
        }
      }
     

    }
    public function cekiurunduzenle(Request $req)
    {
        $cekiurun = CekiUrunModel::find($req->id);
        if($req->type == "kumas_metre")
        {
          $cekiurun->metre= $req->value;
        }
        elseif($req->type == "kumas_kalite")
        {
          $cekiurun->kalite= $req->value;
        }
        elseif($req->type == "kumas_parti")
        {
          $cekiurun->parti_no= $req->value;
        }
        elseif($req->type == "kumas_kumas_tipi")
        {
          $cekiurun->kumas_tipi= $req->value;
        }
        elseif($req->type == "en")
        {
          $cekiurun->en= $req->value;
        }
        elseif($req->type == "kumas_lot_no")
        {
          $cekiurun->lot= $req->value;
        }
        elseif($req->type == "kumas_aciklama")
        {
          $cekiurun->aciklama= $req->value;
        }
        else
        {
          echo "Hata";
        }
       
        $cekiurun->save();
    }
    public function index(Request $req)
    {
     
     if($req->session()->has('cekid'))
     {

      
     }
     else
     {
      $random = rand();
      $req->session()->put('cekid', $random);
     
     }
     
      return view('inc.cekikaydet');
    }
    public function barkod2(Request $req)
    {

      
      
     if($kalite = \App\Models\KaliteModel::where('barkod', $req->id)->count() >0)
     {


    
        $ceki =   \App\Models\CekiUrunModel::where('barkod', $req->id)->first();
        $ceki->delete();
        
        $kalite = \App\Models\KaliteModel::where('barkod', $req->id)->first();
        $kumas = \App\Models\KumasModel::where('id', $kalite->kumas_id)->first();
        $cekiurun = new CekiUrunModel();
        if(isset($req->typer))
        {
          $cekiurun->ceki_id = $req->typer;
        }
        else
        {
          $cekiurun->ceki_id = $req->session()->get('cekid');
        }
       
        $cekiurun->barkod = $req->id;
        $cekiurun->kalite = $kalite->kalite;
        $cekiurun->kg = $kalite->kg;
        $cekiurun->kumas_tipi = $kumas->kumas_tipi;
        $cekiurun->metre = $kalite->metre;
        $cekiurun->parti_no = $kalite->parti;
        $cekiurun->en = $kalite->en;
        $cekiurun->lot = $kalite->lot;
        $cekiurun->kumas_id = $kalite->kumas_id;
        $cekiurun->aciklama ="";
        
        $cekiurun->save();
     
  
     }
     else
     {
      $hatamesaji =  "Bulunamadı...";
      return response()->json(['hata'=>1,'mesaj'=>  $hatamesaji]);
     }
      


}
      

    
    public function barkod(Request $req)
    {

      
      
     if($kalite = \App\Models\KaliteModel::where('barkod', $req->id)->count() >0)
     {


        if($req->sil == "1")
        {
            $ceki =   \App\Models\CekiUrunModel::where('barkod', $req->id)->first();
            $ceki->delete();
        
        
          $kalite = \App\Models\KaliteModel::where('barkod', $req->id)->first();
        $kumas = \App\Models\KumasModel::where('id', $kalite->kumas_id)->first();
        $cekiurun = new CekiUrunModel();
        if(isset($req->typer))
        {
          $cekiurun->ceki_id = $req->typer;
        }
        else
        {
          $cekiurun->ceki_id = $req->session()->get('cekid');
        }
       
        $cekiurun->barkod = $req->id;
        $cekiurun->kalite = $kalite->kalite;
        $cekiurun->kg = $kalite->kg;
        $cekiurun->kumas_tipi = $kumas->kumas_tipi;
        $cekiurun->metre = $kalite->metre;
        $cekiurun->parti_no = $kalite->parti;
        $cekiurun->en = $kalite->en;
        $cekiurun->lot = $kalite->lot;
        $cekiurun->kumas_id = $kalite->kumas_id;
        $cekiurun->aciklama ="";
        
        $cekiurun->save();
        
        }
        else
        {
            
            
     if(\App\Models\CekiUrunModel::where('barkod', $req->id)->count() > 0)
      {
            $cekiid =   \App\Models\CekiUrunModel::where('barkod', $req->id)->first()->id;
        $hatamesaji =  "Bu Ürün Zaten Gönderilmiş...";
        return response()->json(['hata'=>1,'mesaj'=>  $hatamesaji,'ceki_id' =>$cekiid]);
        
      }
      else
      {
          
      
        
         $kalite = \App\Models\KaliteModel::where('barkod', $req->id)->first();
        $kumas = \App\Models\KumasModel::where('id', $kalite->kumas_id)->first();
        $cekiurun = new CekiUrunModel();
        if(isset($req->typer))
        {
          $cekiurun->ceki_id = $req->typer;
        }
        else
        {
          $cekiurun->ceki_id = $req->session()->get('cekid');
        }
       
        $cekiurun->barkod = $req->id;
        $cekiurun->kalite = $kalite->kalite;
        $cekiurun->kg = $kalite->kg;
        $cekiurun->kumas_tipi = $kumas->kumas_tipi;
        $cekiurun->metre = $kalite->metre;
        $cekiurun->parti_no = $kalite->parti;
        $cekiurun->en = $kalite->en;
        $cekiurun->lot = $kalite->lot;
        $cekiurun->kumas_id = $kalite->kumas_id;
        $cekiurun->aciklama ="";
        
        $cekiurun->save();
        
        }
        
        }
        
     
       
       
 
     }
     else
     {
      $hatamesaji =  "Bulunamadı...";
      return response()->json(['hata'=>1,'mesaj'=>  $hatamesaji]);
     }
      


}
      

    }


