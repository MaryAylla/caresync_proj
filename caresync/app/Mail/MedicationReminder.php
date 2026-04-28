<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Medication;

class MedicationReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $medication;

    // Recebe o medicamento do Controller
    public function __construct(Medication $medication)
    {
        $this->medication = $medication;
    }

    // Define o assunto e a view do e-mail
    public function build()
    {
        return $this->subject('Lembrete de Medicamento: ' . $this->medication->name)
                    ->view('emails.medication_reminder');
    }
}