<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Cadastro de Eletrodomésticos</title>
    </head>
    <body>
        <h1>Cadastro de Eletrodomésticos</h1>
        <form action="./../controller/controller_eletrodomestico.php" method="POST">
            
            <label>Nome:</label>
            <br>
            <input type="text" id="nome" name="nome" placeholder="Nome do eletrodoméstico..." required>

            <br><br>

            <label>Quantidade em Estoque:</label>
            <br>
            <input type="number" id="qtd_estoque" name="qtd_estoque" placeholder="Quantidade em estoque..." required>

            <br><br>

            <label>Fornecedor:</label>
            <br>
            <input type="text" id="fornecedor" name="fornecedor" placeholder="Fornecedor..." required>

            <br><br>

            <label>Categoria:</label>
            <br>
            <input type="text" id="categoria" name="categoria" placeholder="Categoria (ex: Geladeira, Fogão...)" required>

            <br><br>

            <label>Potência (W):</label>
            <br>
            <input type="number" step="0.01" id="potencia" name="potencia" placeholder="Ex: 1200" required>

            <br><br>

            <label>Consumo de Energia (kWh):</label>
            <br>
            <input type="number" step="0.01" id="cons_ener" name="cons_ener" placeholder="Ex: 0.85" required>

            <br><br>

            <label>Garantia:</label>
            <br>
            <input type="text" id="garantia" name="garantia" placeholder="Ex: 12 meses" required>

            <br><br>

            <label>Prioridade de Reposição:</label>
            <br>
            <input type="text" id="prior_rep" name="prior_rep" placeholder="Alta, Média ou Baixa..." required>

            <br><br>

            <input type="submit" id="cadastrar_eletrodomestico" name="cadastrar_eletrodomestico" value="Cadastrar">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
