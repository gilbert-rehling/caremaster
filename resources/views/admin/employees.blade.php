@extends('layouts.app')

@section('content')
    <div class="container data">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('Employees list') }}</strong>
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

                            @if (count($employees))
                                <ul>
                                    @foreach ($employees as $employee)
                                        <li>
                                            <ul class="item">
                                                <li>
                                                    <a
                                                        title="{{ __('Click to edit') }}"
                                                        href="/employees/edit/{{ $employee->id }}"
                                                    >
                                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                                    </a>
                                                    <span class="pull-right">
                                                        <a href="/employees/{{ $employee->id }}" title="{{ __('View employee') }}">{{ __('View') }}</a>
                                                    </span>
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
                                    @endforeach
                                </ul>

                                <hr>
                                {{ $employees->links() }}
                            @else
                                <strong>{{ __('No employees found!') }}</strong>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
