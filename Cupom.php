<?php

abstract class Cupom {
    protected string $codigo;

    public function __construct(string $codigo){
        $this->codigo = $codigo;
    }

    abstract public function aplicaDesconto(float $valorTotal);

    public function getCodigo(){
        return $this->codigo;
    }
}