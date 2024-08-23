@extends('layouts.main')

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
  <h2 class="text-white text-center mb-5">Visualizza gli Acquisti Giornalieri</h2>
  <div class="row">
    <div class="col-12">
      <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
          <thead>
            <tr>
              <th scope="col" class="font-weight-light text-uppercase">codice acquisto</th>
              <th scope="col" class="font-weight-light text-uppercase">Nome Prodotto</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($acquisti as $prod)
              <tr>
                <th scope="row">{{$prod->codacq}}</th>
                <td class="font-weight-bold">{{$prod->nomeprod}}</td>
                <td><a class="btn btn-sm btn-warning text-decoration-none" href="{{route('deleteacq',['acquisto'=>$prod->codacq])}}">Cancella</a></td>
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