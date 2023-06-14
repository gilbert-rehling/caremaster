<?php

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
