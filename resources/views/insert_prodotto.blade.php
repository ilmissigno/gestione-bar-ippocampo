@extends('layouts.main')

@if (\Session::has('msg'))
<div id="statusalert" class="alert bg-success">
    <span id="msgsuccess" class="font-weight-bold text-white">{{Session::get('msg')}}</span>
</div>
@endif

@section('css')
@section('content')

<div class="container my-5 py-5">
  <h2 class="text-white text-center mb-5">Inserisci un Prodotto</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('insert_prodotto') }}">
        @csrf
        <div class="form-group p-3">
          <label>Codice a Barre: </label>
          <input type="text" class="form-control" name="codbarre">
        </div>
        <div class="form-group p-3">
          <label>Nome Prodotto: </label>
          <input type="text" class="form-control" name="nomeprod">
        </div>
        <div class="form-group p-3">
          <label>Quantita : </label>
          <input type="number" min="1" max="10000" class="form-control" name="quantita" step="1">
        </div>
        <div class="form-group p-3">
            <label>Prezzo : </label>
            <input type="number" min="0" max="10000" class="form-control" name="prezzo" step="0.1">
          </div>
        <div class="form-group p-3">
          <label>Categoria : </label>
          <select name="categoria" class="form-control">
            @foreach ($categorie as $item)
                <option value="{{$item}}">{{$item}}</option>
            @endforeach
          </select>
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
