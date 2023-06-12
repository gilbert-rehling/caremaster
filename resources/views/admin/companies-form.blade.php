@extends('layouts.app')

@section('content')
    <div class="container data">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Companies') }}
                        <span class="pull-right">
                            <a href="/companies" title="{{ __('Return to list') }}">{{ __('Back') }}</a>
                        </span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @isset($company)
                        <strong>{{ __('Update Company:') }}</strong>
                        <form action="/companies/edit/{{ $company->id }}" method="post">
                            <input type="hidden" name="id" id="id" value="{{ $company->id }}">
                        @else
                        <strong>{{ __('Add New Company:') }}</strong>
                        <form action="/companies/create/" method="post">
                        @endif

                            <ul class="form">
                                <li>
                                    <label for="name">{{ __('Company name') }}:</label>
                                    @isset($company)
                                        <input type="text" name="name" id="name" placeholder="Company name"
                                           value="{{ $company->name }}"
                                        >
                                    @else
                                        <input type="text" name="name" id="name" placeholder="Company name"
                                               value=""
                                        >
                                    @endisset
                                </li>

                                <li>
                                    <label for="email">{{ __('Company email')  }}:</label>
                                    @isset($company)
                                        <input type="email" name="email" id="email" placeholder="Company email address"
                                            value="{{ $company->email }}">
                                    @else
                                        <input type="email" name="email" id="email" placeholder="Company email address"
                                           value="">
                                    @endisset
                                </li>

                                <li>
                                    <label for="website">{{ __('Company website') }}:</label>
                                    @isset($company)
                                        <input type="url" name="website" id="website" placeholder="Company website (https://www.company.com)"
                                            value="{{ $company->website }}">
                                    @else
                                        <input type="url" name="website" id="website" placeholder="Company website (https://www.company.com)"
                                               value="">
                                    @endisset
                                </li>

                                <li>
                                    <label for="logo">{{ __('Company logo') }}:</label>
                                    <input type="file" name=logo" id="logo">
                                </li>

                                <li>
                                    <button type="submit">Submit</button>
                                    <button type="reset">Clear</button>
                                </li>
                            </ul>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
