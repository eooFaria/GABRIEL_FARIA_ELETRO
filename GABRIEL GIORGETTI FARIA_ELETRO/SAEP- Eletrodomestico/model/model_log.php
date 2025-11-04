<?php
    require_once "../config/db.php";

    class Log{
        public function cadastrar_log($descricao) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("INSERT INTO LOG (LOG_DESCRICAO, LOG_DATA_HORA) VALUES (?, NOW())");
            $insert->bind_param("s", $descricao);
            $success = $insert->execute();
            $insert->close();
            return $success;
        }
    }
?>