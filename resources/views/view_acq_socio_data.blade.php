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
  <h2 class="text-white text-left mb-5">Visualizza gli Acquisti del Socio per Data</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('inventario_soci/view_acq_socio_data') }}">
        @csrf
        <div class="form-group p-3">
          <div class="row">
            <div class="col-3">
              <label>Nome Socio:</label>
              <input type="text" class="form-control" name="nomesocio">
            </div>
            <div class="col-3">
              <label>Cognome Socio: </label>
              <input type="text" class="form-control" name="cognomesocio">
            </div>
            <div class="col-3">
              <label>Data : </label>
              <input type="datetime-local" class="form-control" id="dataacq" name="data_acq">
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
    if(isset($acq)){
  ?>
  <div class="row my-5">
    <div class="col-12">
      <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
          <thead>
            <tr>
              <th scope="col" class="font-weight-light text-uppercase">Nome Prodotto</th>
              <th scope="col" class="font-weight-light text-uppercase">Quantita</th>
            </tr>
          </thead>
          <tbody>
          <tr class="excel-body">
              @php
                  $tot = 0.0;
                  foreach($acq as $a){
                      $tot += number_format($a->prezzotot,2);
                  }
              @endphp
            <td><span class="font-weight-bold text-uppercase">Totale&nbsp;incassato&nbsp;:&nbsp;{{$tot}}&nbsp;&euro;</span></td>
          </tr>
          @foreach ($acq as $k => $a)
              <tr>
                <td class="font-weight-bold">{{$a->nomeprod}}</td>
                <td class="font-weight-bold">{{$a->quantitatot}}</td>
                <td><a class="btn btn-sm btn-warning text-decoration-none" href="{{route('deleteacq',['acquisto'=>$a->codacq])}}">Cancella</a></td>
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
