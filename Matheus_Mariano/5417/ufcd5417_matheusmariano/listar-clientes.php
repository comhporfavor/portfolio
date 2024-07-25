<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'links.php'; ?>
</head>

<header>
    <?php include 'navbar.php'; ?>
</header>

<body>
    <div class="container">
        <table class="table table-striped align-items-stretch" id="dataTClientes">
            <thead>
                <tr>
                    <th scope="col">NIF</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Morada</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Idade</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Editar?</th>
                </tr>
            </thead>
            <tbody id="listaClientes">
            </tbody>
        </table>
    </div>

    <!-- Modal para edição dos Clientes -->
    <div class="modal fade" id="modalEdicaoCliente" tabindex="-1" aria-labelledby="modalEdicaoClienteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editando: <span id="nomeClienteHeader"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nifClienteEdit" class="form-label">NIF:</label>
                        <input type="number" class="form-control" id="nifClienteEdit" required>
                    </div>

                    <div class="mb-3">
                        <label for="nomeClienteEdit" class="form-label">Nome do Cliente:</label>
                        <input type="text" class="form-control" id="nomeClienteEdit" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="moradaClienteEdit" class="form-label">Morada do Cliente:</label>
                        <input type="text" class="form-control" id="moradaClienteEdit" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefoneClienteEdit" class="form-label">Telefone de Cliente:</label>
                        <input type="number" class="form-control" id="telefoneClienteEdit" required>
                    </div>

                    <div class="mb-3">
                        <label for="emailClienteEdit" class="form-label">e-Mail de Cliente:</label>
                        <input type="email" class="form-control" id="emailClienteEdit" required>
                    </div>

                    <div class="mb-3">
                        <label for="idadeClienteEdit" class="form-label">Idade</label>
                        <input type='number' class="form-control" id="idadeClienteEdit" required>
                    </div>

                    <div class="mb-3">
                        <label for="selectTipoClienteEdit" class="form-label">Tipo de Cliente</label>
                        <select class="form-select" id="selectTipoClienteEdit" required> </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger disabled" id="btnGravaEditCliente">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<?php include 'footer.php'; ?>

</html>