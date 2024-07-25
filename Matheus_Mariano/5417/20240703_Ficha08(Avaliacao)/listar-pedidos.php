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
    <h1 class="text-center">Cozinha</h1>

    <div class="container menuPratos">
        <table class="table table-striped align-items-stretch" id="dataTPedidos">
            <thead>
                <tr>
                    <th scope="col">Pedido</th>
                    <th scope="col">Mesa</th>
                    <th scope="col">Prato</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cancelar?</th>
                    <th scope="col">Encerrar</th>
                </tr>
            </thead>
            <tbody id="listaPedidos">
                <!-- Tabela dos pratos aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal para edição das Pedidos -->
    <div class="modal fade" id="modalEdicaoPedido" tabindex="-1" aria-labelledby="modalEdicaoPedidoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEdicaoPedidoLabel">Editar Pedido</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="number" class="form-control" id="id" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="mesaEdit" class="form-label">Mesa:</label>
                        <input type="text" class="form-control" id="mesaEdit" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Prato</th>
                                </tr>
                            </thead>
                            <tbody id="listaPratos">
                                <!-- Tabela dos pratos aqui -->
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-3">
                        <label for="estadoEdit" class="form-label">Alterar Estado?</label>
                        <select class="form-select" id="estadoEdit" required>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger disabled" id="btnGravaEditPedido">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Faturas -->
    <div class="modal fade" id="modalFatura" tabindex="-1" aria-labelledby="modalFaturaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFaturaLabel">Fatura do Pedido</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="idPedidoFatura" class="form-label">ID do Pedido</label>
                        <input type="number" class="form-control" id="idPedidoFatura" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="mesaFatura" class="form-label">Mesa</label>
                        <input type="text" class="form-control" id="mesaFatura" disabled>
                    </div>
                    <div class="mb-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Prato</th>
                                    <th scope="col">Preço</th>
                                </tr>
                            </thead>
                            <tbody id="listaPratosFatura">
                                <!-- Tabela dos pratos aqui -->
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="text" class="form-control" id="total" disabled>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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