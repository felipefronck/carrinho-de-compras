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
    <title>Document</title>
</head>

<body>
    <h1>Carrinho de Compras</h1>
    <ul>
        <?php if(count($productsInCart) <= 0): ?> 
            Carrinho vazio!<br>
        <?php endif; ?>

        <br><a href="/index.php">Retorne à loja</a>

        <?php foreach($productsInCart as $product): ?>
        <li>
            <?php echo $product->getName()?>
            <input type = "text" value = "<?php echo $product->getQuantity() ?>">
            Preço: R$ <?php echo number_format($product->getPrice() * $product->getQuantity(), 2, ',','.') ?>
            Price: US$ <?php echo number_format(($product->getPrice() / Api::returnApi())  * $product->getQuantity(), 2, ',','.'); ?>
            <a href="?id=<?php echo $product->getId(); ?>">Remover Item</a>
        </li>
        <?php endforeach; ?>

        <li>Total do Carrinho: US$ <?php echo number_format($cart->getTotal() / Api::returnApi(), 2, ',','.'); ?> </li>
    
        <form method="POST">
            <label for="cupom">Insira o código do cupom:</label>
            <input type="text" name="cupom" id="cupom">
            <button type="submit">Aplicar Cupom</button>
        </form>
            
        <?php if ($cupomAplicado): ?>
            <li>Desconto aplicado com o cupom: <?php echo $cupomAplicado->getCodigo(); ?></li>
            <li>Total com desconto: US$ <?php echo number_format($valorTotal / APi::returnApi(), 2, ',', '.'); ?></li>
        <?php endif; ?>
    
    
    </ul> 

</body>

</html>