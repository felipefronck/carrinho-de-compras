<?php

require 'Product.php';
require 'Cart.php';
require 'Api.php';
require 'Cupom.php';
require 'CupomDescontoFixo.php';
require 'CupomDescontoPercentual.php';

session_start();

$cart = new Cart;
$productsInCart = $cart->getCart();
$cupomAplicado = null;
$valorTotal = $cart->getTotal();

// echo '<pre>', var_dump($productsInCart), '</pre>';

$cuponsDisponiveis = [
    'DESCONTO10' => new CupomDescontoFixo('DESCONTO10', 10),
    'PROMO10%' => new CupomDescontoPercentual('PROMO10%', 10),
];

if(isset($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $cart->remove($id);
}

if (isset($_POST['cupom'])) {
    $codigo = strip_tags($_POST['cupom']);

    if (isset($cuponsDisponiveis[$codigo])) {
        $cupomAplicado = $cuponsDisponiveis[$codigo];
        $valorTotal = $cupomAplicado->aplicaDesconto($cart->getTotal());
    } else {
        echo "Cupom inválido!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>

    <link rel="stylesheet" href="style-carrinho.css">
</head>

<body>
    <div class="topo-carrinho">
        <h1 class="titulo-carrinho">Carrinho de Compras</h1>
        <a class="botao-retorno-loja" href="/index.php">Retorne à loja</a>
    </div>

    <?php if(count($productsInCart) <= 0): ?> 
        <p class="carrinho-vazio">Carrinho vazio!</p>
    <?php endif; ?>

    <?php foreach($productsInCart as $product): ?>
    <ul class="itens-no-carrinho">
        <li class="item-no-carrinho"><?php echo $product->getName()?></li>
        <li class="item-no-carrinho"><input type = "text" value = "<?php echo $product->getQuantity() ?>"></li>
        <li class="item-no-carrinho">Preço: R$ <?php echo number_format($product->getPrice() * $product->getQuantity(), 2, ',','.') ?></li>
        <li class="item-no-carrinho">Price: US$ <?php echo number_format/*(*/($product->getPrice() /*/ Api::returnApi()*/)  * $product->getQuantity(), 2, ',','.'/*)*/; ?></li>
        <li class="item-no-carrinho"><a href="?id=<?php echo $product->getId(); ?>">Remover Item</a></li>
    </ul> 
    <?php endforeach; ?>
    
    <div class="rodape-total-desconto">      
        <form class="form-cupom" method="POST">
            <label for="cupom">Insira o cupom de desconto:</label>
            <input type="text" name="cupom" id="cupom">
            <button type="submit">Aplicar Cupom</button>
        </form>
        
        <p class="total-carrinho">Total do Carrinho: US$ <?php echo number_format($cart->getTotal() /*/ Api::returnApi()*/, 2, ',','.'); ?> </p><br>
        
        <?php if ($cupomAplicado): ?>
            <div class="mensagem-pos-desconto">
                <p>Desconto aplicado com o cupom: <?php echo $cupomAplicado->getCodigo(); ?></p>
                <p>Total com desconto: US$ <?php echo number_format($valorTotal /*/ Api::returnApi()*/, 2, ',', '.'); ?></p>
            </div>
            <?php endif; ?>
    </div>

</body>
</html>