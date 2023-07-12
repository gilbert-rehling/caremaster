<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      SendNewCompanyNotification.php -  001 - 15 6 2023
 * @link         https://github.com/gilbert-rehling/caremaster
 * @copyright    Copyright (c) 2023.  Gilbert Rehling. All right reserved. (https://github.com/gilbert-rehling)
 * @license      Released under the MIT model
 * @author       Gilbert Rehling:    gilbert@gilbert-rehling.com
 * This kickstart project provides basic authentication along with modeling for 2 data sets with a foreign key example
 * Created using Laravel 9.* on PHP 8.0.
 * To get started download and extract the package to your desired location.
 * Run: composer install.
 * Create an appropriate database. MySQL was used for this project.
 * Create and populate the .env file
 * Run: php artisan migrate
 * To seed the admin user run: php artisan db:seed --class=CreateUser
 * Seed data is also available for the Companies dataset.
 * Run: php artisan storage:link - to enable access to the public images
 */

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
    private string $toAddress = 'test@tester.com';

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
