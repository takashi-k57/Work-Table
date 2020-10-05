@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

                <table>
                    <tr>
                        <td style="border:1px solid black; padding:1em;"></td>
                        @include('admin.daytd')
                        <td style="border:1px solid black; padding:1em;" rowspan="2">日勤</td>
                        <td style="border:1px solid black; padding:1em;" rowspan="2">公休</td>
                        <td style="border:1px solid black; padding:1em;" rowspan="2">有給</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black; padding:1em;"></td>
                        @include('admin.dayofweektd')
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td style="border:1px solid black; padding:1em;">{{ $user->name }}</td>
                            @include('admin.userdescriptiontd')
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
