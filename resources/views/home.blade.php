@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if(Auth::user())
                        {{ __('Вы авторизировались!') }}
                        @else
                        {{ __('Вы не авторизованы!') }}
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
