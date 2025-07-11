# Penelope Management System

Este projeto contém um esqueleto básico de um sistema de gestão utilizando Laravel 11 e TailwindCSS. Ele demonstra a estrutura sugerida no pedido e pode ser expandido para incluir recursos avançados.

## Requisitos
- PHP 8.2+
- Composer
- MySQL (ou MariaDB)

## Instalação
1. Clone o repositório e copie `.env.example` para `.env` ajustando as configurações de banco de dados.
2. Execute `composer install` para instalar as dependências.
3. Gere a chave da aplicação com `php artisan key:generate`.
4. Rode as migrações com `php artisan migrate`.
5. Popule as tabelas padrões rodando `php artisan db:seed`.
6. Inicie o servidor local com `php artisan serve`.

Esta estrutura contém exemplos de migrations, models, controllers e views utilizando Blade e TailwindCSS.

## Gerenciamento de Plugins Moodle

O módulo de plugins permite que o administrador envie arquivos de plugins gerados para o Moodle e os ative ou desative pelo painel administrativo. Os arquivos enviados são armazenados em `storage/app/plugins` e os registros ficam salvos na tabela `plugins`.

## Layout Inovador

O projeto agora utiliza um layout base em `resources/views/layouts/app.blade.php` com cabeçalho em gradiente e navegação simplificada. Todos os formulários e páginas principais estendem esse layout e exibem mensagens de sucesso através do componente `components.flash`.

## Soft Deletes

Clientes e plugins agora usam Soft Deletes. Um novo migration adiciona a coluna `deleted_at` e o `PluginService` remove o arquivo do plugin ao excluí-lo. Use `php artisan migrate` para aplicar.

## Esqueleto Avançado

- Rotas de API em `routes/api.php` prontas para uso com Laravel Sanctum
- Repositórios em `app/Repositories` para abstrair acesso a dados
- Controladores de API em `app/Http/Controllers/Api` usando o padrão REST
- Testes de exemplo com Pest em `tests/Feature`
- Arquivo `phpunit.xml` para execução de testes

Esses arquivos adicionais servem como ponto de partida para evoluir o sistema sem alterar o código existente.
