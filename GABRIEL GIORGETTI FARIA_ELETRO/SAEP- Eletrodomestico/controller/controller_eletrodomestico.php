<?php
require_once "../model/model_eletrodomestico.php";
session_start();

// CADASTRAR ELETRODOMÉSTICO
if (isset($_POST["cadastrar_eletrodomestico"])) {
    $eletrodomestico = new Eletrodomestico();
    $resultado = $eletrodomestico->cadastrar_eletrodomestico(
        $_POST["nome"],
        $_POST["qtd_estoque"],
        $_POST["fornecedor"],
        $_POST["categoria"],
        $_POST["potencia"],
        $_POST["cons_ener"],
        $_POST["garantia"],
        $_POST["prior_rep"],
        $_SESSION['usuario']["USU_ID"]
    );

    if ($resultado) {
        echo "<script>
                alert('Eletrodoméstico cadastrado com sucesso!');
                window.location.href='../view/listar_eletrodomestico.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao cadastrar eletrodoméstico!');
                window.location.href='../view/listar_eletrodomestico.php';
              </script>";
    }
    exit();
}

// BUSCAR DADOS PARA EDITAR ELETRODOMÉSTICO
else if (isset($_GET["acao"]) && $_GET["acao"] == "editar_eletrodomestico") {
    $eletrodomestico = new Eletrodomestico();
    $resultados = $eletrodomestico->buscar_eletrodomestico_pelo_id($_GET["id"]);

    if (!empty($resultados)) {
        $eletrodomestico_editar = $resultados[0];
    } else {
        echo "<script>
                alert('Eletrodoméstico não encontrado!');
                window.location.href='listar_eletrodomestico.php';
              </script>";
        exit();
    }
}

// EDITAR ELETRODOMÉSTICO
if (isset($_POST["editar_eletrodomestico"])) {
    $eletrodomestico = new Eletrodomestico();
    $resultado = $eletrodomestico->editar_eletrodomestico(
        $_POST["nome"],
        $_POST["qtd_estoque"],
        $_POST["fornecedor"],
        $_POST["categoria"],
        $_POST["potencia"],
        $_POST["cons_ener"],
        $_POST["garantia"],
        $_POST["prior_rep"],
        $_GET["id"],
        $_SESSION['usuario']["USU_ID"]
    );

    if ($resultado) {
        echo "<script>
                alert('Eletrodoméstico atualizado com sucesso!');
                window.location.href='../view/listar_eletrodomestico.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao atualizar eletrodoméstico!');
                window.location.href='../view/listar_eletrodomestico.php';
              </script>";
    }
    exit();
}

// EXCLUIR ELETRODOMÉSTICO
else if (isset($_GET["acao"]) && $_GET["acao"] == "excluir_eletrodomestico") {
    $eletrodomestico = new Eletrodomestico();
    $resultado = $eletrodomestico->excluir_eletrodomestico($_GET["id"], $_SESSION['usuario']['USU_ID']);

    if ($resultado) {
        echo "<script>
                alert('Eletrodoméstico excluído com sucesso!');
                window.location.href='../view/listar_eletrodomestico.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao excluir eletrodoméstico!');
                window.location.href='../view/listar_eletrodomestico.php';
              </script>";
    }
    exit();
}
?>
