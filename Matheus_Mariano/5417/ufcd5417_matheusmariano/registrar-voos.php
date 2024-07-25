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
                Registro de Voos
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="descVoo" class="form-label">Descricao</label>
                        <input type="text" class="form-control" id="descVoo" required>
                    </div>

                    <div class="mb-3">
                        <label for="selectAviao" class="form-label">Aviao</label>
                        <select class="form-select" id='selectAviao' required></select>
                    </div>

                    <div class="mb-3">
                        <label for="selectDestino" class="form-label">Destino</label>
                        <select class="form-select" id="selectDestino" required></select>
                    </div>

                    <div class="mb-3">
                        <label for="estadoVoo" class="form-label">Observações</label>
                        <select class="form-select" id="estadoVoo" required>
                            <option value=-1>Escolha uma opção</option>
                            <option value="0">Ativo</option>
                            <option value="1">Bloqueado</option>
                        </select>
                    </div>
                    
                    <button type="button" class="btn btn-success w-100" onclick="addVoo()">Registrar</button>
                </form>
            </div>
        </div>
    </div>

</body>

<?php include 'footer.php'; ?>

</html>