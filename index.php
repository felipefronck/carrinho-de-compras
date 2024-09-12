<?php

require 'Product.php';
require 'Cart.php';

session_start();

$products = [
    1 => ['id' => 1, 'name' => 'Água', 'price' => 7.49, 'quantity' => 1],
    2 => ['id' => 2, 'name' => 'Suco', 'price' => 10.99, 'quantity' => 1],
    3 => ['id' => 3, 'name' => 'Energético', 'price' => 10.99, 'quantity' => 1],
    4 => ['id' => 4, 'name' => 'Refrigerante', 'price' => 9.99, 'quantity' => 1],
];


if(isset($_GET['id'])){
    $id = strip_tags($_GET['id']);
    
    $productInfo = $products[$id];

    $product = new Product;
    $product->setId($productInfo['id']);
    $product->setName($productInfo['name']);
    $product->setPrice($productInfo['price']);
    $product->setQuantity($productInfo['quantity']);

    $cart = new Cart;
    $cart->add($product);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Desafio 1 - Carrinho de Compras</title>

    <link rel="stylesheet" href="style-loja.css">
</head>

<body>
    <div class="topo">
        <h1 class="titulo-loja">Desafio 1 - Carrinho de Compras</h1>
        <a class="botao-carrinho" href="/mycart.php">Ir para o Carrinho</a>
    </div>
    <div class="listas-itens">
        <div class="lista-nomes">
            <ul>
                <li class="nome-item">Água</li>
                <li class="nome-item">Suco</li>
                <li class="nome-item">Energético</li>
                <li class="nome-item">Refrigerante</li>
            </ul>
        </div>
        <div class="lista-precos">
            <ul>
                <li class="preco-item">R$ 7,49</li>
                <li class="preco-item">R$ 10,99</li>
                <li class="preco-item">R$ 10,99</li>
                <li class="preco-item">R$ 9,99</li>
            </ul>
        </div>
        <div class="lista-add-itens">
            <ul>
                <li class="botao-add"><a href="?id=1">Adicionar Ao Carrinho</a></li>
                <li class="botao-add"><a href="?id=2">Adicionar Ao Carrinho</a></li>
                <li class="botao-add"><a href="?id=3">Adicionar Ao Carrinho</a></li>
                <li class="botao-add"><a href="?id=4">Adicionar Ao Carrinho</a></li>
            </ul>
        </div>
    </div>
</body>

</html>