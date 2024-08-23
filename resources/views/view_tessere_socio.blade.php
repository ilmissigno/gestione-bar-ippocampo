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
  <h2 class="text-white text-left mb-5">Visualizza le Tessere del Socio</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('inventario_soci/view_tessere_socio') }}">
        @csrf
        <div class="form-group p-3">
          <div class="row">
            <div class="col-3">
              <label>Nome Socio:</label>
              <input type="text" class="form-control" name="nomesocio">
            </div>
            <div class="col-3">
              <label>Cognome Socio: </label>
              <input type="text" class="form-control" name="cognomesocio" required>
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
    if(isset($tessere)){
  ?>
  <div class="row my-5">
    <div class="col-12">
      <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
          <thead>
            <tr>
              <th scope="col" class="font-weight-light text-uppercase">Codice Tessera</th>
              <th scope="col" class="font-weight-light text-uppercase">Credito Residuo</th>
              <th scope="col" class="font-weight-light text-uppercase">Data Ricarica</th>
              <th scope="col" class="font-weight-light text-uppercase">Nome Socio</th>
              <th scope="col" class="font-weight-light text-uppercase">Cognome Socio</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($tessere as $a)
              <tr>
                <td class="font-weight-bold">{{$a->codtess}}</td>
                <td class="font-weight-bold">{{number_format($a->creditotess,2,'.',',')}} €</td>
                <td class="font-weight-bold">{{$a->dataricarica}}</td>
                <td class="font-weight-bold">{{$a->socio->nome}}</td>
                <td class="font-weight-bold">{{$a->socio->cognome}}</td>
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
