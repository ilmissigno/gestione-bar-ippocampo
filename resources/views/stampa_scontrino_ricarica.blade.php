@extends('layouts.main')

@section('css')
<style>
    body{
        background : none !important;
    }
</style>
@section('content')

<div class="container"></div>
    <div class="row">
        <div class="col-12 text-center text-black">
            <img src="{{Storage::url('Immagine_scontrino.png')}}" height="100" width="300">
            <?php
            $str = Storage::get("scontrini/scontrino_ricarica.txt");
            echo "<b>" . preg_replace('!\r?\n!', '<br>', $str) . "</b>";
            ?>
        </div>
    </div>
</div>

@section('js')

<script>
    $('#goback').remove();
    $('#logout').remove();
    function chiusura(){
        window.print();
        window.setTimeout("window.location='/home';",5000);
    }
    chiusura();
 </script>

@endsection
