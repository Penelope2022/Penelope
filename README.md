# Penelope React User System

Este projeto demonstra um sistema simples de login, cadastro e painel administrativo usando **React**. A camada de serviço (`src/services/api.js`) foi pensada para ser facilmente substituída por chamadas de qualquer backend.

## Estrutura
- `frontend/`: aplicação React com formulários de login e cadastro e um painel administrativo protegido.

## Como executar
1. Acesse a pasta `frontend` e instale as dependências:
   ```bash
   npm install
   ```
2. Inicie o servidor de desenvolvimento:
   ```bash
   npm start
   ```
A aplicação ficará disponível em `http://localhost:3000`.

Sinta-se à vontade para adaptar `src/services/api.js` para integrar com o backend desejado.
