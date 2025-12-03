<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define o agendamento dos comandos da aplicação.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Executa diariamente a limpeza de clientes inativos (sem compras há 30 dias)
        $schedule->command('clients:prune-inactive')->daily();
    }

    /**
     * Registra os comandos da aplicação.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
