@extends('layouts.app')

@section('content')
    <div class="container data">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('Employee') }}</strong>
                        <span class="pull-right">
                            <a href="/employees" title="{{ __('Return to list') }}">{{ __('Back') }}</a>
                        </span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @isset($employee)
                        <strong>{{ __('Update:') }}</strong>
                        <form action="/employees/edit/{{ $employee->id }}" method="post">
                            <input type="hidden" name="id" id="id" value="{{ $employee->id }}">
                        @else
                        <strong>{{ __('Add New:') }}</strong>
                        <form action="/employees/create" method="post">
                        @endif

                            @csrf

                            <ul class="form">
                                <li>
                                    <label for="first_name">{{ __('Employee first name') }}:</label>
                                    @isset($employee)
                                        <input
                                            type="text"
                                            name="first_name"
                                            id="first_name"
                                            placeholder="Employee first name"
                                            required
                                            value="{{ $employee->first_name }}"
                                        >
                                    @else
                                        <input
                                            type="text"
                                            name="first_name"
                                            id="first_name"
                                            placeholder="Employee first name"
                                            required
                                            value="{{ old('first_name') }}"
                                        >
                                    @endisset
                                    @error('first_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </li>

                                <li>
                                    <label for="last_name">{{ __('Employee last name') }}:</label>
                                    @isset($employee)
                                        <input
                                            type="text"
                                            name="last_name"
                                            id="last_name"
                                            placeholder="Employee last name"
                                            required
                                            value="{{ $employee->last_name }}"
                                        >
                                    @else
                                        <input
                                            type="text"
                                            name="last_name"
                                            id="last_name"
                                            placeholder="Employee last name"
                                            required
                                            value="{{ old('last_name') }}"
                                        >
                                    @endisset
                                    @error('last_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </li>

                                <li>
                                    <label for="company">{{ __('Employee company')  }}:</label>
                                    <select name="company_id" id="company_id" required>
                                        <option>Please select the employees company</option>
                                        @foreach ($companies as $company)
                                            @isset($employee)
                                                <option value="{{ $company->id }}"
                                                        @if ($employee->company_id == $company->id)
                                                            selected="selected"
                                                        @endif
                                                >{{ $company->name }}</option>
                                            @else
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endisset
                                        @endforeach
                                    </select>
                                </li>

                                <li>
                                    <label for="email">{{ __('Employee email')  }}:</label>
                                    @isset($employee)
                                        <input type="email" name="email" id="email" placeholder="Employee email address"
                                            value="{{ $employee->email }}">
                                    @else
                                        <input type="email" name="email" id="email" placeholder="Employee email address"
                                           value="{{ old('email') }}">
                                    @endisset
                                    @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </li>

                                <li>
                                    <label for="phone">{{ __('Employee phone') }}:</label>
                                    @isset($employee)
                                        <input type="text" name="phone" id="phone" placeholder="Employee phone (0444555777)"
                                            value="{{ $employee->phone }}">
                                    @else
                                        <input type="text" name="phone" id="phone" placeholder="Employee phone (0444555777)"
                                               value="{{ old('phone') }}">
                                    @endisset
                                    @error('phone')
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
                        @isset($employee)
                            <span class="pull-right">
                                <a
                                    href="/employees/delete/{{ $employee->id }}"
                                    onclick="return confirm('Delete this employee? Action cannot be reverted..');"
                                >
                                    <button
                                        title="{{ __('Delete employee') }}"
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
