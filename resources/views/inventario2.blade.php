<?php
$paths_acquisti = array(
  "Visualizza gli Acquisti dei Soci"=>"view_acq_soci",
  "Visualizza gli Acquisti Giornalieri"=>"view_acq_giorno",
  "Visualizza gli Ordini"=>"view_orders",
  "Cancella tutti gli Acquisti"=>"delete_acquisti",
);
$paths_tessere = array(
  "Inserisci una Tessera"=>"insert_tessera",
  "Visualizza le Tessere"=>"view_tessere",
  "Cancella una Tessera" => "delete_tessera",
  "Cancella tutte le Tessere" => "delete_all_tessere",
  "Azzera tutti i Crediti Residui" => "reset_crediti"
);
$paths_soci = array(
  "Inserisci un Socio"=>"insert_socio",
  "Cancella un Socio" => "delete_socio",
  "Visualizza i Soci"=>"view_soci",
  "Visualizza le Tessere del Socio"=>"view_tessere_socio",
  "Visualizza gli Acquisti del Socio"=>"view_acq_socio",
  "Visualizza gli Acquisti del Socio per Data"=>"view_acq_socio_data"
);
$paths_prodotti = array(
  "Inserisci un Prodotto"=>"insert_prodotto",
  "Visualizza i Prodotti"=>"view_prodotti",
  "Aggiorna Rifornimento di un Prodotto"=>"update_rif_prodotto",
  "Visualizza i Prodotti per Categoria"=>"view_prod_categoria"
);
$paths_ricariche = array(
  "Visualizza i Crediti Residui"=>"view_crediti",
  "Visualizza le Ricariche Giornaliere"=>"view_ric_giorno",
  "Visualizza le Ricariche Totali"=>"view_ric_tot",
  "Visualizza le Ricariche per Data"=>"view_ric_data",
  "Visualizza le Ricariche della Tessera"=>"view_ric_tessera",
  "Visualizza le Ricariche della Tessera per Data"=>"view_ric_tessera_data",
  "Cancella tutte le Ricariche"=>"delete_all_ricariche"
);
$paths_utenti = array("Cambia la Password"=>"change_password","Registra un Utente"=>"registration_user");
$paths_cene = array(
  "Visualizza le Prenotazioni della Cena"=>"view_pren_cena",
  "Cancella una Prenotazione"=>"delete_pren_cena",
  "Effettua Prenotazione Cena"=>"insert_pren_cena",
  "Inserisci una Cena"=>"insert_cena",
  "Visualizza le Ricariche dei Soci per Cena"=>"view_ricariche_cena_soci",
  "Visualizza le Ricariche della Cena"=>"view_ricariche_cena"
);
?>
@extends('layouts.main')
@if (\Session::has('msg'))
<div id="statusalert" class="alert bg-success">
    <span id="msgsuccess" class="font-weight-bold text-white">{{Session::get('msg')}}</span>
</div>
@endif
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
<?php
switch ($_GET['parametro']) {
  case 'view_acquisti':
  ?>
  <div class="container my-5 py-5">
    <div class="text-center">
      <h2 class="text-bold text-white text-uppercase">Gestione Acquisti</h2>
    </div>
    <div class="row justify-content-center my-5 py-5">
  <?php
      foreach($paths_acquisti as $k=>$p){
          if($p == 'delete_acquisti'){
?>
        <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('inventario_acquisti', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom" onclick="return confirm('Sei sicuro di cancellare tutti gli acquisti?');"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
        </div>
            <?php
      }else{
?>
        <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('inventario_acquisti', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
        </div>
        <?php }
    }
?>
    <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('view_acq_prod', ['categoria' => '*', 'prodotto' => '']) }}" class="btn btn-sm shadow-sm" id="button-custom"><h4 class="text-uppercase">Visualizza gli Acquisti per Prodotto</h4></a>
        </div>
    </div>
    </div>
<?php break; ?>
<?php
  case 'view_tessere':
  ?>
    <div class="container my-5 py-5">
      <div class="text-center">
        <h2 class="text-bold text-white text-uppercase">Gestione Tessere</h2>
      </div>
      <div class="row justify-content-center my-5 py-5">
  <?php
    foreach($paths_tessere as $k=>$p){
        if($p == 'delete_all_tessere'){
?>
        <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('inventario_tessere', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom" onclick="return confirm('Sei sicuro di cancellare tutte le tessere?');"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
        </div>
    <?php }else if($p == 'reset_crediti'){ ?>
        <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('inventario_tessere', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom" onclick="return confirm('Sei sicuro di azzerare tutti i crediti?');"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
        </div>
    <?php }else{ ?>
            <div class="col-5 text-center my-3">
              <a style="width: 75%; height:100%;" href="{{ route('inventario_tessere', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
            </div>
    <?php } ?>
<?php
    }
?>
        </div>
      </div>
<?php
    break;
  case 'view_soci':
  ?>
    <div class="container my-5 py-5">
      <div class="text-center">
        <h2 class="text-bold text-white text-uppercase">Gestione Soci</h2>
      </div>
      <div class="row justify-content-center my-1 py-1">

  <?php
    foreach($paths_soci as $k=>$p){
?>
        <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('inventario_soci', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
          </div>
<?php
    }
?>
        </div>
      </div>
<?php
    break;
  case 'view_prodotti':
  ?>
    <div class="container my-5 py-5">
      <div class="text-center">
        <h2 class="text-bold text-white text-uppercase">Gestione Prodotti</h2>
      </div>
      <div class="row justify-content-center my-5 py-5">
  <?php
    foreach($paths_prodotti as $k=>$p){
?>
          <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('inventario_prodotti', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
          </div>
<?php
    }
?>
        </div>
      </div>
<?php
    break;
  case 'view_ricariche':
  ?>
    <div class="container my-5 py-5">
      <div class="text-center">
        <h2 class="text-bold text-white text-uppercase">Gestione Ricariche</h2>
      </div>
      <div class="row justify-content-center my-5 py-5">
    <?php
        foreach($paths_ricariche as $k=>$p){
            if($p == 'delete_all_ricariche'){
    ?>
            <div class="col-5 text-center my-3">
                <a style="width: 75%; height:100%;" href="{{ route('inventario_ricariche', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom" onclick="return confirm('Sei sicuro di cancellare tutte le ricariche?');"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
            </div>
        <?php }else{ ?>

              <div class="col-5 text-center my-3">
                <a style="width: 75%; height:100%;" href="{{ route('inventario_ricariche', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
              </div>
        <?php } ?>
    <?php
        }
    ?>
        </div>
      </div>
<?php
    break;
  case 'view_utenti':
  ?>
    <div class="container my-5 py-5">
      <div class="text-center">
        <h2 class="text-bold text-white text-uppercase">Gestione Utenti</h2>
      </div>
      <div class="row justify-content-center my-5 py-5">
  <?php
    foreach($paths_utenti as $k=>$p){
?>
          <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('inventario_utenti', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
          </div>
<?php
    }
?>
        </div>
      </div>
<?php
    break;
  case 'view_cene':
  ?>
    <div class="container my-5 py-5">
      <div class="text-center">
        <h2 class="text-bold text-white text-uppercase">Gestione Cene</h2>
      </div>
      <div class="row justify-content-center my-5 py-5">
  <?php
    foreach($paths_cene as $k=>$p){
?>
          <div class="col-5 text-center my-3">
            <a style="width: 75%; height:100%;" href="{{ route('inventario_cene', ['parametro'=> $p]) }}" class="btn btn-sm shadow-sm" id="button-custom"><h4 class="text-black text-uppercase"><?=$k?></h4></a>
          </div>
<?php
    }
?>
        </div>
      </div>
<?php
    break;
  default:
    break;
}
?>
@section('js')

@endsection
