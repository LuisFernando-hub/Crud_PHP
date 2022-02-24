<?php

namespace App\Db;

use \PDO;
use PDOException;

class Database{

    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do Banco de dados
     * @var string
     */
    const NAME = 'bd_teste';

    /**
     * Usuario do Banco de dados
     * @var string
     */
    const USER = 'root';

    /**
     * Senha do Banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var [type]
     */
    private $table;

    /**
     * Instancia de conexão com o banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instacia a conexão 
     * @param string $table
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }


    /**
     * Metodo responsavel por criar uma conexao com o banco de dados
     */
    private function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error:'. $e->getMessage());
        }
    }

    /**
     * Metodo responsavel por executar queries dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query,$params=[]){
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('Error:'. $e->getMessage());
        } 
    }

    /**
     * Metodo responsavel por inserir dados no banco
     * @param array $value [field => value]
     * @return integer
     */
    public function insert($values){
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');

        //MONTA A QUERY
         $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
       
         //Executa o insert
         $this->execute($query,array_values($values));

         //Retorna o id inserido
         return $this->connection->lastInsertId();
    }


        /**
     * Método responsavel por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOStatement
     */
    public function select($id = null){
        if(isset($id)){
           $query = 'SELECT
           L.id_prod AS id,
           L.nome AS nome,
           L.cor AS cor,
           P.preco AS preco
         FROM bd_teste.produtos AS L 
         INNER JOIN precos AS P ON P.id_preco = L.id_prod
         where  l.id_prod ='.$id.'
         GROUP BY nome,cor,preco';
         return $this->execute($query);
        }

        //MONTA A QUERY
        $query = 'SELECT
        L.id_prod AS id,
        L.nome AS nome,
        L.cor as cor,
        P.preco AS preco
        FROM bd_teste.produtos AS L 
        INNER JOIN precos AS P ON P.id_preco = L.id_prod
        GROUP BY nome,cor,preco';

        //EXECUTA
        return $this->execute($query);
    }

     /**
     * Método responsavel por executar a atualização no banco de dados
     * 
     * 
     * @param array $value [field => value]
     * @return [type]
     */
    public function update($value){
        $id = $value['id'];
        $nome = $value['nome'];
        $preco = $value['preco'];

        $query = 'UPDATE produtos as m
        INNER JOIN precos as tp 
          ON tp.id_preco = m.id_prod
          SET m.nome = "'.$nome.'", 
            tp.preco = '.$preco.'
        WHERE m.id_prod ='.$id;


        $this->execute($query);

        return true;
    }


     /**
     * Método responsavel por executar a exclusão no banco de dados
     * 
     * 
     * @param interger $id 
     * @return [type]
     */
    public function delete($id){

        $query = 'DELETE produtos, precos FROM produtos
        LEFT JOIN precos ON produtos.id_prod = precos.id_preco
        WHERE produtos.id_prod ='.$id;

        $this->execute($query);
        return true;
    }
}