<?php
    require_once('classes/Pessoa.php');
    $cadastrar;

    $nome = filter_input(INPUT_POST, 'nome');
    $telefone = filter_input(INPUT_POST, 'telefone');
    $email = filter_input(INPUT_POST, 'email');

    if(!empty($nome) && !empty($telefone) && !empty($email))
    {
        $cadastrar->cadastrarPessoa($nome, $telefone, $email);
    }
    else
    {
        echo "Digite todos os dados";
    }

?>