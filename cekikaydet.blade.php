@extends('layouts.app')


@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link href="{{ asset('assets/css/sec.css')}}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>


$(function () {
    $('.js-example-basic-single').select2();
  });

</script>
<style>
.select2-container--default .select2-selection--single{
    background-color: #2e304a;
    border: 1px solid #353957;

}

.select2-search--dropdown{
    background-color: #2e304a;
    color: #a5a6ad !important; ;
}
.select2-search__field{
    background-color: #2e304a;
    color: #a5a6ad !important; ;
}
.select2-results { 
    background-color: #2e304a;
    color: #a5a6ad !important; ;
}

</style>
@endsection


@section('content')


    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Çeki Oluştur</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Panel</a></li>
                         
                            <li class="breadcrumb-item ">Çekiler</li>
                            <li class="breadcrumb-item active">Çeki Oluştur</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Cari Oluştur</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="container">
                                                <form action="{{ route('cariekle') }}" method="post" >
                                                @csrf
                                                    <div class="row">
                                                  
                                                    <div class="form-group col-md-6">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Firma Adı  </label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" type="text" name="firma_adi"  id="example-text-input">
                                                            </div>
                                                       </div>   

                                                       <div class="form-group col-md-6">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Yetkili</label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" type="text"  name="yetkili" id="example-text-input">
                                                            </div>
                                                       </div>  
                                                       <div class="form-group col-md-6">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">E-Mail Adresi</label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" type="text"  name="email" id="example-text-input">
                                                            </div>
                                                       </div>    
                                                       <div class="form-group col-md-6">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Logo</label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" type="file" name="logo" id="example-text-input">
                                                            </div>
                                                       </div> 
                                                       <div class="form-group col-md-6">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Telefon 1</label>
                                                            <div class="col-sm-12">
                                                             <input class="form-control" type="tel" name="tel1" id="example-tel-input"/>
                                                            </div>
                                                       </div>   
                                                       <div class="form-group col-md-6">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Telefon 2</label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" type="tel" name="tel2"  id="example-tel-input"/>
                                                            </div>
                                                       </div>   
                                                       <div class="form-group col-md-6">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Vergi Dairesi</label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" type="text" name="vergi_daire"  id="example-text-input">
                                                            </div>
                                                       </div> 
                                                       <div class="form-group col-md-6">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Vergi Numarası</label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" type="text" name="vergi_no" id="example-text-input">
                                                            <input class="form-control" style="display:none" type="text" value="0" name="tip" id="example-text-input">
                                                            </div>
                                                       </div> 
                                                       <div class="form-group col-md-12">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Fatura Adresi</label>
                                                            <div class="col-sm-12">
                                                            <textarea id="textarea" class="form-control" name="adres"  rows="3" ></textarea>
                                                            </div>
                                                       </div> 
                                                       <div class="form-group col-md-12">
                                                            <label for="example-text-input" class="col-sm-5 col-form-label">Sevk Adresi</label>
                                                            <div class="col-sm-12">
                                                            <textarea id="textarea" class="form-control" name="adres2" rows="3" ></textarea>
                                                            </div>
                                                       </div> 
                                                       
                                                       <div class="form-group col-md-12">
                                                       <button type="button" class="btn btn-danger waves-effect waves-light">İptal Et</button>
                                                       <button type="submit" class="btn btn-success waves-effect waves-light">Kaydet</button>
                                                       </div> 
                                                       </form>
                                                    </div>
                                                </div>
                                                    
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>


        <div class="row">
            <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                        <div class="container">
                        <h3>Siparis Bilgileri</h3>
                        <hr style="border:blue 1px solid"></hr>
                                                <form action="{{ route('cekikaydet') }}" id="formgonder" method="post" >
                                                @csrf
                                                    <div class="row">
                                                  
                                                  
                                                       <div class="form-group col-md-12">
                                                       <label for="example-text-input" class="col-sm-5 col-form-label">Firma Seçiniz >> <a href="" data-toggle="modal" data-target=".bs-example-modal-lg">  <i class="mdi mdi-pencil-remove-outline"></i> Cari Oluştur</a>
                                                    </label>  
                                                    <div class="col-sm-12">
                                                            <select  class="js-example-basic-single form-control" style="height:80px" id="firma" name="firma">
                                                                <option value="0">Seçiniz</option>
                                                                  @foreach(\App\Models\CariModel::where('tip','0')->get() as $val)
                                                                <option value="{{$val->id}}">{{$val->firma_adi}}</option>


                                                                @endforeach
                                                            </select>
                                                            <br></br>
                                                            <input type="text" name="aciklama" clas="form-control" style="width:400px;height:40px;" placeholder="Açıklama">
                                                            </div>
                                                       </div>
                                                      
                                                       
                                                      
                                                      
                                                      
                                                    
                                                    </div>
                                                </div>
                                                    
                                                </div>

                        </div>
                    </div>
              

              
               
            </div> <!-- end row -->  


<div class="row">
            <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                        <div class="container">
                      
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                            
                        </div>
                        
                         <div style="margin-bottom:12px" class="col-sm-6 col-md-6">
                                                          
                                                           <select style="background-color:orange;color:#fff"  class="form-control"  id="ceki_durum" name="sevk_durum">
                                                                 <option value="0">Sevk Olmadı</option>
                                                                 <option value="1">Sevk Oldu</option>
                                                           </select>
                                                       </div>
                                                        
                                                       </br>
                                                       
                        <div class="col-md-4">
                             <label>Toplam Metre : </label> <label id="metreler1"></label> 
                             </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><button style="float:right" type="button" onclick="gonder();" class="btn btn-success waves-effect waves-light">Çekiyi Kaydet</button></div>
                        </div>
                        </form>
                        
                        <hr style="border:blue 1px solid"></hr>
                        <div class="col-md-5 mt-2 mb-2">
                        <input type="text" id="barkod" name="" class="form-control" placeholder="Barkod Numarası">
                       

                        <label style="color:red" id="hatamesaji"></label>
                        </div>
                      
                        <table  class="table table-striped mb-0 table-editable">
                                <thead>
                                <tr>
  <th>Sıra</th>
                                    <th>Barkod</th>
                                    <th>Kalite</th>
                                    <th>Parti No</th>
                                    <th>Metre</th>
                                   
                                    <th>Kumaş</th>
                                    <th>Lot</th>
                                      <th>En</th>
                                    <th>Açıklama</th>
                                    <th>İşlem</th>
                                </tr>
                                </thead>
                                <tbody id="gelenbarkod">
                                @if(Session::has('cekid'))
                                @php
                                $siraa = 1;
                                $cekiurun = Session::get('cekid');
                               
                                @endphp
                               
                                @else
                                $cekiurun = "";

                                @endphp
                                @endif
                                @php
                                                               $metre1 = 0;
                            
                                @endphp
                                @foreach(\App\Models\CekiUrunModel::where('ceki_id', $cekiurun)->orderBy('id','DESC')->get() as $val)
                                @php
                                 $metre1 = $metre1 + $val->metre;
                               
                                $kumas = \App\Models\KumasModel::where('id', $val->kumas_id)->first();
                                @endphp
                                <tr>
                                     <td>{{$siraa++}}</td>
                                <td>{{$val->barkod}}</td>
                                <td> <input name="" data-id="{{$val->id}}" data-type="kumas_kalite" class="form-control duzenle" value="{{$val->kalite}}"></td>
                                <td> <input name="" data-id="{{$val->id}}" data-type="kumas_parti" class="form-control duzenle" value="{{$val->parti_no}}"></td>
                                <td> <input name="" data-id="{{$val->id}}" data-type="kumas_metre" class="form-control duzenle" value="{{$val->metre}}"></td>
                                <td> <input name="" data-id="{{$val->id}}" data-type="kumas_kumas_tipi" class="form-control duzenle" value="{{$val->kumas_tipi}}"></td>
                                <td> <input name="" data-id="{{$val->id}}" data-type="kumas_lot_no"  class="form-control duzenle" value="{{$val->lot}}"></td>
                                 <td> <input name="" data-id="{{$val->id}}" data-type="en"  class="form-control duzenle" value="{{$val->en}}"></td>
                                <td> <input name="" data-id="{{$val->id}}" data-type="kumas_aciklama" class="form-control duzenle" value="{{$val->aciklama}}"></td>
                                <td><button type="button" onclick="CekiUrunSil({{$val->id}});" > Sil</button></td>
                                </tr>
                                @endforeach
                                
                                </tbody>
                               
                            </table>

                        </div>
         </div>     </div>                      
        </div>
        <!-- end container-fluid -->
    </div>

    <!-- end wrapper -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

$(document).ready(function() {
    var metre1 = "<?php echo $metre1 ?>";

    $('#metreler1').text(metre1+' Mt.');
  
    
    

});
</script>
<script>
    function gonder()
    {
        if($('#firma').val() =="0")
        {
            alert("Firma Seçiniz");
        }
        else
        {
            $('#formgonder').submit();
        }
    }
</script>
<script>
$.fn.pressEnter = function(fn) {  

return this.each(function() {  
    $(this).bind('enterPress', fn);
    $(this).keyup(function(e){
        if(e.keyCode == 13)
        {
          $(this).trigger("enterPress");
        }
    })
});  
}; 

//use it:
$('#barkod').pressEnter(function(){
    
    

  $.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});




var islemid = $('#barkod').val();

$.ajax({

   type:'POST',

   url:'/ceki-urun-getir',

   data:{id:islemid,sil:"0"},

   success:function(data){

    if(data.hata == 1)
    {
       Swal.fire({
  title: 'Bu Barkod #'+data.ceki_id+' çekide bulunmaktadır. ?',
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: `Oradan Sil ve Buraya Kaydet !`,
  denyButtonText: `İşlem Yapma`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    
    
    
    $.ajax({

   type:'POST',

  url:'/ceki-urun-getir',

   data:{id:islemid,sil:"1"},

   success:function(data){

   location.reload();

   }

});
    
    
    
    
    
    
    
    
  } else if (result.isDenied) {
    Swal.fire('Hiç bir işlem yapılmadı', '', 'Bilgi')
  }
})
    }
    else
    {
                  
                location.reload();
                $('#hatamesaji').text("");
                            
     }
     }
});



    $('#barkod').val("");

    
    });
</script>
<script>


$('.duzenle').on('change', function(e) {
  
  $.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});




var id = $(this).attr('data-id');
var type = $(this).attr('data-type');
var value = $(this).val();


$.ajax({

   type:'POST',

   url:'/ceki-urun-duzenle',

   data:{id:id, type:type,value:value},

   success:function(data){

   console.log("Başarılı");

   }

});
});




function  CekiUrunSil(e){
  
  $.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});




var id = e;



$.ajax({

   type:'POST',

   url:'/ceki-urun-sil',

   data:{id:id},

   success:function(data){

    location.reload();

   }

});
};

</script>
@endsection


