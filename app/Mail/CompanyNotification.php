<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      CompanyNotification.php -  001 - 15 6 2023
 * @link         https://github.com/gilbert-rehling/caremaster
 * @copyright    Copyright (c) 2023.  Gilbert Rehling. All right reserved. (www.gilbert-rehling.com)
 * @license      Released under the MIT model
 * @author       Gilbert Rehling:    gilbert@gilbertrehling.com
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

namespace App\Mail;

/**
 * @uses
 */
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Handle company creation notifications
 */
class CompanyNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Company
     */
    public Company $company;

    /**
     * @param Company $company
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Get the message envelope.
     * This sets the subject
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Company Notification',
        );
    }

    /**
     * @return CompanyNotification
     */
    public function build()
    {
        return $this->markdown('email.new-company');
    }
}
