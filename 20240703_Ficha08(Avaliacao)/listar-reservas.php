<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CozinhÉvora - </title>
    <?php include 'links.php'; ?>
</head>

<header>
    <?php include 'navbar.php'; ?>
</header>

<body>
    <div class="container">
        <table class="table table-striped align-items-stretch" id="dataTReservas">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Mesa</th>
                    <th scope="col">Data</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Excluir?</th>
                </tr>
            </thead>
            <tbody id="listaReservas">
                <!-- Lista das reservas aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal para edição das Reservas -->
    <div class="modal fade" id="modalEdicaoReserva" tabindex="-1" aria-labelledby="modalEdicaoReservaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEdicaoReservaLabel">Editar Reserva</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="number" class="form-control" id="id" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="clienteReserva" class="form-label">Cliente:</label>
                        <input type="text" class="form-control" id="clienteReserva" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="mesaEdit" class="form-label">Mesa:</label>
                        <input type="text" class="form-control" id="mesaEdit" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label for="dataReserva" class="form-label">Data da Reserva</label>
                        <input type="date" class="form-control" id="dataReserva" required>
                    </div>

                    <div class="mb-3">
                        <label for="horaEdit" class="form-label">Hora:</label>
                        <select class='form-select' id='horaEdit' required>
                            <option value='-1'>Escolha uma opção</option>
                            <option value='12:00'>12:00</option>
                            <option value='13:00'>13:00</option>
                            <option value='14:00'>14:00</option>
                            <option value='19:00'>19:00</option>
                            <option value='20:00'>20:00</option>
                            <option value='21:00'>21:00</option>
                        </select>    
                    </div>

                    <div class="mb-3">
                        <label for="estadoEdit" class="form-label">Alterar Estado?</label>
                        <select class="form-select" id="estadoEdit" required>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger disabled" id="btnGravaEditReserva">Guardar</button>
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