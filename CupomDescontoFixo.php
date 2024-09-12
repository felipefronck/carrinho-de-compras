<?php

class CupomDescontoFixo extends Cupom {
    private float $desconto;

    public function __construct(string $codigo, float $desconto) {
        parent::__construct($codigo);
        $this->desconto = $desconto;
    }

    public function aplicaDesconto(float $valorTotal) {
        return max(0, $valorTotal - $this->desconto);
    }
}