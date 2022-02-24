<?php

require __DIR__ . '/vendor/autoload.php';

define('TITLE','Cadastrar produto');

use \App\Entity\Produto;

$objProduto = [['cor' => 'vermelho','azul','amarelo']];

if(isset($_POST['nome_prod'], $_POST['cor_prod'],$_POST['preco_cod'])){
    $objProduto = new Produto;
    $objProduto->nome = $_POST['nome_prod'];
    $objProduto->preco = $_POST['preco_cod'];
    $objProduto->cor = $_POST['cor_prod'];
    $objProduto->cadastrar();
    header('location: index.php?status=success');
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';