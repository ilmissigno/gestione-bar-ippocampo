@extends('layouts.main')

@section('css')
<style>
  .my-custom-scrollbar {
    position: relative;
    height: 70vh ;
    overflow: auto;
  }
  .table-wrapper-scroll-y {
    display: block;
  }
  td{
    max-width:100%;
    white-space:nowrap;
  }
</style>
@section('content')

<div class="container-fluid my-5 py-5">
  <h1 class="text-center text-white mb-5 pb-5">EFFETTUA UN ACQUISTO</h1>
  <div class="row">

    {{-- col-7 --}}

    <div class="col-7">
        <h3 class="font-weight-bold text-white">Scegli tra le Categorie</h3>
      <div class="text-left mb-3">
        <button name="BAR" onclick="changeTab(this.name)" class="btn btn-info mx-1 my-1"><span class="text-uppercase font-weight-bold">BAR</span><br><i class="fas fa-coffee fa-5x"></i></button>
        <button name="GELATI" onclick="changeTab(this.name)" class="btn btn-info mx-1 my-1"><span class="text-uppercase font-weight-bold">GELATI</span><br><i class="fas fa-ice-cream fa-5x"></i></button>
        <button name="SNACK" onclick="changeTab(this.name)" class="btn btn-info mx-1 my-1"><span class="text-uppercase font-weight-bold">SNACK</span><br><img src="{{Storage::url('svg/snack.png')}}" style="width: 80px; height: 80px;"></button>
        <button name="BIBITE" onclick="changeTab(this.name)" class="btn btn-info mx-1 my-1"><span class="text-uppercase font-weight-bold">BIBITE</span><br><i class="fas fa-wine-bottle fa-5x"></i></button>
        <button name="ATTIVITA" onclick="changeTab(this.name)" class="btn btn-info mx-1 my-1"><span class="text-uppercase font-weight-bold">ATTIVITA</span><br><i class="fas fa-futbol fa-5x"></i></button>
        <button name="CENA" onclick="changeTab(this.name)" class="btn btn-info mx-1 my-1"><span class="text-uppercase font-weight-bold">CENA</span><br><i class="fas fa-utensils fa-5x"></i></button>
      </div>

    <div class="text-left mt-3 mb-3">
        <h3 class="font-weight-bold text-white text-capitalize">oppure cerca per prodotto</h3>
        <select class="livesearch form-control p-3" name="livesearch"></select>
    </div>

      <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table id="tabs" class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">
          <thead>
            <tr>
              <th scope="col" class="font-weight-light text-uppercase">Nome Prodotto</th>
              <th scope="col" class="font-weight-light text-uppercase">Prezzo</th>
              <th scope="col" class="font-weight-light text-uppercase">Categoria</th>
            </tr>
          </thead>
          @php
            use App\Models\Prodotti;
            $category = ["BAR", "GELATI", "SNACK", "BIBITE", "ATTIVITA", "CENA"];
          @endphp
          @foreach ($category as $cat)
            <tbody id="{{$cat}}">
                @foreach (Prodotti::where(['categoria' => $cat])->get() as $key)
                    @if($key->quantitamag > 0)
                        <tr quantita="{{$key->quantitamag}}" name={{$key->codprod}} tag="{{$cat}}" onclick="addToCart(this)">
                            <td id="nomeprodotto" class="font-weight-bold">{{$key->nomeprod}}</td>
                            <td id="prezzoprodottto">{{$key->prezzo}}</td>
                            <td id="categoriaprodotto">{{$key->categoria}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
          @endforeach
        </table>
      </div>
    </div>
    {{-- col-7 --}}

    {{-- col-5 --}}
    <div class="col-5 border border-white rounded" style="overflow: auto; display:block; height:100%; background: rgba(255, 255, 255, 0.5)">
      <h2 class="text-center text-white">CARRELLO</h2>
      <div class="table-wrapper-scroll-y my-custom-scrollbar2">
        <table class="table table-dark text-white" style="background: rgba(0,0,0,0.7)">

          {{-- CARRELLO --}}
          <thead>
            <tr>
              <th scope="col" class="font-weight-light text-uppercase"></th>
              <th scope="col" class="font-weight-light text-uppercase">Nome Prodotto</th>
              <th scope="col" class="font-weight-light text-uppercase">pReZZo</th>
              <th scope="col" class="font-weight-light text-uppercase">CateGoria</th>
              <th scope="col" class="font-weight-light text-uppercase border-left text-center">Quantita'</th>
            </tr>
          </thead>

          <tbody id="carrello">

          </tbody>
          {{-- CARRELLO --}}

          {{-- PREZZO --}}
          <thead style="border-top: 3px solid white;">
            <tr>
              <th scope="col" class="font-weight-light text-uppercase">TOTALE</th>
              <th scope="col" class="font-weight-light text-uppercase"></th>
              <th scope="col" class="font-weight-light text-uppercase"></th>
              <th scope="col" class="font-weight-light text-uppercase"></th>
              <th scope="col" class="font-weight-light text-uppercase"></th>
            </tr>
          </thead>
          <tbody id="prezzo">
            <tr>
              <td id="prezzotot">0</td>
              <td>€</td>
            </tr>
          </tbody>
          {{-- PREZZO --}}

          {{-- TESSERA --}}
          <thead style="border-top: 3px solid white;">
            <tr>
              <th scope="col" class="font-weight-light text-uppercase">Tessera</th>
              <th scope="col" class="font-weight-light text-uppercase">Credito Residuo</th>
              <th scope="col" class="font-weight-light text-uppercase"></th>
              <th scope="col" class="font-weight-light text-uppercase"></th>
              <th scope="col" class="font-weight-light text-uppercase">Cliente</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input id="tessera" class="form-control" type="text"></td>
              <td class="text-center" id="creditoresiduo"></td>
              <td></td>
              <td></td>
              <td id="nomecliente"></td>
            </tr>
          </tbody>
          {{-- TESSERA --}}

        </table>
        <div id="notifycredito" class="m-3 text-center text-white bg-danger">
          Credito insufficiente
        </div>
        <button id="paga" class="btn-lg btn-danger m-4 float-right" style="width: 130px; height: 80px;" type="button" onclick="paga()">PAGA</button>
      </div>
    </div>
    {{-- col-5 --}}

    <div class="modal fade" id="error2" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <p>SICURO DI VOLER RIMUOVERE QUESTO PRODOTTO?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-no" class="btn btn-danger btn-lg">NO</button>
                    <button id="btn-si" class="btn btn-success btn-lg">SI</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="successo" tabindex="-1" role="dialog" aria-labelledby="modalSuccesso" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <h4>PAGAMENTO EFFETTUATO CON SUCCESSO</h4>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button id="btn-si-successo" class="btn btn-success btn-lg btn-block">Stampa lo Scontrino</button>
                </div> -->
            </div>
        </div>
    </div>

  </div>
</div>
@section('js')
<script>
$('#error2').hide();
$('#successo').hide();
$('#notifycredito').hide();
$('#paga').hide();
$('#tabs').hide();
var tab = $('#tabs').find('tbody').hide();
function myhandler(event){
if (event.keyCode == 9) { // F6
        event.preventDefault();
        event.stopPropagation();
      // do what you want when user press F6 on keyboard;
      const kbEvent = new KeyboardEvent('keydown', {
          bubbles: true,
          cancelable: true,
          key: 'Enter',
        });

        document.body.dispatchEvent(kbEvent);
        return false;
    }
}
document.addEventListener('keydown', myhandler, true);
$('.livesearch').select2({
    placeholder: 'Seleziona un prodotto..',
    initSelection: function(element, callback) {
    },
    ajax: {
        url: '/acquisti/ajax-autocomplete-search',
        dataType: 'json',
        delay: -1,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.codbarre+' - '+item.nomeprod+' '+item.prezzo+' €',
                        categoria: item.categoria,
                        nome: item.nomeprod,
                        quantita: item.quantitatot,
                        prezzo: item.prezzo,
                        id: item.codprod
                    }
                })
            };
        },
        cache: true
    }
});

function changeTab(carlos) {
  $('#tabs').show();
  $('.livesearch').val('').trigger('change');
    var tab = $('#tabs').find('tbody').hide();
  $('#'+carlos).show();

  checkPoor();
}

$('.livesearch').on('change',function(){
    if($('.livesearch').select2('data')[0] !== undefined){
        $('#tabs').hide();
        addToCart2($('.livesearch').select2('data')[0]);
    }
});

function addToCart2(elem){
    var nome = elem.nome;
    var codprod = elem.id;
    var categoria = elem.categoria;
    var totquant = elem.quantita;
    var prezzo = elem.prezzo;
    var thi = `<tr quantita="`+totquant+`" name="`+codprod+`" tag="`+categoria+`">
        <td id='bottone-`+codprod+`'><button class='btn btn-danger' data-toggle='modal' data-target='#error2' onclick='removeFromCart2("`+codprod+`","`+categoria+`")'><i class='fas fa-times-circle'></i></button></td>
        <td id="nomeprodotto" class="font-weight-bold">`+nome+`</td>
        <td id="prezzoprodottto">`+prezzo+`</td>
        <td id="categoriaprodotto">`+categoria+`</td>
        <td class='text-center' style='font-size: 2em;' id='quantita-`+codprod+`' quantita='qta'><i onclick='togliQuantita("`+codprod+`")' id='togli-quantita' class='fas fa-arrow-alt-circle-left mx-2'></i>`+1+`<i onclick='aumentaQuantita("`+codprod+`")' id='aumenta-quantita' class='fas fa-arrow-alt-circle-right mx-2'></i></td>
    </tr>`;
    $('#carrello').append(thi);
    var sum = 0.0;
    $('#carrello > tr').each(function() {
        var qty = parseInt($(this).find('td[quantita=qta]').text());
        var price = parseFloat($(this).find('#prezzoprodottto').text());
        var amount = (qty*price);
        sum+=amount;
    });
    $('#prezzotot').text(sum.toFixed(2));
    checkPoor();
}

function removeFromCart2(nome,categorie){
  $('#btn-no').on('click', function() {
    $('#error2').modal('toggle');
  });
  $('#btn-si').on('click', function() {
    $('tr[name='+nome+']').remove();
    $('#error2').modal('toggle');
    var sum = 0.0;
    $('#carrello > tr').each(function() {
        var qty = parseInt($(this).find('td[quantita=qta]').text());
        var price = parseFloat($(this).find('#prezzoprodottto').text());
        var amount = (qty*price);
        sum+=amount;
    });
    $('#prezzotot').text(sum.toFixed(2));
    checkPoor();
  });
  checkPoor();
}

function addToCart(thi) {
  var nome = $(thi).attr('name');
  var categorie = $(thi).attr('tag');
  var totquant = $(thi).attr('quantita');

  var quantita = $("<td class='text-center' style='font-size: 2em;' id='quantita-"+nome+"' quantita='qta'><i onclick='togliQuantita("+nome+")' id='togli-quantita' class='fas fa-arrow-alt-circle-left mx-2'></i>"+1+"<i onclick='aumentaQuantita("+nome+")' id='aumenta-quantita' class='fas fa-arrow-alt-circle-right mx-2'></i></td>");
  var button = "<td id='bottone-"+nome+"'><button class='btn btn-danger' data-toggle='modal' data-target='#error2' onclick='removeFromCart("+nome+','+categorie+")'><i class='fas fa-times-circle'></i></button></td>";
  $(thi).append(quantita);
  $(thi).prepend(button);
  $('#carrello').append(thi);
  $('#carrello').find(thi).attr('onclick', null);
  var sum = 0.0;
    $('#carrello > tr').each(function() {
        var qty = parseInt($(this).find('td[quantita=qta]').text());
        var price = parseFloat($(this).find('#prezzoprodottto').text());
        var amount = (qty*price);
        sum+=amount;
    });
  $('#prezzotot').text(sum.toFixed(2));
  checkPoor();

}

function removeFromCart(nome,categorie) {
  $('#btn-no').on('click', function() {
    $('#error2').modal('toggle');
  });
  $('#btn-si').on('click', function() {
    categorie.append($('[name='+nome+']')[0]);
    $('#quantita-'+nome).remove();
    $('#bottone-'+nome).remove();
    $('[name='+nome+']').attr('onclick',"addToCart(this)");
    $('#error2').modal('toggle');
    var sum = 0.0;
    $('#carrello > tr').each(function() {
        var qty = parseInt($(this).find('td[quantita=qta]').text());
        var price = parseFloat($(this).find('#prezzoprodottto').text());
        var amount = (qty*price);
        sum+=amount;
    });
    $('#prezzotot').text(sum.toFixed(2));
    checkPoor();
  });
  checkPoor();
}

function togliQuantita(id) {
  var int = $('#quantita-'+id).text();
  var togli = "<i onclick='togliQuantita("+id+")' id='togli-quantita' class='fas fa-arrow-alt-circle-left mx-2'></i>";
  var aggiungi = "<i onclick='aumentaQuantita("+id+")' id='aumenta-quantita' class='fas fa-arrow-alt-circle-right mx-2'></i>";
  int = parseInt(int);
  if(int >= 2){
    int--;
    $('#quantita-'+id).text(int.toString());
    $('#quantita-'+id).prepend(togli);
    $('#quantita-'+id).append(aggiungi);
  }
  var sum = 0.0;
    $('#carrello > tr').each(function() {
        var qty = parseInt($(this).find('td[quantita=qta]').text());
        var price = parseFloat($(this).find('#prezzoprodottto').text());
        var amount = (qty*price);
        sum+=amount;
    });
    $('#prezzotot').text(sum.toFixed(2));
    checkPoor();
}

function aumentaQuantita(id) {
  var quant = $("tr[name='"+id+"']").attr('quantita');
  quant = parseInt(quant);
  var prezzo = $("tr[name='"+id+"'] #prezzoprodottto").text();
  prezzo = parseFloat(prezzo);

  var int = $('#quantita-'+id).text();
  var togli = "<i onclick='togliQuantita("+id+")' id='togli-quantita' class='fas fa-arrow-alt-circle-left mx-2'></i>";
  var aggiungi = "<i onclick='aumentaQuantita("+id+")' id='aumenta-quantita' class='fas fa-arrow-alt-circle-right mx-2'></i>";
  int = parseInt(int);
  if(int < quant){
  int++;
    $('#quantita-'+id).text(int.toString());
    $('#quantita-'+id).prepend(togli);
    $('#quantita-'+id).append(aggiungi);
  }
  var sum = 0.0;
    $('#carrello > tr').each(function() {
        var qty = parseInt($(this).find('td[quantita=qta]').text());
        var price = parseFloat($(this).find('#prezzoprodottto').text());
        var amount = (qty*price);
        sum+=amount;
    });
    $('#prezzotot').text(sum.toFixed(2));
    checkPoor();
}

$('#tessera').on('input', function() {
  var tessera = $(this).val();
  if(tessera.length && tessera.length == 4){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type:'POST',
      url: '/ajax',
      dataType: "json",
      data:{_token: CSRF_TOKEN, tessera: tessera, type: 'getTessera'},
      success: function(data){
        if(data['cliente'] != null && data['credito'] != null){
          $('#creditoresiduo').text(parseFloat(data['credito']).toFixed(2)+" €");
          $('#nomecliente').text(data['cliente'].nome + ' ' + data['cliente'].cognome);
          checkPoor();
        } else {
          $('#creditoresiduo').text('');
          $('#nomecliente').text('');
          $('#paga').hide();
        };
      }
    });
  }else if(tessera.length && tessera.length > 0){
    $('#creditoresiduo').text('');
    $('#nomecliente').text('');
    $('#paga').hide();
  }
});

function checkPoor() {
    var prezzo = parseFloat($('#prezzotot').text());
    var credito = parseFloat($('#creditoresiduo').text());
    var rows = $('#carrello tr').length;
    if(rows <= 0){
        $('#paga').hide();
    }else{
        if(prezzo > credito){
            $('#creditoresiduo').addClass('text-danger');
            $('#creditoresiduo').removeClass('text-white');
            $('#notifycredito').fadeIn();
            $('#paga').hide();
        } else {
            $('#creditoresiduo').removeClass('text-danger');
            $('#creditoresiduo').addClass('text-white');
            $('#notifycredito').hide();
            $('#paga').show();
        }
    }
}

function paga() {
  var prodotti = {};

  $('#carrello > tr').each(function() {
      var qty = parseInt($(this).find('td[quantita=qta]').text());
      var codiceprodotto = $(this).attr('name');
      prodotti[codiceprodotto] = qty;
  });
  var totale = $('#prezzotot').text();
  var codtess = $('#tessera').val();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type:'POST',
    url: '/ajax',
    dataType: "json",
    data:{_token: CSRF_TOKEN ,list: prodotti, totale: totale, tessera: codtess, type: 'insertPayment'},
    success: function(data){
      if(data.status == true){
        $('#successo').modal('toggle');
        $.ajax({
          type:'POST',
          url: '/scontrino',
          dataType: "json",
          data:{_token: CSRF_TOKEN ,list: prodotti, totale: totale,tessera: codtess, type: 'acquisto'},
          success: function(data){
            setTimeout(function(){
                $('#successo').modal('toggle');
                location.href = '/home';
            },1200);
            // location.href = '/stampa_scontrino_acquisto';
          }
        });
        // $('#successo').modal('toggle');
        // $('#btn-si-successo').on('click', function() {
        // });
      };
    }
  });
}
$('button[id^="buttoncello"]').hide();
</script>
@endsection
