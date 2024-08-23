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
  <h2 class="text-white text-center mb-5">Visualizza i Soci</h2>
  <div class="row">
    <div class="col-12">
        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
                <thead>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                </thead>
                <tbody>
                    @foreach ($soci as $item)
                        <tr>
                            <td class="text-capitalize">{{$item->nome}}</td>
                            <td class="text-capitalize">{{$item->cognome}}</td>
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
