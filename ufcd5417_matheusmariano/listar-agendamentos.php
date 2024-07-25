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
        <label for='filtroVoo'>Selecione um voo para ver os agendamentos:</label>
        <select class="form-select" id='filtroVoo' onchange='listarAgendamentos(this.value)'>

    <div class="container">
        <table class="table table-striped align-items-stretch" id="dataTAgendamentos">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Voo</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Passageiros</th>
                    <th scope="col">Editar?</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody id="listaAgendamentos">
            </tbody>
        </table>
    </div>

    <!-- Modal para edição dos Agendamentos -->
    <div class="modal fade" id="modalEdicaoAgendamento" tabindex="-1" aria-labelledby="modalEdicaoAgendamentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="idAgendamentoEdit" class="form-label">ID:</label>
                        <input type="number" class="form-control" id="idAgendamentoEdit" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="descAgendamentoEdit" class="form-label">Descricao</label>
                        <input type="text" class="form-control" id="descAgendamentoEdit" required>
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
                        <label for="estadoAgendamentoEdit" class="form-label">Observações</label>
                        <select class="form-select" id="estadoAgendamentoEdit" required>
                            <option value=-1>Escolha uma opção</option>
                            <option value="0">Ativo</option>
                            <option value="1">Bloqueado</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger disabled" id="btnGravaEditAgendamento">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<?php include 'footer.php'; ?>

</html>