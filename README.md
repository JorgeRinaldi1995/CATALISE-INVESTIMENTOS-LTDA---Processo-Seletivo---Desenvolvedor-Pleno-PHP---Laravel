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
Elevador instalado (capacidade 8)
Chamado registrado para o andar 3
Chamado registrado para o andar 1
subindo do 0 para 3
Elevador chegou no andar 3
Chamados restantes: 3
...
```

Projeto desenvolvido para processo seletivo da Catálise Investimentos.
