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
  <h2 class="text-white text-center mb-5">Visualizza i Prodotti</h2>
  <div class="row">
    <div class="col-12">
    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
            <thead>
                <th scope="col">Codice Prodotto</th>
                <th scope="col">Nome Prodotto</th>
                <th scope="col">Quantita Totale</th>
                <th scope="col">Prezzo</th>
                <th scope="col">Categoria</th>
            </thead>
            <tbody>
                @foreach ($prod as $item)
                    <tr>
                        <td class="text-capitalize">{{$item->codprod}}</td>
                        <td class="text-capitalize">{{$item->nomeprod}}</td>
                        <td class="text-capitalize">{{$item->quantitatot}}</td>
                        <td class="text-capitalize">{{number_format($item->prezzo,2,'.',',')}} €</td>
                        <td class="text-capitalize">{{$item->categoria}}</td>
                        <td><a class="btn btn-sm btn-danger text-decoration-none" href="{{route('delete_prodotto',['prodotto'=>$item->codprod])}}">Cancella</a></td>
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
