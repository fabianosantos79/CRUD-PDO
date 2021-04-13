<?php
    class Pessoa{

        private $pdo;

        //CONEXÂO COM BANCO DE DADOS
        public function __construct($dbname, $host, $usuario, $senha)
        {
           try
           {
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $usuario, $senha);
            } 
            catch (PDOException $erro) 
            {
                echo "Erro no banco de dados = ".$erro->getMessage();
                exit();
            }
            catch(Exception $erro)
            {
                echo "Erro genérico = ".$erro->getMessage();
                exit();
            }

        }


        //FUNÇÂO PARA BUSCAR OS DADOS E COLOCAR NA TABELA
        public function buscarDados()
            {
                $res = array();  //para não dar erro caso não tenha nada cadastrado no BD
                $sql = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
                return $sql;

                header('Location: index.php');
            }


            //FUNÇÂO PARA CADASTRAR NOVAS PESSOAS NO BANCO DE DADOS
            public function cadastrarPessoa($nome, $telefone, $email)
            {
                $sql = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
                $sql->bindValue(':e', $email);
                $sql->execute();

                if($sql->rowCount() > 0)
                {
                    echo "E-mail já está cadastrado";
                }else
                {
                    $sql = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:n, :t, :e)");
                    $sql->bindValue(':n', $nome);
                    $sql->bindValue(':t', $telefone);
                    $sql->bindValue(':e', $email);
                    $sql->execute();

                    header('Location: index.php');
                }
            }

            //FUNÇÂO PARA EXCLUIR PESSOAS DO BANCO DE DADOS
            public function excluirPessoa($id)
            {
                $sql = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
                $sql->bindValue(':id', $id);
                $sql->execute();
            }


            //FUNÇÃO PARA BUSCAR OS DADOS
            public function apresentarDados($id)
            {   
                $lista= array();

                $sql = $this->pdo->prepare("SELECT * FROM pessoa WHERE id= :id");
                $sql->bindValue(':id', $id);
                $sql->execute();
                
                $lista = $sql->fetch(PDO::FETCH_ASSOC);
                return $lista;
            }




            
            //FUNÇÃO PARA ATUALIZAR OS DADOS
            public function atualizarDados()
            {

            }
    }

?>