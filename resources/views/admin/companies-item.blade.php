@extends('layouts.app')

@section('content')
    <div class="container data">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('Company') }}</strong>
                        <span class="pull-right">
                            <a href="/companies/create" title="{{ __('Add new company') }}">{{ __('New') }}</a>
                        </span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($company)

                            <ul>
                                <li>
                                    <ul class="item">
                                        <li>
                                            <a title="{{ __('Click to edit') }}" href="/companies/edit/{{ $company->id }}">{{ $company->name }}</a>
                                        </li>
                                        <li>
                                            @if ($company->logo)
                                            <img
                                                alt="{{ $company->name }} Logo"
                                                src="/storage/images/{{ $company->logo }}"
                                                class=""
                                            />
                                            @else
                                            <img
                                                alt="Company has no logo"
                                                src="/storage/images/no-image.jpg"
                                                class="list-image"
                                            />
                                            @endif
                                        </li>
                                        @if ($company->email)
                                        <li>
                                            Email: {{ $company->email }}
                                        </li>
                                        @endif
                                        @if ($company->website)
                                        <li>
                                            Website: {{ $company->website }}
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
