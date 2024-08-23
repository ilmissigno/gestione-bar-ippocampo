@extends('layouts.main')

@if (\Session::has('msg'))
<div id="statusalert" class="alert bg-success">
    <span id="msgsuccess" class="font-weight-bold text-white">{{Session::get('msg')}}</span>
</div>
@endif

@section('css')
@section('content')

<div class="container my-5 py-5">
  <h2 class="text-white text-center mb-5">Inserisci una Tessera</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('insert_tessera') }}">
        @csrf
        <div class="form-group p-3">
          <label>Codice Tessera: </label>
          <input type="number" min="0001" max="8000" class="form-control" name="codtess" step="1">
        </div>
        <div class="form-group p-3">
          <label>Credito : </label>
          <input type="number" min="0.00" max="1000.00" class="form-control" name="creditotess" step="1.00">
        </div>
        <div class="form-group p-3">
          <label>Tipo Tessera: </label>
          <select name="tipotessera" class="form-control">
            <option value="NUOVA">NUOVA</option>
            <option value="VECCHIA">VECCHIA</option>
          </select>
        </div>
        <div class="form-group p-3">
          <label>Socio: </label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="nomesocio" placeholder="Nome" aria-label="Nome" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="cognomesocio" placeholder="Cognome" aria-label="Cognome" aria-describedby="basic-addon1">
          </div>
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
