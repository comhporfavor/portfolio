<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT</title>
    <?php include 'links.php'; ?>
</head>

<header>
    <?php include 'navbar.php'; ?>
</header>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Registro de Produtos
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="nomeProduto" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="nomeProduto" placeholder="Insira o nome do Produto" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="preco" placeholder="Insira o preço do Produto" required>
                    </div>
                    <div class="mb-3">
                        <label for="selectTipoProduto" class="form-label">Tipo de Produto</label>
                        <select class="form-select" id="selectTipoProduto" required> </select>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto:</label> <br>
                        <input type="file" class="form-file" id="foto" required>
                    </div>
                    <div class="mb-3">
                        <label for="estoque" class="form-label">Quantidade Inicial:</label>
                        <input type="number" class="form-control" id="estoque" placeholder="Insira a quantidade do Produto" required>
                    </div>
                    <button type="button" class="btn btn-success w-100" onclick="addProduto()">Registrar</button>
                </form>
            </div>
        </div>
    </div>
    
</body>

<footer class="bg-dark text-white text-center py-3 mt-5">
        &copy; 2023 5417/5419 Avaliação. Todos os direitos reservados.
        <div>Logótipo feito com <a href="https://www.designevo.com/pt/" title="Criador de Logótipos Online Grátis">DesignEvo</a></div>
</footer>

</html>