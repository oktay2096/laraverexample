@extends('layouts.app')
@section('css')

<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
@endsection

@section('content')


    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Çeki Listesi</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Panel</a></li>
                         
                            <li class="breadcrumb-item active">Çeki Listesi</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            @php
            $b = "";
            $t = "";
            $tarih = date('yy-d-m');
           
            if(isset($_GET['b']) and $_GET['t'] != "")
            {
                 
                $b = $_GET['b'];
                $t = $_GET['t'];
                $ceki =  \App\Models\CekiModel::whereBetween('created_at', [$_GET['b'], $_GET['t']])->get();
          
            }
            elseif (isset($_GET['b']) and $_GET['t'] == "") {
                $b = $_GET['b'];
               
                $tarih = date('yy-m-d');
               
                $ceki =  \App\Models\CekiModel::whereBetween('created_at', [$_GET['b'], $tarih])->get();
         
                
            }
            else
            {
                $ceki =  \App\Models\CekiModel::orderby('id','DESC')->get();
          
                
            }
        @endphp

     
             
        
<form action="/ceki-listesi" method="get">
            <div class="row">
              
                <div class="col-md-4">
                    <input type="date" class="form-control" value="<?php echo $b ?>" name="b" id="">
        

                </div>/
                <div class="col-md-4">

                    <input type="date" class="form-control" value="<?php echo $t ?>" name="t" id="">
          
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" type="submit">Filtrele</button>
                    <br></br>
                </div>
                
            </form>

                <div class="col-12">
                    <div class="card m-b-30">
                    <div class="card-body">


    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
        <th>#Id</th>
                                    <th>Müşteri</th>
                                    <th >Top Adeti</th>
                                   
                                     <th >Metre</th>
                                      <th >Ağırlık</th>
                                       <th >Kumaş</th>
                                        <th >Oluşturma Tarihi</th>
                                    <th >Sevk Durumu</th>
                                     <th >Açk</th>
                                    <th >İşlem</th>
                                  
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($ceki as $val)
                              <tr>
                              <td><a href="/ceki-listesi-detay?id={{$val->id}}">{{$val->id}}</a> </td>
                                    <td >{{\App\Models\CariModel::where('id',$val->musteri)->first()->firma_adi}}</td>
                                    <td>{{\App\Models\CekiUrunModel::Where('ceki_id',$val->id)->count()}}</td>
                                     <td>{{number_format(\App\Models\CekiUrunModel::Where('ceki_id',$val->id)->sum("metre"), 2, ',', '.')}}</td>
                                     <td>{{number_format(\App\Models\CekiUrunModel::Where('ceki_id',$val->id)->sum("kg"), 2, ',', '.')}}</td>
                                     @if(\App\Models\CekiUrunModel::Where('ceki_id',$val->id)->count() > 0)
                                     @if(\App\Models\KaliteModel::where('barkod', \App\Models\CekiUrunModel::where('ceki_id',$val->id)->first()->barkod)->count() > 0)
                                     
                                       <td>{{\App\Models\KaliteModel::where('barkod', \App\Models\CekiUrunModel::where('ceki_id',$val->id)->first()->barkod)->first()->etiket_ismi}}</td>
                                     @else
                                     <td>Yok</td>
                                     @endif
                                      
                                     @else
                                     
                                     <td>-</td>
                                     @endif
                                   
                                    <td>{{$val->created_at}}</td>
                                    @if($val->sevk_durum == 1)
                                   <td style="color:green">
                                        ✓ Sevk Oldu
                                    

                                    </td>
                                    
                                    @else
                                     <td style="color:red">
                                        X Sevk Olmadı
                                    

                                    </td>
                                    
                                    @endif
                                      <td >
                                      {{$val->aciklama}}

                                    </td>
                                    <td> <div class="btn-group m-b-10">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">İşlem</button>
                                    <div class="dropdown-menu">
                                   
                                        <a class="dropdown-item"  href="/ceki-duzenle?id={{$val->id}}" title="Ceki Düzenle">Düzenle</a>
                                      <a class="dropdown-item"  href="/ceki-yazdir?id={{$val->id}}" title="Ceki Düzenle">Yazdır</a>

                                        <a class="dropdown-item" href="/ceki-listesi-detay?id={{$val->id}}">Detay</a>

                                       
                                        
                                        <a  class="dropdown-item" href="/ceki-sil?id={{$val->id}}" >Sil</a>
                                    </div>
                                </div><!-- /btn-group -->
                                  
                                </td>
                              </tr>
                                 
@endforeach
                                </tbody>
                               
                                </form>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->  

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end wrapper -->
@endsection




@section('js')

<script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script>

function siparisuyari(){
            swal({
                title: 'Emin Misiniz ?',
                text: "Seçtiğiniz Kumaşta Sipariş Oluşturalacak !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger ml-2',
                confirmButtonText: 'Evet! Sipariş Oluştur',
                cancelButtonText: 'İptal'

            }).then(function () {

                window.location.href = $(this).data('href');
                
            })
        };

</script>

<script>
function toplusiparis(){

    $("#target" ).submit();

}

</script>
@endsection