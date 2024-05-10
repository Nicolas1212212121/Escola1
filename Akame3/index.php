<?php 
include_once"conecxao.php";
include_once"funcoes.php";

if(isset($_GET['acao'])&&$_GET['acao']=='deletar'){
    $id = $_GET['id'];

    $conecxaoBanco=abrirBanco();

    $sql ="DELETE FROM pessoa WHERE id=$id";

    
    if($conecxaoBanco->query($sql)===TRUE){
        echo"Conta excluida com sucesso";
    }else{
        echo"Erro ao excluir contato: ".$conecxaoBanco-error;
    }

    fecharBanco($conecxaoBanco);

}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<header>
    <h1>Agenda de Contatos</h1>
    <br>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="cadastrar.php">Cadastrar</a></li>
    </ul>
</nav>
</header>
<section>
    <h2>Lista de contatos</h2>
    <br>
    <table>
        <thead>
            <TR>
                <td>ID</td>
                <td>Nome</td>
                <td>Sobrenome</td>
                <td>Nascimento</td>
                <td>Endereço</td>
                <td>Telefone</td>
                <td>Ações</td>
                
            </TR>
        </thead>
        <tbody>
        <?php 
        $conecxaoBanco=abrirBanco();

        $sql="SELECT*FROM pessoa";

        $result = $conecxaoBanco->query($sql);
        
        if($result->num_rows>0){
            while($registro=$result->fetch_assoc()){
                ?>
<tr>
                <td><?=$registro['id']?></td>
                <td><?=$registro['nome']?></td>
                <td><?=$registro['sobrenome']?></td>
                <td><?=$registro['nascimento']?></td>
                <td><?=$registro['endereco']?></td>
                <td><?=$registro['telefone']?></td>
                <td>
                    <a href="editar.php?id=<?=$registro['id']?>"><button >Editar</button></a>
                    <a href="?acao=deletar&id=<?=$registro['id']?>" onclick="return confirm('Tem certeza que deseja excluir os dados')"><button>Excluir</button></a>
                    
                </td>
                </tr>
                <?php
            }
        }else{
            echo ("<tr><td colspan='6'>Nenhum resistro encontrado</td></tr>") ;
        }

        ?>
            <tr>
                

            </tr>
        </tbody>
    </table>
</section>
</html>