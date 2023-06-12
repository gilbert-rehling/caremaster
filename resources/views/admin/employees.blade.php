@extends('layouts.app')

@section('content')
    <div class="container data">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Employees') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Employee list:') }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
