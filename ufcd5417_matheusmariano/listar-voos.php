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
        <table class="table table-striped align-items-stretch" id="dataTVoos">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Avião</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Editar?</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody id="listaVoos">
            </tbody>
        </table>
    </div>

    <!-- Modal para edição dos Voos -->
    <div class="modal fade" id="modalEdicaoVoo" tabindex="-1" aria-labelledby="modalEdicaoVooLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Voo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="idVooEdit" class="form-label">ID:</label>
                        <input type="number" class="form-control" id="idVooEdit" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="descVooEdit" class="form-label">Descricao</label>
                        <input type="text" class="form-control" id="descVooEdit" required>
                    </div>

                    <div class="mb-3">
                        <label for="selectAviaoEdit" class="form-label">Aviao</label>
                        <select class="form-select" id='selectAviaoEdit' required></select>
                    </div>

                    <div class="mb-3">
                        <label for="selectDestino" class="form-label">Observações</label>
                        <select class="form-select" id="selectDestinoEdit" required></select>
                    </div>

                    <div class="mb-3">
                        <label for="estadoVooEdit" class="form-label">Observações</label>
                        <select class="form-select" id="estadoVooEdit" required>
                            <option value=-1>Escolha uma opção</option>
                            <option value="0">Ativo</option>
                            <option value="1">Bloqueado</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger disabled" id="btnGravaEditVoo">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<?php include 'footer.php'; ?>

</html>