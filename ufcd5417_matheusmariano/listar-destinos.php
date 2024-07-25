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
        <table class="table table-striped align-items-stretch" id="dataTDestinos">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Localidade</th>
                    <th scope="col">Observações</th>
                    <th scope="col">Valor</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="listaDestinos">
            </tbody>
        </table>
    </div>

    <!-- Modal para Foto -->
    <div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Imagem: <span id="nomeLocal"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" >
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <img src='' id="imgLocal">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<?php include 'footer.php'; ?>

</html>