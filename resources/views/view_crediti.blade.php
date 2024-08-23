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
  <h2 class="text-white text-center mb-5">Visualizza i Crediti Residui</h2>
  <div class="row">
    <div class="col-12">
    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
            <thead>
                <th scope="col">Tessera</th>
                <th scope="col">Credito</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
            </thead>
            <tbody>
                @php
                    $tot = 0.0;
                    foreach($ricariche as $a){
                        $tot += number_format($a->creditotess,2);
                    }
                @endphp
                <td><span class="font-weight-bold text-uppercase">Totale&nbsp;crediti&nbsp;:&nbsp;{{$tot}}&nbsp;&euro;</span></td>
                @foreach ($ricariche as $item)
                    <tr>
                        <td class="text-capitalize">{{$item->codtess}}</td>
                        <td class="text-capitalize">{{number_format(($item->creditotess),2,'.',',')}} €</td>
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
