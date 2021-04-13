<?php 
    require_once('classes/Pessoa.php');
    $lista = [];
    $p = new Pessoa("crudpdo", "localhost", "root", "");
    $consulta = $p->buscarDados();
    if($consulta->rowCount() > 0){
        $lista = $consulta->fetchAll(PDO::FETCH_ASSOC); 
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>CRUD PDO</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>

    <body>
        
    <?php 
        if(isset($_POST['nome']))
        {
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);

            if(!empty($nome) && !empty($telefone) && !empty($email)){
                $p->cadastrarPessoa($nome, $telefone, $email);
            }
            else
            {
                echo "Preencha todos os campos.";
            }
        }
    ?>

    <?php 
        if(isset($_GET['id']))
        {
            $id = addslashes($_GET['id']);
            $p->excluirPessoa($id);
            header('Location: index.php');
        }

        if(isset($_GET['id_up']))
        {
            $id_update = addslashes($_GET['id_up']);
            $res = $p->apresentarDados($id_update);
        }

    ?>
    
        <section id="esquerda">
            
                <form  method="POST">
                    <h2>CADASTRAR PESSOA</h2>
                    <?php foreach($lista as $usuario) ?>
                    <label>Nome</label>
                    <input type="text" name="nome" id="nome" value="<?php if(isset($usuario)){ echo $usuario['nome']; } ?>">
                    <label>Telefone</label>
                    <input type="text" name="telefone" id="telefone">
                    <label>E-mail</label>
                    <input type="text" name="email" id="email">
                    <input type="submit" value="Cadastrar">
                </form>
            
        </section>


        <section id="direita">
           
            <table>
                <tr>
                    <th>NOME</th>
                    <th>TELEFONE</th>
                    <th>E-MAIL</th>
                    <th>AÇÔES</th>
                </tr>

                <?php foreach($lista as $usuario): ?>
                    <tr>
                        <td><?= $usuario['nome']; ?> </td>
                        <td><?= $usuario['telefone']; ?></td>
                        <td><?= $usuario['email']; ?></td>
                        <td>
                            <a href="index.php?id_up=<?= $usuario['id'] ?>">Editar</a>
                            <a href="index.php?id=<?= $usuario['id'];?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

    </body>
</html>