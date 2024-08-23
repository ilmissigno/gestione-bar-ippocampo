<?php
    $categorie = [
        'SNACK', 'BAR', 'ATTIVITA', 'BIBITE', 'CENA', 'GELATI'
    ];
?>
@extends('layouts.main')
@section('content')
<style>
    .my-custom-scrollbar {
      position: relative;
      height: 70vh ;
      overflow: auto;
    }
    .table-wrapper-scroll-y {
      display: block;
    }
</style>
<h1 class="text-center text-white mt-5">ACQUISTI PER CATEGORIA/PRODOTTO</h1>
    <div class="container-fluid my-5 py-5">
      <div class="row">
        <div class="col-3">
            <form method="GET" action="{{route('view_acq_prod')}}">
                @csrf
                <label class="text-white">Scegli una categoria</label>
                <div class="form-group">
                    <select id="selectcategoria" class="custom-select" onchange="getProducts(this.value)">
                        <option value="*">Tutti</option>
                        @foreach($categorie as $cat)
                            <option value="{{$cat}}">{{$cat}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="categoria" id="selectedcategoria">
                <label class="text-white">Scegli un prodotto</label>
                <div class="form-group">
                    <select id="selectprodotto" class="custom-select" onchange="$('#selectedprodotto').val(this.value);">
                        <option value="*">*</option>
                    </select>
                </div>
                <input type="hidden" name="prodotto" id="selectedprodotto">
                <button type="submit" class="btn btn-info" onclick="findProducts()">CERCA</button>
            </form>
        </div>
        <div class="col-9">
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-dark text-white" id="table-acquisti" style="background: rgba(0,0,0,0.7)">
                  <thead>
                    <tr class="excel-head">
                      <th scope="col" class="font-weight-light text-uppercase">Nome</th>
                      <th scope="col" class="font-weight-light text-uppercase">Quantita'</th>
                      <th scope="col" class="font-weight-light text-uppercase">Data Acquisto</th>
                      <th scope="col" class="font-weight-light text-uppercase">Codice Tessera</th>
                      <th scope="col" class="font-weight-light text-uppercase">Codice Prodotto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="excel-body">
                        @php
                            $tot = 0.0;
                            foreach($acquisti as $acq){
                                $tot += number_format($acq->prezzotot,2);
                            }
                        @endphp
                      <td><span class="font-weight-bold text-uppercase">Totale&nbsp;incassato&nbsp;:&nbsp;{{$tot}}&nbsp;&euro;</span></td>
                    </tr>
                    @foreach ($acquisti as $acq)
                        <tr class="excel-body">
                            <td class="font-weight-bold">{{$acq->nomeprod}}</td>
                            <td class="font-weight-bold">{{$acq->quantitatot}}</td>
                            <td class="font-weight-bold">{{$acq->dataacq}}</td>
                            <td class="font-weight-bold">{{$acq->codtess}}</td>
                            <td class="font-weight-bold">{{$acq->codprod}}</td>
                            <td><a class="btn btn-sm btn-warning text-decoration-none" href="{{route('deleteacq',['acquisto'=>$acq->codacq])}}">Cancella</a></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>

@section('js')

<script type="text/javascript">

function getProducts(param){
    $('#selectedcategoria').val(param);
    $.ajax({
        type:'POST',
        url: '/getProductsCategory',
        dataType: "json",
        data:{_token: CSRF_TOKEN ,categoria:param},
        success: function(data){
            $('#selectprodotto').empty();
            if(data.list.length > 0){
                for(var i=0; i<data.list.length; i++){
                    $('#selectprodotto').append("<option id='prod_"+data.list[i].codprod+"' value='"+data.list[i].codprod+"'>"+data.list[i].nomeprod+"</option>");
                }
            }
            $('#selectprodotto').prepend("<option value='*'>Tutti</option>");
            $('#selectedprodotto').val(data.list[0].codprod);
        }
    });
}

function findProducts(){
    var param1 = $('#selectcategoria').val();
    var param2 = $('#selectprodotto').val();
    $.ajax({
        type:'GET',
        url: '/view_acq_prod',
        dataType: "json",
        data:{_token: CSRF_TOKEN ,categoria:param1, prodotto:param2},
        success: function(data){

        }
    });
}

</script>

@endsection
