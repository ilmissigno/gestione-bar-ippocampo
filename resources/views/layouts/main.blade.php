<!DOCTYPE html>
<html lang="it-IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--Bootstraps4-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Bootstrap5-->
    <!-- CSS only -->
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!--foglio css-->
    <link rel="shortcut icon" href="{{Storage::url('favicon.ico')}}">
    <!--foglio javascript-->
    <title>Bar Ippocampo</title>
    <style>
        body{
            background: rgb(0,52,68);
            background: linear-gradient(0deg, rgba(0,52,68,1) 0%, rgba(0,121,171,1) 51%, rgba(0,120,255,1) 100%);
        }
        #statusalert{
            margin-top: 60px;
        }
        #logout {
            position: absolute;
            top:0;
            right:100;
            z-index:100;
        }
        #goback {
            position: absolute;
            top:0;
            left:100;
            z-index:100;
        }
    </style>

    @yield('css')

</head>
<body>
    <?php if(Auth::check()){ ?>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{Storage::url('favicon.ico')}}" alt="" width="30" height="30" class="d-inline-block align-text-top">
                Gestione Bar Ippocampo
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(Route::currentRouteName() !== 'login' && Route::currentRouteName() !== 'home' && Route::currentRouteName() !== '/'){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">Home <i class="fa-solid fa-house"></i></a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}">Logout <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php } ?>
    @yield('content')

    <!--Bootstraps4-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <!--fine bootstraps4-->
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if($('table').length > 0){
            if($('#tabhome').length <= 0){
                $('table').parent().parent().prepend('<div class="text-center" style="margin:0 auto;"><button type="button" class="btn btn-success mb-3" style="width: 200px; height: 50px;" id="buttoncello" onclick="onFtillo()">Esporta</button></div>');
                $('table thead tr').addClass('excel-head');
                $('table tbody tr').addClass('excel-body');
            }
        };
        var head = $('.excel-head').text();
        var body = $('.excel-body').text();
        function onFtillo() {
            $.ajax({
            type: "POST",
            url:"/ajax",
            data:{_token: CSRF_TOKEN, head: head, body: body, type: 'export'},
            success: function (data) {
                if (data.status) {
                location.href = data.url;
                }
            }
            });
        }
        $(document).ready(function () {
          if($('#statusalert').text().length > 0){
            var e = $('#msgsuccess');
            e.css({'transition': '0.5s'});
            e.prop('hidden', false);
            setInterval(() => {
              e.css({'opacity': '0%'});
              $('#statusalert').css({'opacity': '0%'});
            }, 5000);
          }
        });
    </script>
    @yield('js')
</body>
</html>
