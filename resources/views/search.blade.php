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
                                    @foreach($results as $row => $biodata)
                                    <?php 
                                    // dd($biodata->fileDiri);
                                    // if ($biodata->suamiIstri) continue;
                                    if ($biodata->fileDiri) {
                                        $foto='https://simashebat.ponorogo.go.id/files_scan/'.$biodata->fileDiri->file_foto;
                                    } else {
                                        $foto = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fpiotrkowalski.pw%2Fen%2Fdjango-filer-image-uploaded-but-not-showing&psig=AOvVaw2u9TV1JdmEJvPNWQ9AgHat&ust=1613608086857000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCNiX5-TU7-4CFQAAAAAdAAAAABAJ';
                                    };?>
                                    <tr id="tr-{{$biodata->pegawai_id}}">
                                        <td><img style="width:100px; height:auto" src="{{ $foto}}" alt=""></td>
                                        <td class="text-left">{{$biodata->nama}} <br>
                                            Jab Fungsional: {{$biodata->jabFungsional ? $biodata->jabFungsional->instansi: '-'}} <br>
                                            Jab Strukural: {{$biodata->jabStruktural ? $biodata->jabStruktural->instansi: '-'}} <br>
                                            Jab Pelaksana: {{$biodata->jabPelaksana ? $biodata->jabPelaksana->instansi: '-'}}
                                        </td>
                                        <td>{{$biodata->suamiIstri? 'Rabi' : 'Jomblo'}}</td>
                                        <td>{{$biodata->nip_baru}}</td>
                                        <td>{{$biodata->tgl_lahir}}</td>
                                        <td>{{$biodata->alamat}}</td>
                                        <td>{{$biodata->no_hp}}</td>
                                        <td>
                                            <a target="_blank" href="https://www.facebook.com/search/people/?q={{$biodata->nama}}" data-toggle="tooltip" title="Edit">
                                                <button class="btn btn-default btn-icon-anim btn-sm">Search To FB</button>
                                            </a>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
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
