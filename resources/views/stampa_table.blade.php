@php
    //head
    $neuer = explode("\n", Session::get('head'));
    $degea = [];
    foreach ($neuer as $key => $value) {
        $e = preg_replace('/\s+/', '', $value);
        array_push($degea, $e);
    }

    //dati
    $dida = explode("\n", Session::get('body'));
    $buffon = [];
    foreach ($dida as $key => $value) {
        $s = preg_replace('/\s+/', '', $value);
        array_push($buffon, $s);
    }

    $i = 0;
    $array = [];
    $array[$i] = [];
    foreach($buffon as $item){
        if($item=='Cancella')
            continue;
        if(empty($item)){
            $i++;
            $array[$i] = [];
        } else {
            if (!empty($item)) {
                array_push($array[$i], $item);
            }
        }
    }
@endphp
@extends('layouts.main')

@section('css')
<style>
    body{
        background : none !important;
    }
</style>
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 text-center py-5">
            <img class="mb-5" src="{{Storage::url('Immagine_scontrino.png')}}" height="100" width="300">
            <table class="table  border border-dark shadow-lg">
                <thead>
                    <tr class="text-center">
                        @foreach ($degea as $item)
                            <th scope="col" class="font-weight-light text-uppercase">{{$item}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($array as $item)
                    <tr class="text-center">
                        @for ($i = 0; $i < count($item); $i++)
                            <td class="font-weight-bold">{{$item[$i]}}</td>
                        @endfor
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@section('js')

<script>
    $('#buttoncello').hide();
    $('#logout').hide();
    $('#goback').hide();
    function chiusura(){
        window.print();
        window.setTimeout("window.location='/home';",5000);
    }
    chiusura();
 </script>

@endsection
