# EduManager Skeleton

This repository contains a basic database schema and a simple PHP prototype for the EduManager school management system. It now includes early academic, financial and homework features and is intended as a starting point for further development.

## Structure
- `db/init_schema.sql` – core tables and RPC functions (`verificar_perfil`, `atualizar_senha`, `registrar_login`, `gerar_boletim`, `emitir_recibo`, `notificar`, `get_agenda_professor`, `gerar_fatura_agt`, `listar_tarefas_por_turma`, `responder_tarefa`, `avaliar_resposta_tarefa`).
- `db/seed.sql` – initial data for levels, courses, a sample class, evaluation, payment, notifications, a demo task and an example message.
- `frontend/` – PHP pages for login, dashboard, profile (password update), student report card, task submission and simple messaging.
- `.env.example` – example environment variables for database connection.

## Usage
1. Create a PostgreSQL database and run `db/init_schema.sql` then `db/seed.sql`.
2. Copy `.env.example` to `.env` and adjust credentials.
3. Place the `frontend/` folder in your PHP server root and access `index.php`.

This remains a minimal foundation; advanced modules (complete finance, agenda, notifications, etc.) should be implemented on top of this structure.
