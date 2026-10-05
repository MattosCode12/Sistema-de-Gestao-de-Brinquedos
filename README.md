# CRUD Brinquedos

Sistema de Gestão de Brinquedos desenvolvido em PHP e MySQL para a atividade de recuperação de CRUD.

## Sobre o projeto

O sistema permite realizar o gerenciamento de brinquedos de uma loja.

Cada brinquedo possui:

* Nome
* Categoria
* Faixa etária
* Preço
* Quantidade em estoque

## Funcionalidades

O sistema possui as quatro operações principais de um CRUD:

* **Create:** cadastrar brinquedos
* **Read:** listar brinquedos
* **Update:** editar brinquedos
* **Delete:** excluir brinquedos

Todas as operações que recebem dados do usuário utilizam **Prepared Statements** para evitar problemas de SQL Injection.

## Tecnologias utilizadas

* PHP
* MySQL
* HTML
* Bootstrap
* XAMPP
* phpMyAdmin

## Estrutura do projeto

```text
sistema-de-gestao-de-brinquedos/
│
├── conexao.php
├── index.php
├── banco.sql
├── README.md
│
└── brinquedos/
    ├── listar.php
    ├── cadastrar.php
    ├── editar.php
    └── excluir.php
```

## Como executar

### 1. Instalar o XAMPP

Instale o XAMPP e abra o painel de controle.

### 2. Iniciar o Apache e o MySQL

No XAMPP, clique em:

* Start em **Apache**
* Start em **MySQL**

### 3. Colocar o projeto no XAMPP

Copie a pasta `crud-brinquedos` para:

```text
C:\xampp\htdocs\
```

### 4. Criar o banco

Abra o phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Clique em **Importar** e selecione o arquivo:

```text
banco.sql
```

O banco `crud_brinquedos` e a tabela `brinquedos` serão criados.

### 5. Verificar a conexão

O arquivo `conexao.php` utiliza:

```text
Servidor: localhost
Usuário: root
Senha: vazia
Banco: crud_brinquedos
Porta: 3306
```

Caso o MySQL esteja utilizando outra porta, altere a variável `$porta` no arquivo `conexao.php`.

### 6. Abrir o sistema

No navegador, acesse:

```text
http://localhost/crud-brinquedos/
```

## Prepared Statements

O sistema utiliza Prepared Statements nas operações de cadastro, edição e exclusão.

Exemplo:

```php
$sql = "DELETE FROM brinquedos WHERE id = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();
```

Dessa forma, os valores recebidos pelo usuário não são inseridos diretamente no comando SQL.

## Objetivo

O projeto foi desenvolvido para demonstrar o funcionamento de um CRUD completo utilizando PHP, MySQL e Prepared Statements.
