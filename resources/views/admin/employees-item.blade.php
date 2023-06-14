@extends('layouts.app')

@section('content')
    <div class="container data">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('Employee') }}</strong>
                        <span class="pull-right">
                            <a href="/employees/create" title="{{ __('Add new employee') }}">{{ __('New') }}</a>
                        </span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($employee)

                            <ul>
                                <li>
                                    <ul class="item">
                                        <li>
                                            <a
                                                title="{{ __('Click to edit') }}"
                                                href="/employees/edit/{{ $employee->id }}"
                                            >{{ $employee->first_name }} {{ $employee->last_name }}
                                            </a>
                                        </li>
                                        <li>
                                            Company: {{ $employee->company->name }}
                                        </li>
                                        @if ($employee->email)
                                        <li>
                                            Email: {{ $employee->email }}
                                        </li>
                                        @endif
                                        @if ($employee->phone)
                                        <li>
                                            Phone: {{ $employee->phone }}
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                            <span class="pull-right">
                                <a href="/employees" title="{{ __('Back to list') }}">{{ __('Back') }}</a>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
