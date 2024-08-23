@extends('layouts.main')

@if (\Session::has('msg'))
<div id="statusalert" class="alert bg-success">
    <span id="msgsuccess" class="font-weight-bold text-white">{{Session::get('msg')}}</span>
</div>
@endif

@section('css')
@section('content')

<div class="container my-5 py-5">
  <h2 class="text-white text-center mb-5">Registrazione</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('registration_user') }}">
        @csrf
        <div class="form-group p-3">
          <label>Utente: </label>
          <input type="text" class="form-control" name="username" placeholder="Inserisci l'username">
        </div>
        <div class="form-group p-3">
          <label>Password: </label>
          <input type="password" class="form-control" name="password" placeholder="Inserisci la Password">
        </div>
        <div class="float-right m-4">
          <button class="btn btn-lg btn-danger" type="submit">Registrati</button>
        </div>
      </form>
    </div>
  </div>
</div>
@section('js')
@endsection
