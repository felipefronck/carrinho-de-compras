<?php

class CupomDescontoPercentual extends Cupom {
    private float $percentual;

    public function __construct(string $codigo, float $percentual) {
        parent::__construct($codigo);
        $this->percentual = $percentual;
    }

    public function aplicaDesconto(float $valorTotal) {
        return max(0, $valorTotal - ($valorTotal * ($this->percentual / 100)));
    }
}