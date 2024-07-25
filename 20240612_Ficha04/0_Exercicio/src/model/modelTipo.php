<?php

    require_once 'connection.php';

class TipoProduto{
    
    function addTipo($novoTipo){
        global $conn;

        $msg = "";

        $sql = "INSERT INTO tipos (descTipo) VALUES ('".$novoTipo."');";

        if ($conn->query($sql) === TRUE) {
        $msg = "Adicionado com sucesso!";
        } else {
        $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        return $msg;

    } 

    function getSelect(){
        global $conn;

        $msg = '<option value="0">Escolha um tipo</option>';

        $sql = "SELECT * FROM tipos;";
        $result = $conn->query($sql);   
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['id']."'>".$row['descTipo']."</option>";
            }
        }
        $conn->close();

        return $msg;
    }
    
}

?>