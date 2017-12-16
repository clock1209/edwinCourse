<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.css') }}">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
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
            Usuarios
        </div>

        <div class="table-responsive" style="width: 1000px;">
            <table class="table table-striped table-hover table-condensed table-bordered"  class="display nowrap"  id="users-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Posts</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>
</div>
</body>

<script src="{{ asset('/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        var table = $('#users-table').DataTable( {
            processing: true,
            serverSide: true,
            ajax: '{!! route('user.data') !!}',
            lengthChange: false,
            buttons: [ 'excel', 'pdf', 'print', 'copy', 'csv',{
                extend: 'colvisGroup',
                text: 'Resumir',
                show: [ 1, 1 ],
                hide: [ 3, 4 ]
            },
                {
                    extend: 'colvisGroup',
                    text: 'Completa',
                    show: ':hidden'
                } ],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'posts', name: 'posts.title' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' }
            ],
            initComplete : function () {
                table.buttons().container()
                    .appendTo( $('#users-table_wrapper .col-sm-6:eq(0)').css('text-align', 'left'));
            }
        });
    });
</script>
</html>
