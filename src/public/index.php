loja-roupa/
│
├── index.php
├── produtos.php
├── produto.php
├── carrinho.php
├── login.php
├── registo.php
├── checkout.php
├── logout.php
│
├── includes/
│   ├── config.php
│   └── functions.php
│
└── admin/
    ├── index.php
    ├── adicionar.php
    └── eliminar.php
<?php
session_start();

$pdo = new PDO('sqlite:' . __DIR__ . '/../loja.sqlite');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Criar tabela de utilizadores
$pdo->exec("
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT DEFAULT 'cliente'
)
");

// Criar tabela de produtos
$pdo->exec("
CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    descricao TEXT,
    preco REAL NOT NULL,
    imagem TEXT,
    stock INTEGER DEFAULT 0
)
");

// Criar tabela de encomendas
$pdo->exec("
CREATE TABLE IF NOT EXISTS orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    total REAL,
    morada TEXT,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
)
");
?>