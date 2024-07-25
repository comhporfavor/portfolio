<?php
    require_once 'connection.php';
    
    class Sessao{

        function filtrarSalas($idCinema){
            global $conn;
            $msg = "<option value='0'>Escolha uma Sala</option>";
            $sql = "SELECT * FROM salas, cinemas WHERE cineSala = idCinema AND idCinema = ".$idCinema.";";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg.= "<option value='".$row['idSala']."'>".$row['nomeCinema']."-".$row['descSala']."</option>";
                }
            }
            $conn->close();
            return $msg;
        }
        
        function addSessao($filmeSessao, $salaSessao, $dataSessao, $horaSessao, $estadoSessao){
            global $conn;
            $msg = "";
                $sql = "INSERT INTO sessoes (filmeSessao, salaSessao, dataSessao, horaSessao, estadoSessao)
                VALUES ('".$filmeSessao."', '".$salaSessao."', '".$dataSessao."', '".$horaSessao."', '".$estadoSessao."');";
            if($conn->query($sql) === TRUE) {
                $msg = "Registo efetuado com sucesso.";
            } else {
                $msg = "Error: ". $sql. "<br>". $conn->error;
            }
            $conn->close();
            return $msg;            
        }

        function getSessoes(){
            global $conn;
            $msg = "<option value='0'>Escolha uma Sessao</option>";
            $sql = "SELECT * FROM sessoes, salas, filmes WHERE salaSessao = idSala AND filmeSessao = idFilme;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg.= "<option value='".$row['idSessao']."'>".$row['descSala']." - ".$row['dataSessao']." - ".$row['horaSessao']." - ".$row['nomeFilme']."</option>";
                }
            }
            $conn->close();
            return $msg;
        }
        
        function getInfoSessao($idSessao){
            global $conn;
            $sql = "SELECT * FROM sessoes, salas WHERE idSessao =".$idSessao." AND salaSessao = idSala;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();
            return json_encode($row);
        }

        function editarSessao($filmeSessao, $salaSessao, $dataSessao, $horaSessao, $estadoSessao, $idSessao){
            global $conn;
            $msg = "";
            $sql = "UPDATE sessoes SET filmeSessao = '".$filmeSessao."', salaSessao = '".$salaSessao."', dataSessao = '".$dataSessao."', horaSessao = '".$horaSessao."',
            estadoSessao = '".$estadoSessao."' WHERE idSessao = '".$idSessao."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Edição efetuada";
            } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
            }                 
            return $msg;
        }

        function listarSessoes(){
            global $conn;
            $msg = "";
            $sql = "SELECT * FROM sessoes, filmes, salas, cinemas WHERE salaSessao = idSala AND filmeSessao = idFilme AND cineSala = idCinema ; " ;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
                while($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";
                    $msg .= "<th scope='row'>".$row['idSessao']."</th>";										//número da sessão
                    $msg .= "<td>".$row['dataSessao']."</td>";													//data
		            $msg .= "<td>".$row['horaSessao']."</td>";													//hora
		            $msg .= "<td>".$row['nomeCinema']."</td>";													//nome do Cinema
		            $msg .= "<td>".$row['descSala']."</td>";													//nome da Sala
                    $msg .= "<td>".$row['nomeFilme']."</td>";													//nome do filme
		            $msg .= "<td><img class='img-responsive cartaz' src='".$row['cartaz']."'></td>";			//cartaz
		    
                    if ($row['estadoSessao'] == 'Ativa') {
                        $msg .= "<td><button class='btn btn-success' onclick='alteraEstado(".$row['idSessao'].", \"Ativa\")'>Ativa</button></td>";  // verificação estado
                    } else {
                        $msg .= "<td><button class='btn btn-danger' onclick='alteraEstado(".$row['idSessao'].", \"Inativa\")'>Inativa</button></td>";  // verificação estado
                    }

		            $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerSessao(".$row['idSessao'].")'>Remover</button></td>"; //remover sessão 
                    $msg .= "</tr>";
                }
            } else {
                $msg .= "<tr>";
                $msg .= "<caption scope='row'><strong>Sem resultados</strong></caption>";
                $msg .= "</tr>";
            }
            $conn->close();
            return $msg; 
        }

        function alteraEstado($idSessao, $estadoAtual) {
            global $conn;
            $msg = "";
            if ($estadoAtual == "Ativa") {
                $estadoNovo = "Inativa";
            } else if ($estadoAtual == "Inativa") {
                $estadoNovo = "Ativa";
            }
            $sql = "UPDATE sessoes SET estadoSessao = '".$estadoNovo."' WHERE idSessao = '".$idSessao."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Alterado com sucesso";
            } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
            }
            return $msg;  //retorna a mensagem de sucesso ou erro ao alterar o estado da sessão
        }

        function removerSessao($idSessao){
            global $conn;
            $msg = "";
            $sql = "DELETE FROM sessoes WHERE idSessao = '".$idSessao."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }
    }
?>