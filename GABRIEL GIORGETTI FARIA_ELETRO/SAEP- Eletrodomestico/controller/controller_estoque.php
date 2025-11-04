<?php
require_once "../model/model_estoque.php";
session_start();

if (isset($_POST['botao_atualizar'])) {

    // Verifica se a ação é de entrada ou saída e calcula a nova quantidade
    if ($_POST['acao_estoque'] == "entrada") {
        $nova_qtd = $_POST['estoque_qtd'] + $_POST['qtd_aumentar_diminuir'];
    }

    if ($_POST['acao_estoque'] == "saida") {
        $nova_qtd = $_POST['estoque_qtd'] - $_POST['qtd_aumentar_diminuir'];

        // Impede que o estoque fique negativo
        if ($nova_qtd < 0) {
            $nova_qtd = 0;
        }

        // Alerta caso o estoque esteja baixo
        if ($nova_qtd <= 5) {
            echo "<script>
                alert('Estoque de eletrodoméstico está baixo!');
            </script>";
        }
    }

    // Atualiza o estoque no banco de dados
    $estoque = new Estoque();
    $success = $estoque->atualizar_estoque($nova_qtd, $_POST["eletrodomestico_id"], $_SESSION['usuario']['USU_ID']);

    if ($success) {
        echo "<script>
                alert('Estoque atualizado com sucesso!');
                window.location.href = './../view/gestao_estoque.php';
              </script>";
    } else {
        echo "<script>
                alert('Falha ao atualizar o estoque!');
                window.location.href = './../view/gestao_estoque.php';
              </script>";
    }
}
?>
