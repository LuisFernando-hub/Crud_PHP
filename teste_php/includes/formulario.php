<main>
    <section>
        <a href="index.php"><button class="btn btn-success">Voltar</button></a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome_prod"  value="<?=(TITLE == 'Editar produto')?$objProduto[0]['nome']:''?>">
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" class="form-control" name="preco_cod" id="preco_cod" value="<?=(TITLE == 'Editar produto')?$objProduto[0]['preco']:''?>">
        </div>

        <div class="form-group">
            <label>Cor</label>
            <select class="form-select" name="cor_prod" id="cor_prod" <?=(TITLE == 'Editar produto')?'disabled': ''?> value="<?=(TITLE == 'Editar produto')?$objProduto[0]['cor']:''?>">
                <option value="vermelho" <?=($objProduto[0]['cor'] == 'vermelho' and TITLE == 'Editar produto')?'selected':''?> >Vermelho (20% de Desconto)</option>
                <option value="azul" <?=($objProduto[0]['cor'] == 'azul' and TITLE == 'Editar produto')?'selected':''?> >Azul (20% de Desconto)</option>
                <option value="amarelo" <?=($objProduto[0]['cor'] == 'amarelo' and TITLE == 'Editar produto')?'selected':''?>>Amarelo (10% de Desconto)</option>
            </select>
        </div>

        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
</main>

