@extends('layouts.main')

@if (\Session::has('msg'))
<div id="statusalert" class="alert bg-success">
    <span id="msgsuccess" class="font-weight-bold text-white">{{Session::get('msg')}}</span>
</div>
@endif

@section('css')
@section('content')

<div class="container my-5 py-5">
  <h2 class="text-white text-center mb-5">Cancella un Socio</h2>
  <div class="row">
    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.5)">
      <form method="POST" action="{{ route('delete_socio') }}">
        @csrf
        <div class="form-group p-3">
            <label>Socio : </label>
            <select name="codcli" class="form-control">
              @foreach ($soci as $item)
                  <option value="{{$item->codcli}}">{{$item->nome}} {{$item->cognome}}</option>
              @endforeach
            </select>
          </div>
        <div class="float-right m-4">
          <button class="btn btn-lg btn-danger" type="submit">Cancella</button>
        </div>
      </form>
    </div>
  </div>
</div>
@section('js')
@endsection
