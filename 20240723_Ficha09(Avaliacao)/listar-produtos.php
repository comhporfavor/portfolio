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
        <table class="table table-striped align-items-stretch" id="dataTProdutos">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Estoque</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Editar?</th>
                    <th scope="col">Excluir?</th>
                </tr>
            </thead>
            <tbody id="listaProdutos">
                <!-- Lista dos Produtos aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal para edição dos Produtos -->
    <div class="modal fade" id="modalEdicaoProduto" tabindex="-1" aria-labelledby="modalEdicaoProdutoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEdicaoProdutoLabel">Editar Produto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>

                <div class="modal-body">
                    <img class="imgProdutos" id='fotoProdutoShow'>

                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="number" class="form-control" id="id" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="nomeProdutoEdit" class="form-label">Nome do Produto:</label>
                        <input type="text" class="form-control" id="nomeProdutoEdit" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="precoProdutoEdit" class="form-label">Preço do Produto:</label>
                        <input type="number" class="form-control" id="precoProdutoEdit" required>
                    </div>

                    <div class="mb-3">
                        <label for="selectTipoProduto" class="form-label">Tipo de Produto</label>
                        <select class="form-select" id="selectTipoProduto" required> </select>
                    </div>

                    <div class="mb-3">
                        <label for="fotoProdutoEdit" class="form-label">Alterar do Foto Produto?</label>
                        <input type="file" class="form-control" id="fotoProdutoEdit" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger disabled" id="btnGravaEditProduto">Guardar</button>
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