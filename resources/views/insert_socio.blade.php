@extends('layouts.main')

@if (\Session::has('msg'))
<div id="statusalert" class="alert bg-success">
    <span id="msgsuccess" class="font-weight-bold text-white">{{Session::get('msg')}}</span>
</div>
@endif

@section('css')
@section('content')

<div class="container my-5 py-5">
  <h2 class="text-white text-center mb-5">Inserisci un Socio</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('insert_socio') }}">
        @csrf
        <div class="form-group p-3">
          <label>Nome Socio: </label>
          <input type="text" class="form-control" name="nome">
        </div>
        <div class="form-group p-3">
          <label>Cognome Socio: </label>
          <input type="text" class="form-control" name="cognome">
        </div>
        <div class="form-group p-3">
          <label>Telefono Socio: </label>
          <input type="text" class="form-control" name="telefono">
        </div>
        <div class="float-right m-4">
          <button class="btn btn-lg btn-danger" type="submit">Inserisci</button>
        </div>
      </form>
    </div>
  </div>
</div>
@section('js')
@endsection
