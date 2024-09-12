<?php

class Product {
  private int $id;
  private string $name;
  private float $price;
  private int $quantity;

  public function setId(int $id){
    $this->id = $id;
  }

  public function getId(){
    return $this->id;
  }

  public function setName(string $name){
    $this->name = $name; 
  }

  public function getName(){
    return $this->name;
  }

  public function setPrice(float $price){
    $this->price = $price;
  }

  public function getPrice(){
    return $this->price;
  }

  public function setQuantity($quantity){
    $this->quantity = $quantity;
  }

  public function getQuantity(){
    return $this->quantity;
  }

}