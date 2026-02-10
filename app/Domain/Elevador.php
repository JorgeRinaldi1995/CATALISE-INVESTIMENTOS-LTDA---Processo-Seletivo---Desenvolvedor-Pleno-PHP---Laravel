<?php

namespace App\Domain;

use InvalidArgumentException;
use SplQueue;

/**
 * Classe Elevador - Implementação de um sistema de elevador baseado em fila FIFO
 * 
 * Uso básico:
 * 1. Instancie o elevador: $elevador = new Elevador(10);
 * 2. Adicione chamadas: $elevador->chamar(3);
 * 3. Processe chamadas: $elevador->mover();
 * 4. Verifique estado: $elevador->getAndarAtual();
 */

class Elevador
{
    /**
     * @var SplQueue Fila de chamados pendentes
     */
    private $filaChamados;

    /**
     * @var int Andar atual do elevador
     */
    private $andarAtual;

    /**
     * @var int Capacidade máxima de pessoas
     */
    private $capacidade;

     /**
     * Construtor da classe Elevador
     * 
     * @param int $capacidade Capacidade máxima de pessoas no elevador
     */
    public function __construct(int $capacidade){
        $this->filaChamados = new SplQueue();
        $this->andarAtual = 0;
        $this->capacidade = $capacidade;

        echo "Elevador instalado no térreo com capacidade para {$capacidade} pessoas.\n";
    }

    /**
     * Adiciona um chamado à fila do elevador
     * 
     * @param int $andar Andar para onde o elevador deve ir
     * @throws InvalidArgumentException Se o andar for inválido
     */
    public function chamar(int $andar): void {
        if ($andar < 0){
            throw new InvalidArgumentException("Andar inválido. Deve ser maior ou igual a 0.");
        }

        $this->filaChamados->enqueue($andar);
        echo  "Chamado registrado para o andar {$andar}. Posição na fila: {$this->filaChamados->count()}\n";
    }

    /**
     * Processa o próximo chamado na fila
     * 
     * Move o elevador para o próximo andar na fila de chamados
     */
    public function mover(): void {
        $andarAtual = $this->getAndarAtual();

        if ($this->filaChamados->isEmpty()) {
            echo  "Não há chamados pendentes. Elevador parado no andar {$andarAtual}.";
            return;
        }

        $proximoAndar = $this->filaChamados->dequeue();

        echo "Elevador saindo do andar {$andarAtual}...\n";
        
        $direcao = $proximoAndar > $andarAtual ? "subindo" : "descendo";

        echo "Direção: {$direcao}...\n";

        $this->andarAtual = $proximoAndar;

        echo "Elevador chegou no andar {$this->andarAtual}.\n"; 
        echo "Chamados restantes na fila: {$this->filaChamados->count()}\n";
    }

    /**
     * Retorna o andar atual do elevador
     * 
     * @return int Andar atual
     */
    public function getAndarAtual(): int
    {
        return $this->andarAtual;
    }

    /**
     * Retorna uma cópia da fila de chamados pendentes
     * 
     * @return SplQueue Cópia da fila de chamados
     */
    public function getChamadosPendentes(): SplQueue
    {
        return clone $this->filaChamados;
    }

    /**
     * Método auxiliar para visualizar o estado atual do elevador
     */
    public function status(): array
    {
        return [
            'andar_atual' => $this->getAndarAtual(),
            'capacidade' => $this->capacidade,
            'fila' => iterator_to_array($this->getChamadosPendentes()),
        ];
    }
}
