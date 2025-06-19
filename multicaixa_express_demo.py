import os
import requests
from flask import Flask, request, redirect, render_template_string

# Configuração: defina sua chave da API da AppyPay no ambiente
APPY_API_KEY = os.environ.get("APPY_API_KEY")

if not APPY_API_KEY:
    raise EnvironmentError("Defina a variável de ambiente APPY_API_KEY com a sua chave da API AppyPay")

APPYPAY_ENDPOINT = "https://api.appypay.co.ao/v1/payments"

app = Flask(__name__)

FORM_HTML = """
<!doctype html>
<title>Pagamento Multicaixa Express</title>
<h1>Processar Pagamento</h1>
<form action="/processar" method="post">
  <label for="valor">Valor (AOA):</label>
  <input type="number" id="valor" name="valor" min="1" required>
  <button type="submit">Processar</button>
</form>
"""


def criar_pedido_pagamento(valor, descricao="Pagamento via Multicaixa Express"):
    """Cria um pedido de pagamento na API AppyPay e retorna o link para o app
    Multicaixa Express."""

    payload = {
        "amount": int(valor),
        "currency": "AOA",
        "description": descricao,
    }
    headers = {
        "Authorization": f"Bearer {APPY_API_KEY}",
        "Content-Type": "application/json",
    }

    resp = requests.post(APPYPAY_ENDPOINT, json=payload, headers=headers)
    resp.raise_for_status()

    data = resp.json()

    # A API da AppyPay pode retornar um deep link específico para o app
    # Multicaixa Express. Caso não esteja presente, utiliza o link de checkout
    # padrão da AppyPay como fallback.
    return data.get("mceDeeplink") or data.get("checkoutUrl")


@app.route("/")
def index():
    return render_template_string(FORM_HTML)


@app.route("/processar", methods=["POST"])
def processar_pagamento():
    valor = request.form.get("valor")
    if not valor:
        return "Valor inválido", 400

    try:
        checkout_url = criar_pedido_pagamento(valor)
    except requests.HTTPError as exc:
        return f"Erro ao criar pedido de pagamento: {exc}", 500

    # Redireciona o cliente diretamente para o aplicativo Multicaixa Express
    return redirect(checkout_url)


if __name__ == "__main__":
    app.run(debug=True)
