# 📦 Sistema de Gestão de Inventário (API)

O projeto consiste em uma API robusta para controle de estoque, focada em automação de processos e integridade de dados, permitindo gerenciar o ciclo de vida de produtos e suas movimentações financeiras/físicas.

---

## Funcionalidades

* **CRUD Completo:** Criação, Leitura, Atualização e Exclusão de produtos.
* **Movimentação Automatizada:**
    * Registro de **Vendas** (Saídas) com baixa automática no estoque.
    * Registro de **Entradas** (Compras) com incremento automático no estoque.
* **Sistema de Alerta Inteligente:** * Monitoramento via **Events e Listeners** para níveis críticos de estoque.
    * Geração de logs automáticos em tempo real.
* **Segurança e Validação:**
    * Proteção contra Mass Assignment via Eloquent `$fillable`.
    * Validação de dados centralizada em **Form Requests**.
    * Restrições de integridade no banco de dados (Foreign Keys).
* **Feedback Dinâmico:** Respostas JSON que incluem alertas contextuais de estoque baixo.

---

## Tecnologias Utilizadas

* **Back-end:** PHP 8.5 / Laravel 13
* **Banco de Dados:** MySQL
* **Arquitetura:** REST API (Padrão de rotas `apiResource`)
* **Ferramentas de Teste:** Insomnia / Postman

---

## Incrementações

* **Logs do Servidor:** Implementado registro de auditoria em `storage/logs/laravel.log` para monitorar níveis de estoque.
* **Respostas Inteligentes:** Inclusão de chaves de alerta dinâmicas no corpo do JSON para facilitar a integração com o Front-end.

---

## Estrutura do Projeto

O projeto segue a estrutura padrão do Laravel, com foco nos seguintes diretórios customizados:

```
├── app/
│   ├── Events/         # Eventos disparados (Ex: Estoque alterado)
│   ├── Listeners/      # Ouvintes para lógica de alerta (Ex: Verificar nível)
│   ├── Http/
│   │   ├── Controllers/# Lógica de processamento das rotas
│   │   └── Requests/   # Validações de segurança e tipos de dados
│   └── Models/         # Representação das tabelas e relacionamentos
├── database/
│   └── migrations/     # Estrutura das tabelas de Produtos e Movimentações
├── routes/
│   └── api.php         # Definição dos Endpoints da aplicação
└── storage/
    └── logs/           # Local onde são registrados os alertas de estoque
