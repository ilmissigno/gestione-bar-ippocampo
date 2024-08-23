@extends('layouts.main')

@if (\Session::has('msg'))
<div id="statusalert" class="alert bg-success">
    <span id="msgsuccess" class="font-weight-bold text-white">{{Session::get('msg')}}</span>
</div>
@endif

@section('css')
@section('content')

<div class="container my-5 py-5">
  <h2 class="text-white text-center mb-5">Aggiorna Rifornimento per Prodotto</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('update_rif_prodotto') }}">
        @csrf
        <div class="form-group p-3">
            <label>Categoria : </label>
            <select name="catname" class="form-control" onchange="showProducts(this.value);">
                @php
                    $category = ["BAR", "GELATI", "SNACK", "BIBITE", "ATTIVITA", "CENA"];
                @endphp
                @foreach ($category as $cat)
                    <option value="{{$cat}}">{{$cat}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-3">
            <label>Prodotto : </label>
            <select id="codprod" name="codprod" class="form-control">
            </select>
        </div>
        <div class="form-group p-3">
            <label>Rifornimento : </label>
            <input type="number" min="0.00" max="1000.00" class="form-control" name="rifornimento" step="1.00">
          </div>
        <div class="float-right m-4">
          <button class="btn btn-lg btn-danger" type="submit">Aggiorna</button>
        </div>
      </form>
    </div>
  </div>
</div>
@section('js')
<script>
$(document).ready(function(){
    showProducts($('select[name="catname"]').find('option:selected').val());
});
function showProducts(category){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'POST',
        url:'/get_products_by_cat',
        dataType: "json",
        data:{_token: CSRF_TOKEN, list: category},
        success: function(data){
            $('#codprod').html('');
            for(var i=0; i<data.length; i++){
                $('#codprod').append(`
                    <option value="`+data[i]['codprod']+`">`+data[i]['nomeprod']+`</option>
                `)
            }
        },
        error: function(error){
            console.log("Error:");
            console.log(error);
        }
    });
}
</script>
@endsection
