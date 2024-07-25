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
                Registro de Reservas
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="selectCliente" class="form-label">Selecione o Cliente:</label>
                        <select class="form-select" id="selectCliente" required> </select>
                    </div>
                    <div class="mb-3">
                    <label for="selectMesa" class="form-label">Selecione a Mesa:</label>
                    <select class="form-select" id="selectMesa" required> </select>
                    </div>
                    <div class="mb-3">
                        <label for="data" class="form-label">Data:</label>
                        <input type="date" class="form-control" id="data" placeholder="Insira a data" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora:</label>
                        <select class='form-select' id='hora' required>
                            <option value='-1'>Escolha uma opção</option>
                            <option value='12:00'>12:00</option>
                            <option value='13:00'>13:00</option>
                            <option value='14:00'>14:00</option>
                            <option value='19:00'>19:00</option>
                            <option value='20:00'>20:00</option>
                            <option value='21:00'>21:00</option>
                        </select>    
                    </div>

                    <button type="button" class="btn btn-success w-100" onclick="addReserva()">Registrar</button>
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