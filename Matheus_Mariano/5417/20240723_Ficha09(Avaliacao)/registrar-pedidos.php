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
        <h4>Registrar Pedidos</h4>
        
        <form class="form-horizontal">
            <div class="form-group">
                <label for='reserva'>Selecione a Reserva :</label>
                <select class="form-control" id='selectReserva'>
                    <!-- Lista das reservas aqui -->
                </select>
            </div>
        </form>
    </div>    

    <div class="container menuPratos">
        <table class="table table-striped align-items-stretch" id="dataTPratos">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Pedir?</th>
                </tr>
            </thead>
            <tbody id="listaPratos">
                <!-- Tabela dos pratos aqui -->
            </tbody>
        </table>
    </div>

    <br><br>    

    <button type="button" class="btn btn-success w-100" onclick="addPedido()">Adicionar Pedido</button>
</body>

<footer class="bg-dark text-white text-center py-3 mt-5">
        &copy; 2023 5417/5419 Avaliação. Todos os direitos reservados.
        <div>Logótipo feito com <a href="https://www.designevo.com/pt/" title="Criador de Logótipos Online Grátis">DesignEvo</a></div>
</footer>

</html>