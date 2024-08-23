@extends('layouts.main')

@if (\Session::has('msg'))
<div id="statusalert" class="alert bg-success">
    <span id="msgsuccess" class="font-weight-bold text-white">{{Session::get('msg')}}</span>
</div>
@endif
@section('css')
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
@section('content')

<div class="container my-5 py-5">
  <h2 class="text-white text-center mb-5">Visualizza le Tessere</h2>
  <div class="row">
    <div class="col-12">
        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
                <thead>
                    <th scope="col">Codice Tessera</th>
                    <th scope="col">Credito Residuo</th>
                    <th scope="col">Ricarica Giornaliera</th>
                    <th scope="col">Ricariche Totali</th>
                    <th scope="col">Data Ricarica</th>
                    <th scope="col">Nome Socio</th>
                    <th scope="col">Cognome Socio</th>
                </thead>
                <tbody>
                    @foreach ($tess as $item)
                        <tr>
                            <td class="text-capitalize">{{$item->codtess}}</td>
                            <td class="text-capitalize">{{number_format($item->creditotess,2,'.','.')}} &euro;</td>
                            <td class="text-capitalize">{{number_format($item->ricaricagiorno,2,'.',',')}} &euro;</td>
                            <td class="text-capitalize">{{number_format($item->ricaricatot,2,'.',',')}} &euro;</td>
                            <td class="text-capitalize">{{$item->dataricarica}}</td>
                            <td class="text-capitalize">{{$item->socio->nome}}</td>
                            <td class="text-capitalize">{{$item->socio->cognome}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
@section('js')
@endsection
