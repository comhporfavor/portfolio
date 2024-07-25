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
        <div class="card">
            <div class="card-header">
                Registro de Pratos
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="nomePrato" class="form-label">Nome do prato</label>
                        <input type="text" class="form-control" id="nomePrato" placeholder="Insira o nome do prato" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="preco" placeholder="Insira o preço do prato" required>
                    </div>
                    <div class="mb-3">
                        <label for="selectTipoPrato" class="form-label">Tipo de Prato</label>
                        <select class="form-select" id="selectTipoPrato" required> </select>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto:</label> <br>
                        <input type="file" class="form-file" id="foto" required>
                    </div>
                    <button type="button" class="btn btn-success w-100" onclick="addPrato()">Registrar</button>
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