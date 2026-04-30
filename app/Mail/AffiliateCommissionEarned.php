<?php

namespace App\Mail;

use App\Models\AffiliateCommission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AffiliateCommissionEarned extends Mailable
{
    use Queueable, SerializesModels;

    public $commission;

    public function __construct(AffiliateCommission $commission)
    {
        $this->commission = $commission;
    }

    public function build()
    {
        return $this->subject('You\'ve Earned a New Commission!')
                    ->markdown('emails.affiliate.commission_earned');
    }
}
