<?php
require_once "./../controller/controller_eletrodomestico.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Editar Eletrodoméstico</title>
    </head>
    <body>
        <h1>Editar Eletrodoméstico</h1>
        <form action="" method="POST">
            <label>Nome:</label>
            <br>
            <input type="text" id="nome" name="nome" value="<?php echo $eletrodomestico_editar['ELETRODOMESTICO_NOME']; ?>" required>

            <br><br>

            <label>Quantidade em Estoque:</label>
            <br>
            <input type="number" id="qtd_estoque" name="qtd_estoque" value="<?php echo $eletrodomestico_editar['ELETRODOMESTICO_QTD_ESTOQUE']; ?>" required>

            <br><br>

            <label>Fornecedor:</label>
            <br>
            <input type="text" id="fornecedor" name="fornecedor" value="<?php echo $eletrodomestico_editar['ELETRODOMESTICO_FORNECEDOR']; ?>" required>

            <br><br>

            <label>Categoria:</label>
            <br>
            <input type="text" id="categoria" name="categoria" value="<?php echo $eletrodomestico_editar['ELETRODOMESTICO_CATEGORIA']; ?>" required>

            <br><br>

            <label>Potência (W):</label>
            <br>
            <input type="number" step="0.01" id="potencia" name="potencia" value="<?php echo $eletrodomestico_editar['ELETRODOMESTICO_POTENCIA']; ?>" required>

            <br><br>

            <label>Consumo de Energia (kWh):</label>
            <br>
            <input type="number" step="0.01" id="cons_ener" name="cons_ener" value="<?php echo $eletrodomestico_editar['ELETRODOMESTICO_CONS_ENER']; ?>" required>

            <br><br>

            <label>Garantia:</label>
            <br>
            <input type="text" id="garantia" name="garantia" value="<?php echo $eletrodomestico_editar['ELETRODOMESTICO_GARANTIA']; ?>" required>

            <br><br>

            <label>Prioridade de Reposição:</label>
            <br>
            <input type="text" id="prior_rep" name="prior_rep" value="<?php echo $eletrodomestico_editar['ELETRODOMESTICO_PRIOR_REP']; ?>" required>

            <br><br>

            <input type="submit" id="editar_eletrodomestico" name="editar_eletrodomestico" value="Salvar Alterações">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
