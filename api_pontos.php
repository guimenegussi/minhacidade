<?php


    //Conectando ao banco de dados
    include "conexao.php";
    $i = 0;
    $consulta = $conexao->query("SELECT * FROM reclamacoes;");

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        //echo "Nome: {$linha['nome']} - E-mail: {$linha['email']}<br />";
        $vetor[] = $linha;

     }

    //Passando vetor em forma de json
    echo json_encode($vetor);

?>
