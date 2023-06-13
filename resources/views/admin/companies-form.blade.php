@extends('layouts.app')

@section('content')
    <div class="container data">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('Company') }}</strong>
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
                        <strong>{{ __('Update:') }}</strong>
                        <form action="/companies/edit/{{ $company->id }}" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="id" id="id" value="{{ $company->id }}">
                        @else
                        <strong>{{ __('Add New:') }}</strong>
                        <form action="/companies/create" enctype="multipart/form-data" method="post">
                        @endif

                            @csrf
                            <ul class="form">
                                <li>
                                    <label for="name">{{ __('Company name') }}:</label>
                                    @isset($company)
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            placeholder="Company name"
                                            required
                                            value="{{ $company->name }}"
                                        >
                                    @else
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            placeholder="Company name"
                                            required
                                            value="{{ old('name') }}"
                                        >
                                    @endisset
                                    @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </li>

                                <li>
                                    <label for="email">{{ __('Company email')  }}:</label>
                                    @isset($company)
                                        <input type="email" name="email" id="email" placeholder="Company email address"
                                            value="{{ $company->email }}">
                                    @else
                                        <input type="email" name="email" id="email" placeholder="Company email address"
                                           value="{{ old('email') }}">
                                    @endisset
                                    @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </li>

                                <li>
                                    <label for="website">{{ __('Company website') }}:</label>
                                    @isset($company)
                                        <input type="url" name="website" id="website" placeholder="Company website (https://www.company.com)"
                                            value="{{ $company->website }}">
                                    @else
                                        <input type="url" name="website" id="website" placeholder="Company website (https://www.company.com)"
                                               value="{{ old('website') }}">
                                    @endisset
                                    @error('website')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </li>

                                <li>
                                    @isset($company)
                                        @isset($company->logo)
                                            <img alt="" title="" src="{{ asset('storage/images/' . $company->logo) }}"/>
                                        @endisset
                                    @endisset
                                    <label for="logo">{{ __('Company logo') }}:</label>
                                    <input type="file" name="logo" id="logo" accept=".jpg,.jpeg,.png,.gif">
                                    @error('logo')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </li>

                                <li>
                                    <button class="btn btn-outline-primary" type="submit">Submit</button>
                                    <button class="btn btn-secondary" type="reset">Clear</button>
                                </li>
                            </ul>
                        </form>
                        @isset($company)
                            <span class="pull-right">
                                <a
                                    href="/companies/delete/{{ $company->id }}"
                                    onclick="return confirm('Delete this company? Action cannot be reverted..');"
                                >
                                    <button
                                        title="{{ __('Delete Company') }}"
                                        class="btn btn-danger"
                                    >
                                        {{ __('Delete') }}
                                    </button>
                                </a>
                            </span>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
