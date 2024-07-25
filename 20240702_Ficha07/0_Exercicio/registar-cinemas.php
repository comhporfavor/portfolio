<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cineSkills</title>
    <?php include 'links.php'; ?>
</head>

<header>
    <?php include 'navbar.php'; ?>
</header>

<body>
    
    <!-- REGISTAR NOVO CINEMA -->
<div class="container">
    <div class="row">
        <div class="col-12 my-4">
            <h4>Registar Cinema</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="nomeCinema" class="form-label">Nome do Cinema:</label>
                <input type="text" class="form-control" id="nomeCinema">
            </div>

            <div class="mb-3">
                <label for="selectLocal" class="form-label">Selecionar Local:</label>
                <select class="form-select" aria-label="Default select example" id="selectLocal">
                </select>
            </div>

            <button type="button" class="btn btn-success" onclick="registraCinema()">Guardar</button>

            <br><br>

            <h6>Não encontrou o local desejado?</h6>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalRegistraLocal">
                Registar Local
            </button>

            <!-- Modal -->
            <div class="modal" id="modalRegistraLocal">
                <div class="modal-dialog">
                  <div class="modal-content">
              
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Registro de novo local</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
              
                    <!-- Modal body -->
                    <div class="modal-body">
                      <form class="form">
                        <label for="descLocal" class="col-sm-6 control-label">Nome do Local</label> <br>
                        <input type="text" class="form-control" id="descLocal" placeholder="Digite o nome do local...">
                    </div>
              
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="registraLocal()">Gravar</button>
                    </div>
              
                  </div>
                </div>
            </div>
        </div>
    </div>   
</div>

</body>
</html>