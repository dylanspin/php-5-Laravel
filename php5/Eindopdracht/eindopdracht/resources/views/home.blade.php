@extends('layouts.app')

@section('content')
<div class="jumbotron first">

</div>
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
            </div>
        </div>
    </div>
</div>
<!-- <footer class="footer">
    <div class="container">
        <span class="text-muted">© Copyright Music Inc</span>
    </div>
</footer> -->
@endsection
