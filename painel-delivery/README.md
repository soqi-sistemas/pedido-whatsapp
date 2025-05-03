# Painel Delivery

Sistema simples para cadastro de produtos de delivery com painel administrativo em PHP.

## Funcionalidades

- Login do administrador (temporário: `admin` / `admin`)
- Cadastro de produtos por categoria: pizzas, lanches, porções, refrigerantes
- Suporte a imagem, sabores e preços por tamanho (média, grande, família, super família)
- Listagem com edição e exclusão de produtos
- Armazenamento local em `produtos.json`
- Upload de imagens em `uploads/`

## Estrutura

Veja a organização básica dos arquivos:

```
painel-delivery/
├── auth.php
├── atualizar_produto.php
├── dashboard.php
├── editar_produto.php
├── excluir_produto.php
├── index.php
├── login.php
├── logout.php
├── produtos.php
├── produtos.json
├── salvar_produto.php
├── uploads/
```

## Instruções

1. Suba para um servidor com PHP (como 000webhost, XAMPP, etc).
2. Acesse `index.php` e use o login:
   - **Usuário:** admin
   - **Senha:** admin
3. Comece cadastrando seus produtos no painel.

## Próximos passos

- Integração com Supabase
- Frontend de pedidos com envio via WhatsApp
- Gráficos e estatísticas de vendas
