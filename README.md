# 🛗 Projeto Elevador (Simulação em PHP)

Este projeto é uma **simulação de um sistema de elevador**, desenvolvida em PHP com foco no **conceito de filas FIFO (First In, First Out)**.

O objetivo principal é modelar o comportamento de um elevador real:
- registrar chamados de andares
- processar esses chamados em ordem FIFO
- mover o elevador entre andares

O projeto foi pensado para rodar via **CLI (Artisan Command)**, sem dependência de banco de dados.

## Estrutura do projeto (simplificada)

```
app/
├── Console/
│ └── Commands/
│     └── TestarElevador.php
│
├── Domain/
│ └── Elevador/
│     └── Elevador.php
Dockerfile
docker-compose.yml

```

## ⚙️ O que o sistema faz

1. Cria um elevador com capacidade definida
2. Registra chamados para diferentes andares
3. Processa os chamados em ordem de chegada (FIFO)
4. Move o elevador para cada andar
5. Dispara logs a cada ação:
   - elevador instalado
   - chamado registrado
   - elevador em movimento
   - fila vazia

## Executando o projeto com Docker (recomendado)

### Pré-requisitos

- Docker
- Docker Compose

Verifique se estão instalados:

```
docker --version
docker-compose --version
```
- Build da imagem
Na raiz do projeto:

```
docker-compose build
```

- Rodar o comando do elevador

```
docker-compose run --rm app php artisan app:testar-elevador
```
O script irá:

criar o elevador

registrar chamados

mover o elevador

exibir os logs conforme os eventos acontecem

## Executando o projeto localmente (sem Docker)

### Pré-requisitos

- PHP 8.4

- Composer

- Laravel instalado corretamente

Verifique a versão do PHP:

```
php -v
```
 
Instalar dependências (se necessário)

```
composer install
```

Executar o comando Artisan

Na raiz do projeto:

```
php artisan app:testar-elevador
```

### Exemplo de saída no console

```
Elevador instalado no térreo com capacidade para 8 pessoas.
Andar atual: 0
Capacidade: 8
Fila: []
Chamado registrado para o andar 3. Posição na fila: 1
Chamado registrado para o andar 1. Posição na fila: 2
Chamado registrado para o andar 5. Posição na fila: 3
Chamado registrado para o andar 2. Posição na fila: 4

 Chamados adicionados
Andar atual: 0
Capacidade: 8
Fila: [3, 1, 5, 2]
Próximo chamado: 3
Fila atual: [3, 1, 5, 2]
Elevador saindo do andar 0...
Direção: subindo...
Elevador chegou no andar 3.
Chamados restantes na fila: 3
Estado após mover:
Andar atual: 3
Capacidade: 8
Fila: [1, 5, 2]
----------------------------------------
```

Projeto desenvolvido para processo seletivo da Catálise Investimentos.
