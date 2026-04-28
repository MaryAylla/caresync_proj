<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SpecialDate;
use App\Mail\CelebrationMessage;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendCelebrations extends Command
{
    protected $signature = 'app:send-celebrations';
    protected $description = 'Verifica se há datas especiais hoje e dispara os e-mails';

    public function handle()
    {
        $this->info('Iniciando a busca por datas especiais de hoje...');

        $hoje = Carbon::now()->format('m-d');

        $datasDeHoje = SpecialDate::whereRaw('DATE_FORMAT(event_date, "%m-%d") = ?', [$hoje])->get();

        if ($datasDeHoje->isEmpty()) {
            $this->info('Nenhum evento para hoje.');
            return;
        }

        foreach ($datasDeHoje as $data) {
            Mail::to($data->user->email)->send(new CelebrationMessage($data));
            $this->info('E-mail enviado para: ' . $data->user->email . ' sobre ' . $data->title);
        }

        $this->info('Processo concluído com sucesso!');
    }
}