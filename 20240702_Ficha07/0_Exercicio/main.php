<?php
    session_start();
    if(isset($_SESSION['user'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cineSkills</title>
    <script src="src/js/jquery.js"></script>
    <script src="src/js/function.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/datatable.css">
    <script src="src/js/datatable.js"></script>
</head>
<body>

    <!-- MENU -->

    <nav class="navbar navbar-expand-lg">
        <div class="mx-5 container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="src/img/cinemas-logo.png" alt="cineSkills logo" width="100" height="auto">
              </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cinemas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-cinemas.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-cinemas.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-cinemas.html">Listar</a></li>
                    </ul>
                </li>     
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Salas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-salas.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-salas.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-salas.html">Listar</a></li>
                    </ul>
                </li>    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filmes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-filmes.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-filmes.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-filmes.html">Listar</a></li>
                    </ul>
                </li>      
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sessões
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-sessoes.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-sessoes.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-sessoes.html">Listar</a></li>
                    </ul>
                </li>            
            </ul>
          </div>
        </div>
      </nav>

    <!-- DASHBOARD COM CARDS INFORMATIVAS -->
<div class="container">
    <div class="row">
        <div class="col-12 my-4">
            <h4>Dashboard</h4>
        </div>
        <div class="col-6 my-4">
            <div class="card">
                <div class="card-body">
                  Cinemas
                </div>
                <p id="totalCinemas"></p>
            </div>
        </div>
        <div class="col-6 my-4">
            <div class="card">
                <div class="card-body">
                  Filmes
                </div>
                <p id="totalFilmes"></p>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 my-4">

            <div class="container">

                <table class="table table-striped" id="dataTSessoes">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Data</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Cinema</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Filme</th>
                        <th scope="col">Cartaz</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Remover?</th>
                      </tr>
                    </thead>
                    <tbody id="listaSessoes">
                    </tbody>
                </table>
            
            </div>
        </div>
    </div>

    <br><br>
</div>

</body>
</html>

<?php
    } else {
?>
<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript">
        alert('Você precisa estar logado para acessar esta página!');
        window.location.href = "index.html";
    </script>
<?php
    }
?>