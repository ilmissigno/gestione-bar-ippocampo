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
  <h2 class="text-white text-center mb-5">Visualizza le Ricariche Totali</h2>
  <div class="row">
    <div class="col-12">
        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
                <thead>
                    <th scope="col">Tessera</th>
                    <th scope="col">Ricariche</th>
                    <th scope="col">Socio</th>
                    <th scope="col">Data Ricarica</th>
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
                    @foreach ($ricariche as $item)
                        <tr>
                            <td class="text-capitalize">{{$item->codtess}}</td>
                            <td class="text-capitalize">{{number_format($item->ricarica,2,'.',',')}} €</td>
                            <td class="text-capitalize">{{$item->tessera->socio->nome}} {{$item->tessera->socio->cognome}}</td>
                            <td class="text-capitalize">{{$item->dataricarica}}</td>
                            <td><a class="btn btn-sm btn-warning text-decoration-none" href="{{route('deleteric',['ricarica'=>$item->idricarica])}}">Cancella</a></td>
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
