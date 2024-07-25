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
                Registro de Agendamentos
            </div>
            <div class="card-body">
                <form>                    
                    <div class="mb-3">
                        <label for="selectCliente" class="form-label">Selecione o Cliente</label>
                        <select class="form-select" id='selectCliente' required></select>
                    </div>

                    <div class="mb-3">
                        <label for="selectVoo" class="form-label">Observações</label>
                        <select class="form-select" id="selectVoo" required></select>
                    </div>

                    <div class='mb-3'>
                        <label for='qtdPassageiros' class='form-label'>Quantidade de Passageiros</label>
                        <input type="number" class="form-control" id="qtdPassageiros" value='1' required>
                    </div>
                    
                    <button type="button" class="btn btn-success w-100" onclick="addAgendamento()">Registrar</button>
                </form>
            </div>
        </div>
    </div>

</body>

<?php include 'footer.php'; ?>

</html>