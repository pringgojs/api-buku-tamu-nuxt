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
        <div class="flex-center position-ref full-height">
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

                <div id="">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="get" action="{{url('search')}}">
                                {!! csrf_field() !!}
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <table id="document" class="table table-responsive table-border" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Kolom</th>
                                                                <th>Operator</th>
                                                                <th>Pencarian</th>
                                                                <th style="width:5%"></th>
                                                            </tr>
                                                        </thead>
                                            
                                                    </table>
                                                    <table class="table table-responsive table-border" cellspacing="0" width="100%">
                                                        <tfoot>
                                                            <tr>
                                                                <td class="text-right pull-right" colspan="3">
                                                                    <div class="btn btn-sm btn-primary btn-lable-wrap left-label" onclick="addRow()"
                                                                        id="addRow">
                                                                        <span class="btn-label"><i class="fa fa-plus"></i> </span>
                                                                        <span class="btn-text">Tambah Filter</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Cari</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <script src="{{ asset('js/app.js') }}"></script>
	    <script src="{{ asset('js/all.js') }}"></script>

        <script>
            initDatetime(".date");
            
        </script>
        
        
        <script>
            /* Add document */
            var tb_document = $('#document').DataTable({
                bSort: false,
                bPaginate: false,
                bInfo: false,
                bFilter: false,
                bScrollCollapse: false
            });
            counter = 0;
            function addRow() {
                tb_document.row.add( [
                    `<select name="column[]" id="col-id-`+counter+`" placeholder="" required class="form-control">
                        @foreach ($columns as $column)
                        <option value="{{$column}}" >{{$column}}</option>
                        @endforeach
                    </select>`,
                    `<select name="operator[]" id="operator-id-`+counter+`" placeholder="" required class="form-control">
                        @foreach ($operators as $operator)
                        <option value="{{$operator}}" >{{$operator}}</option>
                        @endforeach
                    </select>`,
                    `<input type="text" name="keyword[]" class="form-control time" value="" placeholder="Misal. Pringgo Js">`,
                    `<a href="javascript:void(0)" class="remove-row"> <button type="button" class="btn btn-info btn-icon-anim btn-square"><i class="icon-trash"></i></button></a>`,
                ] ).draw( false );
                $('select').select2();
                counter++;
            }
            
            $('#document tbody').on('click', '.remove-row', function () {
                tb_document.row($(this).parents('tr')).remove().draw();
            });
        
            function selectEmployee(index) {
                id = $('.select2-'+index).val();
                $.ajax({
                    url: '{{url("api/employee")}}/'+id,
                    success: function(res) {
                        $('.nip-'+index).val(res.nip)
                    }
                })
            }
        
            $("#form-file").on('submit', (function(ev) {
                ev.preventDefault();
        
                $.ajax({
                    url: '{{url("sivitas/penelitian/member/store")}}',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(res) {
                        $("#modal-detail").html(res);
                    },
                    error: function(res, status, xhr) {
                        swal('Opps, something went wrong. Please try again');
                    },
                });
            }));
        </script>

    </body>
</html>
