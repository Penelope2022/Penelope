# Penelope

Exemplo simples de integração com o Multicaixa Express utilizando a API da AppyPay.

Este repositório inclui o arquivo `multicaixa_express_demo.py`, que demonstra como criar um pedido de pagamento e redirecionar o usuário diretamente para concluir a transação no aplicativo Multicaixa Express.

## Requisitos
- Python 3.8 ou superior
- Bibliotecas `requests` e `Flask`
- Chave de API da AppyPay (definida na variável de ambiente `APPY_API_KEY`)

## Executando o exemplo

1. Instale as dependências:

```bash
pip install Flask requests
```

2. Defina sua chave da API:

```bash
export APPY_API_KEY=SEU_TOKEN_DA_APPYPAY
```

3. Execute o servidor de exemplo:

```bash
python multicaixa_express_demo.py
```

4. Acesse `http://localhost:5000` em seu navegador, informe o valor e clique em **Processar**. Você será redirecionado diretamente para o aplicativo Multicaixa Express para concluir o pagamento.
