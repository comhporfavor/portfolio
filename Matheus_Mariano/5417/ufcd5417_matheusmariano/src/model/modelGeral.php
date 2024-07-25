<?php

require_once 'connection.php';

class Geral {
    function getSelect($tabela, $parametro) {
        global $conn;
        if ($tabela == 'clientes'){
            $argumento = 'nif';
        } else {
            $argumento = 'id';
        }
        $sql = "SELECT * FROM ".$tabela.""; 
        $result = $conn->query($sql);
        $select = "<option value=-1>Escolha uma opção</option>"; 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $select .= "<option value=".$row[$argumento].">".$row[''.$parametro.'']."</option>";
            }
        }
        $conn->close();
        return $select;
    }
}
?>
