<?php

namespace App\Console\Commands;

use App\Domain\Elevador;
use Illuminate\Console\Command;

class TestarElevador extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testar-elevador';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $elevador = new Elevador(8);

        // Estado inicial
        $this->mostrarStatus($elevador);
        sleep(1);

        // Chamadas
        $elevador->chamar(3);
        $elevador->chamar(1);
        $elevador->chamar(5);
        $elevador->chamar(2);

        $this->info("\n📋 Chamados adicionados");
        $this->mostrarStatus($elevador);
        sleep(2);

        // Processamento da fila
        while (true) {
            $status = $elevador->status();

            if (empty($status['fila'])) {
                break;
            }

            $proximo = $status['fila'][0];

            $this->info("➡️ Próximo chamado: {$proximo}");
            $this->info("Fila atual: [" . implode(', ', $status['fila']) . "]");

            $elevador->mover();
            sleep(1);

            $this->info("📊 Estado após mover:");
            $this->mostrarStatus($elevador);

            $this->info(str_repeat('-', 40));
            sleep(2);
        }

        $this->info("✅ Todos os chamados foram processados");
    }

    /**
     * Exibe o status do elevador de forma padronizada
     */
    private function mostrarStatus(Elevador $elevador): void
    {
        $status = $elevador->status();

        $this->info("🛗 Andar atual: {$status['andar_atual']}");
        $this->info("👥 Capacidade: {$status['capacidade']}");
        $this->info("📋 Fila: [" . implode(', ', $status['fila']) . "]");
    }
}
