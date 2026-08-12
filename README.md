# 🚀 phpMyAdmin Local Standalone & Docker Runner

<p align="center">
  <img src="https://www.phpmyadmin.net/static/images/logo-og.png" width="220" alt="phpMyAdmin Logo">
</p>

> **Um ambiente leve, pré-configurado e portátil do phpMyAdmin com suporte a login automático via `.env`, limites de upload expandidos para até 2GB, suporte a portas customizadas do MySQL e execução nativa (PHP embutido) ou via Docker Compose.**

[![PHP Version](https://img.shields.io/badge/PHP-7.4%20%7C%208.0%20%7C%208.1%20%7C%208.2-blue.svg)](https://www.php.net/)
[![Docker](https://img.shields.io/badge/Docker-Supported-blue.svg?logo=docker)](https://www.docker.com/)
[![License](https://img.shields.io/badge/License-GPLv2-green.svg)](LICENSE)

---

## 📌 Por que este repositório?

Trabalhar com bases de dados grandes no **phpMyAdmin** muitas vezes resulta em erros como:
- ❌ `You probably tried to upload a file that is too large.`
- ❌ Perda do flag `AUTO_INCREMENT` ao migrar tabelas.
- ❌ Necessidade de digitar usuário e senha a cada acesso local.
- ❌ Dificuldade de conectar a portas alternativas do MySQL (como `3307`, `3308`, etc.).

Este projeto resolve todos esses problemas out-of-the-box!

---

## ✨ Funcionalidades

- 🔑 **Autenticação Automática via `.env`**: Entre direto no painel com 1 clique.
- 🐘 **Suporte a Portas Customizadas**: Conecte facilmente no MySQL na porta `3307`, `3306` ou qualquer outra.
- 📦 **Grandes Uploads Desbloqueados**: Suporte para importação de dumps SQL pesados (até 2GB por padrão).
- 🇧🇷 **Idioma Padrão em Português (pt_BR)**: Totalmente traduzido ao abrir.
- 🛠️ **Execução Híbrida**: Alterne facilmente entre o servidor PHP nativo (`./start_dev.sh`) e Docker Compose (`docker compose up -d`).

---

## 🚀 Como Usar

### 1. Clonar o Repositório

```bash
git clone https://github.com/seu-usuario/phpmyadmin-local.git
cd phpmyadmin-local
```

### 2. Configurar o `.env`

Copie o arquivo de exemplo `.env.example` para `.env`:

```bash
cp .env.example .env
```

Edite as credenciais da sua base de dados no `.env`:

```env
# Banco de Dados MySQL
DB_HOST=127.0.0.1
DB_PORT=3307
DB_USERNAME=root
DB_PASSWORD=password

# Servidor Web & Limites PHP
PMA_PORT=8080
PHP_UPLOAD_MAX_FILESIZE=2048M
PHP_POST_MAX_SIZE=2048M
PHP_MEMORY_LIMIT=2048M
PHP_MAX_EXECUTION_TIME=3600
```

---

## 💻 Modos de Execução

### Opção A: Servidor PHP Nativo (Recomendado para Dev Local)

Para rodar com o PHP da sua máquina sem precisar do Docker:

```bash
./start_dev.sh
```

Acesse no seu navegador: **`http://127.0.0.1:8080`**

---

### Opção B: Docker Compose

Se você prefere rodar em um container isolado:

```bash
# Iniciar o container
docker compose up -d

# Parar o container
docker compose down
```

Acesse no seu navegador: **`http://localhost:8080`**

> **Nota para macOS/Linux no Docker**: O arquivo `docker-compose.yml` usa `host.docker.internal` para conectar ao MySQL que está rodando na sua máquina host (ex: porta `3307`).

---

## 📂 Estrutura do Repositório

```text
├── .env.example         # Exemplo de configuração de banco e limites
├── .gitignore           # Proteção contra commit do arquivo .env real
├── docker-compose.yml   # Configuração para rodar via Docker Compose
├── start_dev.sh         # Script de execução rápida em ambiente local PHP
├── README.md            # Documentação do projeto
└── public/              # Instalação completa e isolada do phpMyAdmin
    ├── config.inc.php   # Leitura dinâmica das variáveis do .env
    └── index.php
```

---

## 🛠️ Solução de Problemas Comuns

<details>
<summary><b>1. Erro Duplicate entry '0' for key PRIMARY após importação?</b></summary>
<br>
Ao exportar do phpMyAdmin e importar no DBeaver/MySQL, o flag <code>AUTO_INCREMENT</code> pode se perder. Para corrigir na sua tabela, rode o comando SQL:
<pre><code>ALTER TABLE nome_da_tabela MODIFY COLUMN id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;</code></pre>
</details>

<details>
<summary><b>2. Como alterar a porta do servidor web?</b></summary>
<br>
Basta alterar o valor de <code>PMA_PORT</code> no seu arquivo <code>.env</code> (ex: <code>PMA_PORT=9090</code>) e reiniciar o script ou o container Docker.
</details>

---

## 🤝 Contribuição

Contribuições são super bem-vindas! Sinta-se à vontade para abrir uma *Issue* ou enviar um *Pull Request*.

1. Faça o Fork do projeto
2. Crie uma branch para sua Feature (`git checkout -b feature/MinhaFeature`)
3. Adicione suas mudanças (`git commit -m 'Adiciona nova feature'`)
4. Envie a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

---

## 📜 Licença

Este projeto é distribuído sob a licença **GPLv2**, assim como o próprio phpMyAdmin. Veja o arquivo `LICENSE` para mais detalhes.

---

<p align="center">Desenvolvido para facilitar a vida de devs PHP & Laravel 🚀</p>
