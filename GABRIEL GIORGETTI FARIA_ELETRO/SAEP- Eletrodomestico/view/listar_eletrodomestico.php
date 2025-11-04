<?php
require_once "./../controller/controller_eletrodomestico.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$eletrodomestico = new Eletrodomestico();
if (isset($_POST['botao_pesquisar'])) {
    $resultados = $eletrodomestico->filtrar_eletrodomestico($_POST['pesquisar']);
} else {
    $resultados = $eletrodomestico->listar_eletrodomesticos();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Lista de Eletrodomésticos</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            tr, td, th {
                padding: 12px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            h1 {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <h1>Lista de Eletrodomésticos</h1>
        <form method="POST">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>
        
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade em Estoque</th>
                <th>Fornecedor</th>
                <th>Categoria</th>
                <th>Potência (W)</th>
                <th>Consumo (kWh)</th>
                <th>Garantia</th>
                <th>Prioridade de Reposição</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            <?php
                if (count($resultados) > 0) {
                    foreach ($resultados as $r) {
                        echo "<tr>";  
                        echo "<td>".$r["ELETRODOMESTICO_ID"]."</td>";
                        echo "<td>".$r["ELETRODOMESTICO_NOME"]."</td>";
                        echo "<td>".$r["ELETRODOMESTICO_QTD_ESTOQUE"]."</td>";
                        echo "<td>".$r["ELETRODOMESTICO_FORNECEDOR"]."</td>";
                        echo "<td>".$r["ELETRODOMESTICO_CATEGORIA"]."</td>";
                        echo "<td>".$r["ELETRODOMESTICO_POTENCIA"]."</td>";
                        echo "<td>".$r["ELETRODOMESTICO_CONS_ENER"]."</td>";
                        echo "<td>".$r["ELETRODOMESTICO_GARANTIA"]."</td>";
                        echo "<td>".$r["ELETRODOMESTICO_PRIOR_REP"]."</td>";
                        echo "<td><a href='editar_eletrodomestico.php?acao=editar_eletrodomestico&id=".$r["ELETRODOMESTICO_ID"]."'>Editar</a></td>";
                        echo "<td><a href='./../controller/controller_eletrodomestico.php?acao=excluir_eletrodomestico&id=".$r["ELETRODOMESTICO_ID"]."'>Excluir</a></td>";
                        echo "</tr>";                            
                    }
                } else {
                    echo "<tr>";  
                    echo "<th colspan='11'>Nenhum eletrodoméstico cadastrado!</th>";
                    echo "</tr>";       
                }
            ?>
        </table>
        <br>
        <a href="cadastrar_eletrodomestico.php"><button>Cadastrar Eletrodoméstico</button></a>
        <br><br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
