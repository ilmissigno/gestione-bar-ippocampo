<?php
$paths = array(
    "acquisti"=>"view_acquisti",
    "soci"=>"view_soci",
    "tessere"=>"view_tessere",
    "prodotti"=>"view_prodotti",
    "ricariche"=>"view_ricariche",
    "utenti"=>"view_utenti"
);
?>
@section('css')
<style>
    #card-button{
        border: 1px solid rgb(63, 63, 63);
    }
    #card-button:active{
        border: 10px solid rgba(104, 162, 255, 0.5);
    }
</style>
@section('content')
@foreach ($paths as $key=>$item)
<div class="col-md-4 col-sm-6 m-1">
    <a id="card-button" href='{{route("inventario2",["parametro"=>$item])}}' class="card text-decoration-none text-white text-uppercase text-center shadow-lg" style=" background:rgba(0, 0, 0, 0.7); border:2px solid white;">
        <h5 class="card-title">{{$key}}</h5>
    </a>
</div>
@endforeach
