<?php

require __DIR__ . '/vendor/autoload.php';

define('TITLE','Editar produto');

use \App\Entity\Produto;

$objProduto = Produto::getProdutoById($_GET['id']);

if(!isset($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

if(isset($_POST['nome_prod'],$_POST['preco_cod'])){
    // echo "<pre>";var_dump($_POST['cor_prod']);echo "</pre>";
    $objProduto = new Produto;
    $objProduto->id = $_GET['id'];
    $objProduto->nome = $_POST['nome_prod'];
    $objProduto->preco =$_POST['preco_cod'];
    $objProduto->atualizar();
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';