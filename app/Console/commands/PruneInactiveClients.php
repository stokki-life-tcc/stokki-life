<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cliente;
use Carbon\Carbon;

class PruneInactiveClients extends Command
{
    protected $signature = 'clients:prune-inactive';
    protected $description = 'Remove clientes sem atividade há 30 dias';

    public function handle()
    {
        $limite = Carbon::now()->subDays(30);

        $removidos = Cliente::whereDoesntHave('vendas', function($q) use ($limite) {
            $q->where('created_at', '>=', $limite);
        })->delete();

        $this->info("Clientes removidos: {$removidos}");
        return 0;
    }
}
