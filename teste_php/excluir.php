<?php

require __DIR__ . '/vendor/autoload.php';

define('TITLE','Excluir');

use \App\Entity\Produto;

$objProduto = Produto::excluir($_GET['id']);

if(!isset($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

if(isset($_POST['nome_prod'],$_POST['preco_cod'],$_POST['cor_prod'])){
    // echo "<pre>";var_dump($_POST['cor_prod']);echo "</pre>";
    $objProduto = new Produto;
    $objProduto->id = $_GET['id'];

    $objProduto->excluir($objProduto->id);
}

header('location: index.php?status=success');
