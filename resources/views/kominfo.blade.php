<?php use Illuminate\Support\Facades\Input;?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/app.css')}}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/all.css')}}" />
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center ">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    SIMPEG-PONOROGO
                </div>
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Status Kawin</th>
                                        <th>NIP</th>
                                        <th>Tgl. Lahir</th>
                                        <th>TLP</th>
                                        <th>Pencarian Fb</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('_data', ['results' => $fungsional])
                                    @include('_data', ['results' => $struktural])
                                    @include('_data', ['results' => $pelaksana])
                                </tbody>
                            </table>
                        </div>
                        @if (\Request::segment(1) != 'kominfo')
                        {{$results->appends(['column' => Input::get('column'),'operator' => Input::get('operator'),'keyword' => Input::get('keyword') ])->links()}}
                        @endif
                    </div>
                </div>

            </div>
        </div>


        <script src="{{ asset('js/app.js') }}"></script>
	    <script src="{{ asset('js/all.js') }}"></script>

        <script>
            initDatetime(".date");
            
        </script>

    </body>
</html>
