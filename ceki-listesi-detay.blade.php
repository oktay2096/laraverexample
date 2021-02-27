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
            

        
           

            
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                    <div class="card-body">


    <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
        <th>#</th>
       
                                  
                                    <th>Barkod</th>
                                    <th>Kumaş Tipi</th>
                                    <th>Etiket İsmi</th>
                                    <th>Metre</th>
                                    <th>Parti No</th>
                                    <th>En</th>
                                    <th>Lot No</th>
                                    <th>Kalite</th>
                                    <th>Kg</th>
                                    <th>Aciklama</th>
                                  
                                </tr>
                                </thead>

@php  $i=1;   @endphp
                                <tbody>
                                @foreach(\App\Models\CekiUrunModel::where('ceki_id', $_GET['id'])->orderby('id','DESC')->get() as $val)
                              <tr>
                              <td><a href="/ceki-listesi-detay?id={{$val->id}}">{{$i++}}</a> </td>
                                
                              
                               <td>{{$val->barkod}}</td>
                               <td>{{$val->kumas_tipi}}</td>
                               @if(\App\Models\KaliteModel::where('barkod',$val->barkod)->count() > 0)
                               
                                   <td>{{\App\Models\KaliteModel::where('barkod',$val->barkod)->first()->etiket_ismi}}</td>
                               @else
                               <td>Silinmiş</td>
                               
                               @endif
                            
                               <td>{{$val->metre}}</td>
                               <td>{{$val->parti_no}}</td>
                               
                                 @if(\App\Models\KaliteModel::where('barkod',$val->barkod)->count() > 0)
                               
                                  <td>{{\App\Models\KaliteModel::where('barkod',$val->barkod)->first()->en}}</td>
                               @else
                               <td>..</td>
                               
                               @endif

                           
                               <td>{{$val->lot}}</td>
                                <td>{{$val->kalite}}</td>
                                 <td>{{$val->kg}}</td>
                               <td>{{$val->aciklama}}</td>
                              </tr>
                                
@endforeach

                                </tbody>
                                @php
                                
                                $toplam = \App\Models\CekiUrunModel::where('ceki_id',$_GET['id'])->sum("metre");
                                
                                $k1 = \App\Models\CekiUrunModel::where('ceki_id',$_GET['id'])->where('kalite','1')->sum("metre");
                                
                                
                                $a1 = \App\Models\CekiUrunModel::where('ceki_id',$_GET['id'])->where('kalite','1-A')->sum("metre");
                                
                                
                                $a2 = \App\Models\CekiUrunModel::where('ceki_id',$_GET['id'])->where('kalite','2')->sum("metre");
                                
                                 $k1kg = \App\Models\CekiUrunModel::where('ceki_id',$_GET['id'])->where('kalite','1')->sum("kg");
                                  $toplamkg = \App\Models\CekiUrunModel::where('ceki_id',$_GET['id'])->sum("kg");
                                
                                @endphp
<tfoot>
    <tr>
        <th colspan="3" style="text-align:right">1.Kalite : {{ number_format($k1, 2, ',', '.')}} Mt.</th>
        <th colspan="3" style="text-align:right">1-A.Kalite : {{ number_format($a1, 2, ',', '.')}} Mt.</th>
        <th colspan="3" style="text-align:right">2.Kalite : {{ number_format($a2, 2, ',', '.')}} Mt.</th>
        <th colspan="3" style="text-align:right">Toplam : {{ number_format($toplam, 2, ',', '.')}} Mt.</th>
    </tr>
     <tr>
        <th colspan="6" style="text-align:right">Sağlam Ağırlık : {{ number_format($k1kg, 2, ',', '.')}} Kg.</th>
        <th colspan="6" style="text-align:right">Toplam Ağırlık: {{number_format($toplamkg, 2, ',', '.')}}  Kg.</th>
        
    </tr>
    
      <tr>
        <th colspan="12"  style="text-align:center">
            
             @php
          $i=0;
          @endphp
            @foreach(\App\Models\CekiUrunModel::where('ceki_id',$_GET['id'])->get()->groupBy('lot') as $value)
            <label><b>{{$value[$i]->kumas_tipi}} {{$value[$i]->lot}} </b></label> <label style="font-size:12px"> ( {{ \App\Models\CekiUrunModel::where('ceki_id', $_GET['id'])->where('lot',$value[$i]->lot)->count()}}  Adet {{ \App\Models\CekiUrunModel::where('ceki_id', $_GET['id'])->where('lot',$value[$i]->lot)->sum("metre")}} Mt )</label>
          
            @endforeach
        </th>
       
    </tr>
     @if(\App\Models\CekiModel::where('aciklama','!=','')->where('id',$_GET['id'])->count() > 0)
     <tr>
        <th colspan="12"  style="text-align:center">
            
           <label>
             {{
             \App\Models\CekiModel::where('aciklama','!=','')->where('id',$_GET['id'])->first()->aciklama
             }}
         </label>
        </th>
       
    </tr>
    @endif
</tfoot>
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
    
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>
<script>
function toplusiparis(){

    $("#target" ).submit();

}

</script>
<script>
    
    
</script>
@endsection