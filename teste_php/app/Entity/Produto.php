<?php

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Produto
{

    /**
     * Indentificador de único do produto
     * @var interger
     */

    public $id;

    /**
     * Nome do Produto
     * @var string
     */
    public $nome;

    /**
     * Preço do produto
     * @var decimal
     */

    public $preco;

    /**
     * Cor do Produto
     * @var string
     */
    public $cor;

    /**
     * Cadastrar produto
     * @return boolean
     */
    public function cadastrar(){
        //DEFINIR OS DESCONTOS
        
        // $this->preco = str_replace(",",".",$this->preco);

        //INSERIR O PRODUTO NO BANCO
        $DB = new Database('produtos');
        $this->id = $DB->insert([
            'nome' => $this->nome,
            'cor' => $this->cor
        ]);

        $DB = new Database('precos');
        $DB->insert([
            'id_preco' => $this->id,
            'preco' => $this->preco,
        ]);
       
        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsavel por atualizar os produtos no banco
     * @return [type]
     */
    public function atualizar(){
        $DB = new Database('produtos');
        $DB->update([
            'id' => $this->id,
            'nome' => $this->nome,
            'preco' => $this->preco
        ]);
        return true;
    }


    /**
     * Método responsavel por excluir os produtos no banco
     * @return [type]
     */
    public static function excluir($id){
        $DB = new Database('produtos');
        $DB->delete($id);
        return true;
    }

    /**
     * Método responsavel por obter os produtos do bando de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getProduto(){
        $result = (new Database('produtos'))->select();
        $result = $result->fetchAll();
        return $result;
    }


    /**
     * Editar Produtos
     * @param interger $id
     * @
     */
    public static function getProdutoById($id){
        $result = (new Database('produtos'))->select($id);
        $result = $result->fetchAll();
        return $result;
    }


}
