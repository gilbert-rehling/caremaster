<?php

namespace App\Mail;

use Illuminate\Mail\Mailables;

/**
 * Handle company creation notifications
 */
class CompanyNotification
{
    /**
     * @var
     */
    private $company;

    /**
     * @param $company
     * @return void
     */
    public function __constructor($company): void
    {
        $this->company = $company;
    }

    /**
     * @return CompanyNotification
     */
    public function build(): CompanyNotification
    {
        return $this->markdown('email.companyCreated')
            -with([
                'company' => $this->company
            ]);
    }
}
