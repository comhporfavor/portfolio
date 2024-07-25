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
        <div class="card">
            <div class="card-header">
                Registro de Destinos
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="descDestino" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="descDestino" required>
                    </div>
                    <div class="mb-3">
                        <label for="localDestino" class="form-label">Localidade</label>
                        <input type="text" class="form-control" id="localDestino" required>
                    </div>
                    <div class="mb-3">
                        <label for="obsDestino" class="form-label">Observações</label>
                        <input type="text" class="form-control" id="obsDestino" required>
                    </div>
                    <div class="mb-3">
                        <label for="valorDestino" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="valorDestino" required>
                    </div>
                    <div class="mb-3">
                        <label for="imgDestino" class="form-label">Imagem de Capa</label>
                        <input type="file" class="form-file" id="imgDestino" required>
                    </div>
                    
                    <button type="button" class="btn btn-success w-100" onclick="addDestino()">Registrar</button>
                </form>
            </div>
        </div>
    </div>

</body>

<?php include 'footer.php'; ?>

</html>