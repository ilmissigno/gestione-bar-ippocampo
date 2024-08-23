@extends('layouts.main')
@section('css')
@section('content')
<div id="statuserror" class="alert bg-danger">
    <span id="msgerror" class="font-weight-bold text-white"></span>
</div>
<div class="container my-5 py-5" style="background: rgba(255, 255, 255, 0.5)">
    <h1 class="text-center text-white mb-5 pb-5">EFFETTUA UNA RICARICA</h1>
  <div class="row justify-content-center">

        <div class="col-6 d-flex justify-content-center">
            <div class="bg-white rounded w-100" id="anagrafica">
                <!--IMMAGINE E TITOLO-->
                <div class="card-body">
                    <!--TITOLO-->
                    <div class="d-flex">
                        <small class="text-lowercase">TITOLARE CARTA:</small><p class="ml-3 font-weight-bold text-uppercase" id="titolare"></p>
                    </div>
                    <!--SCADENZA-->
                    <div class="d-flex">
                        <small class="card-text text-lowercase">CREDITO ATTUALE:</small><p class="ml-3 font-weight-bold text-uppercase" id="credito"></p>
                    </div>
                    <!--NUMERO DEL FILE-->
                </div>
            </div>
        </div>
    <div class="col-10">

        <form method="POST" action="">
            @csrf
            <div class="form-group p-3">
                <label>Numero Tessera: </label>
                <i class="fas fa-credit-card text-info ml-2"></i>
                <input placeholder="Numero carta" type="text" class="form-control" name="tessera">
            </div>
            <div class="form-group p-3">
                <label>Importo: </label><i class="fas fa-euro-sign text-warning ml-2"></i>
                <input placeholder="0,00 €" type="number" min="0.00" max="1000.00" class="form-control" name="importo" step="1.00" id="importo">
            </div>
            <div class="float-right m-4">
                <button id="checkRicarica" class="btn btn-lg btn-success" style="width: 150px; height: 100px;" type="button" onclick="ricaricaTess()">Ricarica</button>
            </div>
        </form>

    </div>
  </div>
    {{-- NOTIFICA SUCCESSO --}}
    <div class="modal fade" id="successo" tabindex="-1" role="dialog" aria-labelledby="modalSuccesso" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <h4>RICARICA EFFETTUATA CON SUCCESSO</h4>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button id="btn-si-successo" class="btn btn-success btn-lg btn-block">Stampa lo Scontrino di Ricarica</button>
                </div> -->
            </div>
        </div>
    </div>
    {{-- NOTIFICA SUCCESSO --}}
</div>
@section('js')
<script>
$('#anagrafica').hide();
$('#successo').hide();
$('#statuserror').hide();
$('input[name="tessera"]').on('input', function () {
  $('#anagrafica').hide();
  var tessera = $(this).val();
  if(tessera.length && tessera.length == 4){
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        type:'POST',
        url: '/dati_ricarica',
        dataType: "json",
        data:{_token: CSRF_TOKEN, tessera: tessera, type: 'prendidaticliente'},
        success: function(data){
            if(data.success){
                $('#anagrafica').fadeIn();
                $('#titolare').text(data['cliente'].nome+' '+data['cliente'].cognome);
                $('#credito').text(parseFloat(data['tessera'].creditotess).toFixed(2).toString()+' €');
            }else{
                $('#statuserror').fadeIn();
                $('#msgerror').text('Carta non esistente / Controllare il codice inserito.');
                $('#msgerror').css({'opacity': '1'});
                setInterval(() => {
                    $('#msgerror').css({'opacity': '0'});
                    $('#statuserror').fadeOut();
                }, 5000);
            }
        }
      });
  }
});

function ricaricaTess(){
    var tessera = {};
    tessera['codice']=$('input[name="tessera"]').val();
    tessera['ricarica']=$('input[name="importo"]').val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'POST',
        url:'/ricarica_effettuata',
        dataType: "json",
        data:{_token: CSRF_TOKEN, list: tessera},
        success: function(data){
            if(data.status){
                $('#successo').modal('toggle');
                $.ajax({
                type:'POST',
                url: '/scontrino',
                dataType: "json",
                data:{_token: CSRF_TOKEN ,list: tessera, type: 'ricarica'},
                success: function(data){
                    setTimeout(function(){
                        $('#successo').modal('toggle');
                        location.href = '/home';
                    },1200);
                    // location.href = '/stampa_scontrino_ricarica';
                }
                });
                // $('#btn-si-successo').on('click', function() {

                // });
            }
        }
    });
}

</script>
@endsection
