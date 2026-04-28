<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SpecialDate;

class CelebrationMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $specialDate;

    public function __construct(SpecialDate $specialDate)
    {
        $this->specialDate = $specialDate;
    }

   public function build()
{
    // Lógica para o Assunto 
    $assunto = match($this->specialDate->category) {
        'Aniversário' => 'Feliz Aniversário! 🎉',
        'Natal' => 'Feliz Natal do CareSync! 🎄',
        'Páscoa' => 'Uma Páscoa abençoada para você! 🐰',
        default => 'Um lembrete especial: ' . $this->specialDate->title
    };

    return $this->subject($assunto)->view('emails.celebration');
}
}