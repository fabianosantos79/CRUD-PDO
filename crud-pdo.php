<?php

//------------------ CONEXÂO CONEXÂO CONEXÂO CONEXÂO CONEXÂO ------------------

    try 
    {
        $pdo = new PDO("mysql:dbname=crudpdo;host=localhost","root","");
        //dbname; host, usuario, senha
    } 
    catch (PDOException $erro) 
    {
        echo "Erro de conexão ao banco de dados: ".$erro->getMessage();
    }
    catch(Exception $erro)
    {
        echo "Erro genérico: ".$erro->getMessage();
    }


//------------------ INSERT INSERT INSERT INSERT INSERT  ---------------------

    //$sql = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES(:n, :t, :e)");
    //$sql->bindValue(':n', 'Viviane');
    //$sql->bindValue(':t', '8888888');
    //$sql->bindValue(':e', 'viviane@email.com');
    //$sql->execute();

    //$pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES('Fernando','7777777','fernando@email.com')");
    

//------------------ DELETE DELETE DELETE DELETE DELETE --------------------
    
    //$sql = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
    //$id = 2; 
    //$sql->bindValue(':id', $id);
    //$sql->execute();

    //$pdo->query("DELETE FROM pessoa WHERE id = '5'");


//------------------ UPDATE UPDATE UPDATE UPDATE UPDATE ---------------------

    //$sql = $pdo->prepare("UPDATE pessoa SET nome = :n WHERE id = :id");
    //$id = 1;
    //$sql->bindValue(':n', 'Fabiano S Santos');
    //$sql->bindValue(':id',$id);
    //$sql->execute();

    //$pdo->query("UPDATE pessoa SET nome = 'Viviane S A Santos' WHERE id = '3'");


//------------------ SELECT SELECT SELECT SELECT SELECT ---------------------

    $sql = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
    $id = 1;
    $sql->bindValue(':id', $id);
    $sql->execute();

    $res = $sql->fetch(PDO::FETCH_ASSOC);

    //echo "<pre>";
    //print_r($res);
    //echo "</pre>";

    foreach($res as $chave => $valor){
        echo $chave." : ".$valor."<br />";
    }


?>