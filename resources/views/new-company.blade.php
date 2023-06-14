@component('mail::message')
    <h1>New Company Created</h1>

    Hi,
        A new company was created at {{ config('app.url') }} on {{ date("d-m-Y") }}.

    Company name: {{ $company->name }}<br>
    Company email: {{ $company->email }}

    <br>
    System email from,<br>
        {{ config('app.name') }}

@endcomponent
