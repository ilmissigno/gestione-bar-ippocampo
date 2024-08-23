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
  <h2 class="text-white text-left mb-5">Visualizza le Ricariche della Tessera</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('view_ric_tessera') }}">
        @csrf
        <div class="form-group p-3">
          <div class="row">
            <div class="col-3">
              <label>Tessera : </label>
              <input type="text" class="form-control" id="codtess" name="codtess">
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
    if(isset($ricariche)){
  ?>
  <div class="row my-5">
    <div class="col-12">
      <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
          <thead>
            <tr>
              <th scope="col" class="font-weight-light text-uppercase">Tessera</th>
              <th scope="col" class="font-weight-light text-uppercase">Socio</th>
              <th scope="col" class="font-weight-light text-uppercase">Ricarica</th>
              <th scope="col" class="font-weight-light text-uppercase">Data Ricarica</th>
            </tr>
          </thead>
          <tbody>
          <tr class="excel-body">
              @php
                  $tot = 0.0;
                  foreach($ricariche as $a){
                      $tot += number_format($a->ricarica,2);
                  }
              @endphp
            <td><span class="font-weight-bold text-uppercase">Totale&nbsp;incassato&nbsp;:&nbsp;{{$tot}}&nbsp;&euro;</span></td>
          </tr>
          @foreach ($ricariche as $a)
              <tr>
                  <td class="font-weight-bold">{{$a->codtess}}</td>
                  <td class="font-weight-bold">{{$nome}} {{$cognome}}</td>
                  <td class="font-weight-bold">{{number_format($a->ricarica,2,'.',',')}} €</td>
                  <td class="font-weight-bold">{{$a->dataricarica}}</td>
                  <td><a class="btn btn-sm btn-warning text-decoration-none" href="{{route('deleteric',['ricarica'=>$a->idricarica])}}">Cancella</a></td>
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
