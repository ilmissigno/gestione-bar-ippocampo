@extends('layouts.main')

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
@section('css')
@section('content')

<div class="container my-5 py-5">
  <h2 class="text-white text-left mb-5">Visualizza i Prodotti per Categoria</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('view_prod_categoria') }}">
        @csrf
        <div class="form-group p-3">
          <div class="row">
            <div class="col-3">
                <label>Categoria : </label>
                <select name="categoria" class="form-control">
                  @foreach ($categorie as $item)
                      <option value="{{$item}}">{{$item}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-2">
              <br>
              <button class="btn btn-lg btn-danger" type="submit">Visualizza</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
    if(isset($categ)){
  ?>
  <div class="row my-5">
    <div class="col-12">
      <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
          <thead>
            <tr>
                <th scope="col">Codice Prodotto</th>
                <th scope="col">Nome Prodotto</th>
                <th scope="col">Quantita Totale</th>
                <th scope="col">Quantita a Magazzino</th>
                <th scope="col">Prezzo</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($categ as $item)
              <tr>
                <td class="text-capitalize">{{$item->codprod}}</td>
                <td class="text-capitalize">{{$item->nomeprod}}</td>
                <td class="text-capitalize">{{$item->quantitatot}}</td>
                <td class="text-capitalize">{{$item->quantitamag}}</td>
                <td class="text-capitalize">{{number_format($item->prezzo,2,'.',',')}} €</td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
  <?php } ?>
</div>
@section('js')

@endsection
