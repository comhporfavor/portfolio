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

    <div class="container menuPratos">
        <table class="table table-striped align-items-stretch" id="dataTPratos">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Editar?</th>
                    <th scope="col">Excluir?</th>
                </tr>
            </thead>
            <tbody id="listaPratos">
                <!-- Lista dos pratos aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal para edição dos Pratos -->
    <div class="modal fade" id="modalEdicaoPrato" tabindex="-1" aria-labelledby="modalEdicaoPratoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEdicaoPratoLabel">Editar Prato</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>

                <div class="modal-body">
                    <img class="imgPratos" id='fotoPratoShow'>

                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="number" class="form-control" id="id" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="nomePratoEdit" class="form-label">Nome do Prato:</label>
                        <input type="text" class="form-control" id="nomePratoEdit" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="precoPratoEdit" class="form-label">Preço do Prato:</label>
                        <input type="number" class="form-control" id="precoPratoEdit" required>
                    </div>

                    <div class="mb-3">
                        <label for="selectTipoPrato" class="form-label">Tipo de Prato</label>
                        <select class="form-select" id="selectTipoPrato" required> </select>
                    </div>

                    <div class="mb-3">
                        <label for="fotoPratoEdit" class="form-label">Alterar do Foto Prato?</label>
                        <input type="file" class="form-control" id="fotoPratoEdit" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger disabled" id="btnGravaEditPrato">Guardar</button>
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