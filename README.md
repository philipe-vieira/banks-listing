<h1 align="center">Banks Listing</h1>

<p align="center">
<img alt="Website" src="https://img.shields.io/website?url=http%3A%2F%2Fec2-98-81-163-76.compute-1.amazonaws.com%2F">
<img alt="GitHub Actions Workflow Status" src="https://img.shields.io/github/actions/workflow/status/philipe-vieira/banks-listing/laravel.yml?logo=githubactions&logoColor=white&label=tests">
<img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/philipe-vieira/banks-listing">
<img alt="GitHub top language" src="https://img.shields.io/github/languages/top/philipe-vieira/banks-listing">
<img alt="License" src="https://img.shields.io/badge/license-MIT-blue">
</p>


**Banks Listing** é uma aplicação web de teste projetada para fornecer uma maneira rápida de visualizar e buscar instituições financeiras. Através de sua interface simples, a aplicação exibe uma listagem paginada de bancos, permitindo aos usuários encontrar facilmente as instituições que estão procurando, com uma busca dinâmica que filtra os resultados em tempo real. A API conta com duas rotas principais que garantem uma boa navegação: a primeira, para obter a lista completa de bancos com paginação, e a segunda, para acessar informações detalhadas sobre qualquer banco específico.

<div align="center">
    <img alt="Home" src="./.github/images/home.png">
</div>

## Requisitos
- [Docker](https://docs.docker.com/engine/install/)
- [Docker Compose Plugin](https://docs.docker.com/compose/install/)


## Rodando localmente

Faça um clone do repositório localmente.

```bash
  git clone https://github.com/philipe-vieira/banks-listing; cd banks-listing
```

Faça uma cópia do arquivo `.env.example` para o `.env`, e configure as variáveis de ambiente conforme sua preferência.

```bash
  cp .env.example .env
```

Para executar esta aplicação localmente faça uma cópia do arquivo `.env.example` para `.env`, configure as variáveis de ambiente conforme sua preferência e use o comando abaixo para subir a aplicação

```bash
  docker compose -f docker-compose.yml up -d --build
```

## Rodando os testes

Após executar a aplicação é possivel rodar os teste utilizando o seguinte comando

```bash
  docker exec app bash -c "php artisan test"
```

## Documentação da API

#### Retorna todos os bancos

```http
  GET /api/bancos
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `perPage` | `int` | **Opcional**. A quantidade de itens em cada página da paginação |
| `page` | `ibt` | **Opcional**. A página de itens desejada |

#### Retorna um banco específico

```http
  GET /api/banco/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `codigo`    | `int` | **Obrigatório**. O ID do banco desejado |

## Tecnologias Utilizadas

![PHP](https://img.shields.io/badge/PHP-8.2-8993be?style=for-the-badge&logo=php&logoColor=white)
![Laravel Framework](https://img.shields.io/badge/Laravel-v11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.4-00758f?style=for-the-badge&logo=mysql&logoColor=white)
![HTML](https://img.shields.io/badge/HTML-5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white)
![jQuery](https://img.shields.io/badge/jQuery-1.9.1-0769AD?style=for-the-badge&logo=jquery&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Enabled-0db7ed?style=for-the-badge&logo=docker&logoColor=white)
![Nginx](https://img.shields.io/badge/Nginx-latest-009639?style=for-the-badge&logo=nginx&logoColor=white)
![AWS Services](https://img.shields.io/badge/Amazon%20Web%20Services-Enabled-FF9900?style=for-the-badge&logo=amazonwebservices&logoColor=white)

## Licença

Este projeto é open-source sob licença [MIT license](https://spdx.org/licenses/MIT.html).
