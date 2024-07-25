<?php
    session_start();

    if(isset($_SESSION['utilizador'])){ 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Formativa 3 - 5417 - Clientes</title>
    <link rel="stylesheet" href="assets/css/datatables.css">
    <link rel="stylesheet" href="assets/css/select2.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="assets/js/lib/jquery.js"></script>
    <script src="assets/js/lib/datatables.js"></script>
    <script src="assets/js/lib/select2.js"></script>
    <script src="assets/js/lib/sweatalert.js"></script>
    <script src="assets/js/lib/bootstrap.js"></script>
    <script src="assets/js/jogador.js"></script>
    <script src="assets/js/login.js"></script>
</head>

<body>
    <?php include_once 'menu.php' ?>

    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">Jogadores</h5>
            <div class="card-body">
                <h5 class="card-title">Registar</h5>
                <form class="row g-3">
                    <div class="col-md-3">
                        <label for="numJogador" class="form-label">Número</label>
                        <input type="number" class="form-control" id="numJogador">
                    </div>
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome">
                    </div>
                    <div class="col-md-3">
                        <label for="idade" class="form-label">Idade</label>
                        <input type="number" class="form-control" id="idade">
                    </div>

                    <div class="col-md-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email">
                    </div>

                    <div class="col-md-3">
                        <label for="clubeJogador" class="form-label">Clube</label>
                        <select class="form-control" id="clubeJogador">
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="morada" class="form-label">Morada</label>
                        <input type="text" class="form-control" id="morada">
                    </div>

                    <div class="col-md-6">
                        <label for="fotoJogador" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoJogador">
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onclick="registaJogador()">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">Jogadores</h5>
            <div class="card-body">
                <h5 class="card-title">Listagem</h5>

                <table class="table table-striped" id="tblJogador">
                    <thead>
                        <tr>
                            <th scope="col">Nº Federativo</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Morada</th>
                            <th scope="col">clube</th>
                            <th scope="col">idade</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Remover</th>
                        </tr>
                    </thead>

                    <tbody id="listagemJogador">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="formEditJogador" style="overflow:hidden;" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Jogador</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card">
                            <h5 class="card-header">Jogador <span id="nmJogador"></span></h5>
                            <div class="card-body">
                                <h5 class="card-title">Editar</h5>
                                <form class="row g-3">
                                    <div class="col-md-3">
                                        <label for="numJogadorEdit" class="form-label">Número</label>
                                        <input type="number" class="form-control" id="numJogadorEdit">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomeEdit" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nomeEdit">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="idadeEdit" class="form-label">Idade</label>
                                        <input type="number" class="form-control" id="idadeEdit">
                                    </div>
                
                                    <div class="col-md-3">
                                        <label for="telefoneEdit" class="form-label">Telefone</label>
                                        <input type="tel" class="form-control" id="telefoneEdit">
                                    </div>
                
                                    <div class="col-md-6">
                                        <label for="emailEdit" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailEdit">
                                    </div>
                
                                    <div class="col-md-3">
                                        <label for="clubeJogadorEdit" class="form-label">Clube</label>
                                        <select class="form-control" id="clubeJogadorEdit">
                                        </select>
                                    </div>
                
                                    <div class="col-md-6">
                                        <label for="moradaEdit" class="form-label">Morada</label>
                                        <input type="text" class="form-control" id="moradaEdit">
                                    </div>
                
                                    <div class="col-md-6">
                                        <label for="fotoJogadorEdit" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="fotoJogadorEdit">
                                    </div>

                                    <div class="col-md-6">
                                        <img class="img-thumbnail" id="fotoAtual">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php 
}else{
    echo "sem permissão!";
}

?>