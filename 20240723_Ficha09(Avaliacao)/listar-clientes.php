<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITStore</title>
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
                    <th scope="col">Tipo</th>
                    <th scope="col">Editar?</th>
                    <th scope="col">Excluir?</th>
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
                    <h4 class="modal-title" id="modalEdicaoClienteLabel">Editar Cliente</h4>
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

<footer class="bg-dark text-white text-center py-3 mt-5">
        &copy; 2023 5417/5419 Avaliação. Todos os direitos reservados.
        <div>Logótipo feito com <a href="https://www.designevo.com/pt/" title="Criador de Logótipos Online Grátis">DesignEvo</a></div>
</footer>

</html>