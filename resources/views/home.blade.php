@extends('layouts.main')

@section('css')
<style>
    #button-custom{
        background: rgba(255, 255, 255, 0.7);
        border: 2px solid rgb(0, 89, 255);
    }
    #button-custom:active{
        border: 15px solid rgb(255, 255, 255);
    }
</style>
@section('content')
<div class="container-sm my-sm-5">
    <div class="row my-3 text-center">
        <div class="col-12">
            <h1 class="text-white text-center">GESTIONE BAR IPPOCAMPO</h1>
            <h5 id="dataoggi" class="text-center text-white mb-5"></h5>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <h4 class="text-white text-uppercase text-center">Effettua un acquisto</h4>
            <a href="{{ route('acquisti') }}" class="btn btn-sm shadow-sm" id="button-custom"><img style="width: 15vw; height: 20vh;" src="{{Storage::url('acquisto.png')}}"></a>
        </div>
        <div class="col-6 text-center">
            <h4 class="text-white text-uppercase text-center">Effettua una ricarica</h4>
            <a href="{{ route('ricarica') }}" class="btn btn-sm shadow-sm" id="button-custom"><img style="width: 15vw; height: 20vh;" src="{{Storage::url('carta.png')}}"></a>
        </div>
    </div>
    <div class="mt-5 row justify-content-around flex-wrap">
        <h4 class="col-12 text-white text-uppercase text-center">Inventario</h4>
        @include('inventario')
    </div>
</div>
@section('js')
<script>
moment.locale('it');
function loadlink(){
    $('#dataoggi').text("Oggi è "+moment(new Date()).format('DD MMMM YYYY HH:mm:ss'));
}

loadlink();
setInterval(function(){
    loadlink()
}, 1000);
</script>
@endsection
