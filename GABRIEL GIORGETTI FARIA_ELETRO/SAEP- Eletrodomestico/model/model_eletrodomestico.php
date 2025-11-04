<?php
    require_once "../config/db.php";
    require_once "model_estoque.php";
    require_once "model_log.php";

    class Eletrodomestico {
        public function cadastrar_eletrodomestico($nome, $qtd_estoque, $fornecedor, $categoria, $potencia, $cons_ener, $garantia, $prior_rep, $fk_usu_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("INSERT INTO ELETRODOMESTICO (ELETRODOMESTICO_NOME, ELETRODOMESTICO_QTD_ESTOQUE, ELETRODOMESTICO_FORNECEDOR, ELETRODOMESTICO_CATEGORIA, ELETRODOMESTICO_POTENCIA, ELETRODOMESTICO_CONS_ENER, ELETRODOMESTICO_GARANTIA, ELETRODOMESTICO_PRIOR_REP, FK_USU_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("sissddssi", $nome, $qtd_estoque, $fornecedor, $categoria, $potencia, $cons_ener, $garantia, $prior_rep, $fk_usu_id);
            $success = $insert->execute();

            if ($success) {
                $eletrodomestico_id = $conn->insert_id;

                $estoque = new Estoque();
                $estoque->adicionar_estoque($qtd_estoque, $fk_usu_id, $eletrodomestico_id);

                $log = new Log();
                $log->cadastrar_log("ELETRODOMÉSTICO <br> ID: " . $eletrodomestico_id . " <br> NOME: " . $nome . " <br> AÇÃO: Cadastrado! <br> ID USUÁRIO: " . $fk_usu_id);
            }

            $insert->close();
            return $success;
        }

        public function listar_eletrodomesticos() {
            $conn = Database::getConnection();
            $sql = "SELECT      E.ELETRODOMESTICO_ID,
                                E.ELETRODOMESTICO_NOME,
                                E.ELETRODOMESTICO_QTD_ESTOQUE,
                                E.ELETRODOMESTICO_FORNECEDOR,
                                E.ELETRODOMESTICO_CATEGORIA,
                                E.ELETRODOMESTICO_POTENCIA,
                                E.ELETRODOMESTICO_CONS_ENER,
                                E.ELETRODOMESTICO_GARANTIA,
                                E.ELETRODOMESTICO_PRIOR_REP,
                                U.USU_NOME,
                                U.USU_EMAIL
                    FROM        ELETRODOMESTICO E
                    JOIN        USUARIO U ON E.FK_USU_ID = U.USU_ID
                    ORDER BY    E.ELETRODOMESTICO_NOME";
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function excluir_eletrodomestico($eletrodomestico_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $delete = $conn->prepare("DELETE FROM ELETRODOMESTICO WHERE ELETRODOMESTICO_ID = ?");
            $delete->bind_param("i", $eletrodomestico_id);

            $log = new Log();
            $log->cadastrar_log("ELETRODOMESTICO <br> ID: " . $eletrodomestico_id . " <br> AÇÃO: Excluído! <br> ID USUÁRIO: " . $fk_usu_id);
            
            $success = $delete->execute();
            $delete->close();
            return $success;
        }

        public function buscar_eletrodomestico_pelo_id($id) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT    E.ELETRODOMESTICO_ID,
                                                E.ELETRODOMESTICO_NOME,
                                                E.ELETRODOMESTICO_QTD_ESTOQUE,
                                                E.ELETRODOMESTICO_FORNECEDOR,
                                                E.ELETRODOMESTICO_CATEGORIA,
                                                E.ELETRODOMESTICO_POTENCIA,
                                                E.ELETRODOMESTICO_CONS_ENER,
                                                E.ELETRODOMESTICO_GARANTIA,
                                                E.ELETRODOMESTICO_PRIOR_REP,
                                                U.USU_NOME,
                                                U.USU_EMAIL
                                      FROM      ELETRODOMESTICO E
                                      JOIN      USUARIO U ON E.FK_USU_ID = U.USU_ID
                                      WHERE     E.ELETRODOMESTICO_ID = ?
                                      ORDER BY  E.ELETRODOMESTICO_NOME");
            $select->bind_param("i", $id);
            $select->execute();
            $result = $select->get_result();
            $eletrodomestico = $result->fetch_all(MYSQLI_ASSOC);
            $select->close();
            return $eletrodomestico;
        }

        public function editar_eletrodomestico($nome, $qtd_estoque, $fornecedor, $categoria, $potencia, $cons_ener, $garantia, $prior_rep, $eletrodomestico_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $update = $conn->prepare("UPDATE ELETRODOMESTICO SET ELETRODOMESTICO_NOME = ?, ELETRODOMESTICO_QTD_ESTOQUE = ?, ELETRODOMESTICO_FORNECEDOR = ?, ELETRODOMESTICO_CATEGORIA = ?, ELETRODOMESTICO_POTENCIA = ?, ELETRODOMESTICO_CONS_ENER = ?, ELETRODOMESTICO_GARANTIA = ?, ELETRODOMESTICO_PRIOR_REP = ? WHERE ELETRODOMESTICO_ID = ?");
            $update->bind_param("sissddssi", $nome, $qtd_estoque, $fornecedor, $categoria, $potencia, $cons_ener, $garantia, $prior_rep, $eletrodomestico_id);
            $success = $update->execute();

            if ($success) {
                $log = new Log();
                $log->cadastrar_log("ELETRODOMÉSTICO <br> ID: " . $eletrodomestico_id . " <br> NOME: " . $nome . " <br> AÇÃO: Editado! <br> ID USUÁRIO: " . $fk_usu_id);
            }

            $update->close();
            return $success;
        }

        public function filtrar_eletrodomestico($campo) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT    E.ELETRODOMESTICO_ID,
                                                E.ELETRODOMESTICO_NOME,
                                                E.ELETRODOMESTICO_QTD_ESTOQUE,
                                                E.ELETRODOMESTICO_FORNECEDOR,
                                                E.ELETRODOMESTICO_CATEGORIA,
                                                E.ELETRODOMESTICO_POTENCIA,
                                                E.ELETRODOMESTICO_CONS_ENER,
                                                E.ELETRODOMESTICO_GARANTIA,
                                                E.ELETRODOMESTICO_PRIOR_REP,
                                                U.USU_NOME,
                                                U.USU_EMAIL
                                      FROM      ELETRODOMESTICO E
                                      JOIN      USUARIO U ON E.FK_USU_ID = U.USU_ID
                                      WHERE     E.ELETRODOMESTICO_NOME LIKE ?
                                      ORDER BY  E.ELETRODOMESTICO_NOME");
            $termo = "%" . $campo . "%";
            $select->bind_param("s", $termo);
            $select->execute();
            $result = $select->get_result();
            $eletrodomesticos = $result->fetch_all(MYSQLI_ASSOC);
            $select->close();
            return $eletrodomesticos;
        }
    }
?>
