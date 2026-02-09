<?php

namespace App\Console\Commands;

use App\Models\Elevador;
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

        $this->info("🚀 Elevador iniciado no térreo\n");
        sleep(1);

        $elevador->chamar(3);
        $elevador->chamar(1);
        $elevador->chamar(5);
        $elevador->chamar(2);

        $this->info("📋 Fila: [" . implode(', ', $elevador->filaComoArray()) . "]\n");
        sleep(2);

        while (!empty($elevador->filaComoArray())) {

            $filaAntes = $elevador->filaComoArray();
            $proximo = $filaAntes[0];

            $this->info("➡️ Próximo chamado: {$proximo}");
            $this->info("📋 Fila: [" . implode(', ', $filaAntes) . "]");

            $elevador->mover();
            sleep(1);

            $filaAgora = $elevador->filaComoArray();
            $this->info("📋 Fila agora: [" . implode(', ', $filaAgora) . "]");
            $this->info(str_repeat('-', 40));
            sleep(2);
        }

        $this->info("✅ Todos os chamados foram processados");
    }
}
