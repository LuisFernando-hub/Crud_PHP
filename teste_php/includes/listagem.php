<?php

    $resultados = '';
    foreach ($produtos as $produto) {
        $resultados .='<tr>
                        <td>'.$produto['id'].'</td>
                        <td>'.$produto['nome'].'</td>
                        <td>'.$produto['preco'].'</td>
                        <td>'.$produto['cor'].'</td>
                        <td>
                          <a href="editar.php?id='.$produto['id'].'"><button type="button" class="btn btn-primary">Editar</button></a>
                          <a href="excluir.php?id='.$produto['id'].'"><button type="button" class="btn btn-danger">Excluir</button></a>
                        </td>
        </tr>';
    }
?>

<main>
<section>
    <a href="cadastrar.php"><button class="btn btn-success">Nova vaga</button></a>
</section>

<section>
    <table class="table bg-light mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Cor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?=$resultados; ?>
        </tbody>
    </table>
</section>

</main>