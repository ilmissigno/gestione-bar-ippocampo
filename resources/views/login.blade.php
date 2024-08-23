@extends('layouts.main')

@if($errors->any())
<div id="alert-add-cart" class="alert bg-danger">
    <span id="status" class="font-weight-bold text-white">{{$errors->first()}}</span>
</div>
@endif

@section('css')
@section('content')
<br><br>
<h1 class="text-white text-center mb-3">GESTIONE BAR IPPOCAMPO</h1>
<div class="container my-5 py-5">
  <h2 class="text-white text-center mb-5">Benvenuto, inserisci le credenziali</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group p-3">
          <label>Utente: </label>
          <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group p-3">
          <label>Password: </label>
          <input type="password" class="form-control" name="password">
        </div>
        <div class="float-right m-4">
          <button class="btn btn-lg btn-danger" type="submit">Accedi</button>
        </div>
      </form>
    </div>
  </div>
</div>
@section('js')
<script>
$(document).ready(function () {
  if($('#status').text().length > 0){
    var e = $('#alert-add-cart');
    e.css({'transition': '0.5s'});
    e.prop('hidden', false);
    setInterval(() => {
      e.css({'opacity': '0%'});
    }, 5000);
  };
  $('#logout').remove();
})
</script>
@endsection
