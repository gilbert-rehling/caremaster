<x-mail::message>
    # New Company

    Hi,<br>
    A new company was created at {{ config('app.url') }} on {{ date("d-m-Y") }}.

    Company name: {{ $company->name }}<br>
    Company email: {{ $company->email }}

    <br>
    System email from,<br>
        {{ config('app.name') }}
</x-mail::message>
