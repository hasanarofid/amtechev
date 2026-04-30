<?php

namespace App\Mail;

use App\Models\Affiliate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AffiliateRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $affiliate;

    public function __construct(Affiliate $affiliate)
    {
        $this->affiliate = $affiliate;
    }

    public function build()
    {
        return $this->subject('Welcome to Amtech Affiliate Program!')
                    ->markdown('emails.affiliate.registered');
    }
}
