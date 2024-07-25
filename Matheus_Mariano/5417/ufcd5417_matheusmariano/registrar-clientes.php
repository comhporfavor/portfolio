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
                Registro de Clientes
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="nif" class="form-label">NIF</label>
                        <input type="number" class="form-control" id="nif" placeholder="Insira o NIF" required>
                    </div>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" placeholder="Insira o nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="morada" class="form-label">Morada</label>
                        <input type="text" class="form-control" id="morada" placeholder="Insira a morada" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" placeholder="Insira o telefone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Insira o email" required>
                    </div>
                    <div class="mb-3">
                        <label for="idade" class="form-label">Idade</label>
                        <input type='number' class="form-control" id="idade" placeholder='Insira a idade' required>
                    </div>
                    <div class="mb-3">
                        <label for = "tipoCliente" class="form-label">Tipo de Cliente</label>
                        <select class="form-select" id="tipoCliente" required>
                        </select>
                    </div>
                    <button type="button" class="btn btn-success w-100" onclick="addCliente()">Registrar</button>
                </form>
            </div>
        </div>
    </div>

</body>

<?php include 'footer.php'; ?>

</html>