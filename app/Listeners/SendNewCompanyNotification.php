<?php

namespace App\Listeners;

/**
 * @uses
 */
use App\Events\NewCompanyNotification;
use App\Mail\CompanyNotification;
use Illuminate\Support\Facades\Mail;

/**
 * Listener - Primes the notification event
 */
class SendNewCompanyNotification
{
    /**
     * Destination address
     * ToDo: !! ideally this should be coming a configuration value !!
     *
     * @var string
     */
    //private string $toAddress = 'test@tester.com';
    private string $toAddress = 'gilbert.rehling@gmail.com';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the events action.
     *
     * @param NewCompanyNotification $event
     * @return void
     */
    public function handle(NewCompanyNotification $event)
    {
        Mail::to($this->toAddress)->send(
            new CompanyNotification($event->company)
        );
    }
}
