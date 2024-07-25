// WorldSkills 2024

let whereAmI = location.pathname;

$(document).ready(function(){
  if ( whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/registar-cinemas.html"
    || whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/editar-cinemas.html"
  ){
    selectLocal();
  }

  if ( whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/registar-cinemas.html"
    || whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/editar-cinemas.html"
    || whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/registar-salas.html"
    || whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/editar-salas.html"
    || whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/registar-sessoes.html"
    || whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/editar-sessoes.html"
  ) {
    getCinemas();
  }

  if (whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/editar-salas.html"){
    getSalas();
  }

  if(whereAmI=="/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/listar-cinemas.html"){
  listarCinemas();
  }
  
  if(whereAmI=="/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/listar-salas.html"){
  listarSalas();
  }

  if( whereAmI=="/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/registar-filmes.html"
    || whereAmI=="/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/editar-filmes.html"
    || whereAmI=="/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/registar-sessoes.html"
  ) {
    getTipos();
    getFilmes();
  }

  if (whereAmI=="/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/listar-filmes.html"){
    listarFilmes();
  }

  if (whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/editar-sessoes.html"){
    getSessoes();
    getSalas();
    getFilmes();
  }

  if (whereAmI=="/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/listar-sessoes.html"){
    listarSessoes();
  }

  if (whereAmI == "/Matheus_Mariano/5417/20240624_WorldSkills/0_Exercicio/index.html"){
    countFilmes();
    countCinemas();
    listarSessoes();
  }

}
);

function registraLocal(){
  let dados = new FormData();
  dados.append('descLocal', $('#descLocal').val());
  dados.append('op', 1);
 
  $.ajax({
    url: "src/controller/controllerCinemas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    getSelect();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function selectLocal(){

  let dados = new FormData();
  dados.append('op', 6);

  $.ajax({
    url: "src/controller/controllerCinemas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#selectLocal").html(msg);
    $("#selectLocalEdit").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function registraCinema(){
  let dados = new FormData();
  dados.append('nomeCinema', $('#nomeCinema').val());
  dados.append('localCinema', $('#selectLocal').val());
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerCinemas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    getCinemas();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getCinemas(){
  let dados = new FormData();
  dados.append('op', 7);

  $.ajax({
    url: "src/controller/controllerCinemas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#selectCinema").html(msg);
    $("#selectCinemaEdit").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getInfoCinema(idCinema){
  let dados = new FormData();
  dados.append('idCinema', idCinema);
  dados.append('op', 3);

  $.ajax({
    url: "src/controller/controllerCinemas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);
    $("#nomeCinemaEdit").val(obj.nomeCinema);
    $("#selectLocalEdit").val(obj.localCinema);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function gravarEdicaoCinema(){
 let dados = new FormData();
 dados.append('idCinema', $('#selectCinema').val());
 dados.append('nomeCinema', $('#nomeCinemaEdit').val());
 dados.append('localCinema', $('#selectLocalEdit').val());
 dados.append('op', 8);

 $.ajax({
   url: "src/controller/controllerCinemas.php",
   method: "POST",
   data: dados,
   dataType: "html",
   cache: false,
   contentType: false,
   processData:false,
 })
 
 .done(function( msg ) {
    alert(msg);   
  })

  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function listarCinemas() {
  let dados = new FormData();
  dados.append('op', 4);

  $.ajax({
    url: "src/controller/controllerCinemas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTCinemas')) {
      $('#dataTCinemas').DataTable().destroy();
    }
     $('#listaCinemas').html(msg);
     $('#dataTCinemas').DataTable();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function removerCinema(idCinema) {
  let dados = new FormData();
  dados.append('op', 5);
  dados.append('idCinema', idCinema);
 
  $.ajax({
    url: "src/controller/controllerCinemas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    listarCinemas();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function addSala(){
 let dados = new FormData();
 dados.append('descSala', $('#descSala').val());
 dados.append('cineSala', $('#selectCinema').val());
 dados.append('op', 1);

 $.ajax({
   url: "src/controller/controllerSalas.php",
   method: "POST",
   data: dados,
   dataType: "html",
   cache: false,
   contentType: false,
   processData:false,
 })
 
 .done(function( msg ) {
    alert(msg);   
  })

  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getSalas() {
 let dados = new FormData();
 dados.append('op', 2);

 $.ajax({
   url: "src/controller/controllerSalas.php",
   method: "POST",
   data: dados,
   dataType: "html",
   cache: false,
   contentType: false,
   processData:false,
 })

 .done(function( msg ) {
    $("#selectSala").html(msg);
    $("#selectSalaEdit").html(msg);
  })

  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getInfoSala(idSala) {
  let dados = new FormData();
  dados.append('idSala', idSala);
  dados.append('op', 3);

  $.ajax({
    url: "src/controller/controllerSalas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg)
    $("#descSalaEdit").val(obj.descSala);
    $("#selectCinemaEdit").val(obj.cineSala);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function gravarEdicaoSala(){
  let dados = new FormData();
  dados.append('idSala', $('#selectSala').val());
  dados.append('descSala', $('#descSalaEdit').val());
  dados.append('cineSala', $('#selectCinemaEdit').val());
  dados.append('op', 4);

  $.ajax({
    url: "src/controller/controllerSalas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);   
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function listarSalas() {
  let dados = new FormData();
  dados.append('op', 5);

  $.ajax({
    url: "src/controller/controllerSalas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTSalas')) {
      $('#dataTSalas').DataTable().destroy();
    }
     $('#listaSalas').html(msg);
     $('#dataTSalas').DataTable();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function removerSala(idSala) {
  let dados = new FormData();
  dados.append('op', 6);
  dados.append('idSala', idSala);
 
  $.ajax({
    url: "src/controller/controllerSalas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    listarSalas();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function addTipo(){
  let dados = new FormData();
  dados.append('descTipoFilme', $('#descTipoFilme').val());
  dados.append('op', 1);

  $.ajax({
    url: "src/controller/controllerFilmes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);   
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getTipos() {
 let dados = new FormData();
 dados.append('op', 6);

  $.ajax({
    url: "src/controller/controllerFilmes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })  
  
  .done(function( msg ) {
    $("#selectTipoFilme").html(msg);
    $("#selectTipoFilmeEdit").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function addFilme() {
  let dados = new FormData();
  dados.append('nomeFilme', $('#nomeFilme').val());
  dados.append('anoFilme', $('#anoFilme').val());
  dados.append('descFilme', $('#descFilme').val());
  dados.append('tipoFilme', $('#selectTipoFilme').val());
  dados.append('cartaz', $('#cartaz').prop('files')[0]);
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerFilmes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);   
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getFilmes() {
  let dados = new FormData();
  dados.append('op', 7);

  $.ajax({
    url: "src/controller/controllerFilmes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#selectFilme").html(msg);
    $("#selectFilmeEdit").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getInfoFilme(idFilme){
  let dados = new FormData();
  dados.append('idFilme', idFilme);
  dados.append('op', 3);

  $.ajax({
    url: "src/controller/controllerFilmes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);
    $('#cartaz').attr('src', obj.cartaz);
    $("#nomeFilmeEdit").val(obj.nomeFilme);
    $("#anoFilmeEdit").val(obj.anoFilme);
    $("#descFilmeEdit").val(obj.descFilme);
    $("#selectTipoFilmeEdit").val(obj.tipoFilme);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function gravarEdicaoFilme(){ 
 let dados = new FormData();
 dados.append('idFilme', $('#selectFilme').val());
 dados.append('nomeFilme', $('#nomeFilmeEdit').val());
 dados.append('anoFilme', $('#anoFilmeEdit').val());
 dados.append('descFilme', $('#descFilmeEdit').val());
 dados.append('tipoFilme', $('#selectTipoFilmeEdit').val());
 dados.append('cartaz', $('#cartazEdit').prop('files')[0]);
 dados.append('op', 8);

 $.ajax({
   url: "src/controller/controllerFilmes.php",
   method: "POST",
   data: dados,
   dataType: "html",
   cache: false,
   contentType: false,
   processData:false,
 })
 
 .done(function( msg ) {
    alert(msg);   
  })

  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function listarFilmes() {
  let dados = new FormData();
  dados.append('op', 4);

  $.ajax({
    url: "src/controller/controllerFilmes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTFilmes')) {
      $('#dataTFilmes').DataTable().destroy();
    }
     $('#listaFilmes').html(msg);
     $('#dataTFilmes').DataTable();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function removerFilme(idFilme) {
  let dados = new FormData();
  dados.append('op', 5);
  dados.append('idFilme', idFilme);
 
  $.ajax({
    url: "src/controller/controllerFilmes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    listarFilmes();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function filtrarSalas(idCinema){
  dados = new FormData();
  dados.append('idCinema', idCinema);
  dados.append('op', 1);

  $.ajax({
    url: "src/controller/controllerSessoes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#selectSala").html(msg);
    $("#selectSalaEdit").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function addSessao(){
  let dados=new FormData();
  dados.append('filmeSessao', $('#selectFilme').val());
  dados.append('salaSessao', $('#selectSala').val());
  dados.append('dataSessao', $('#dataSessao').val());
  dados.append('horaSessao', $('#horaSessao').val());
  dados.append('estadoSessao', $('#selectEstado').val());
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerSessoes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);   
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getSessoes() {
 let dados = new FormData();
 dados.append('op', 3);

  $.ajax({
    url: "src/controller/controllerSessoes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#selectSessao").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getInfoSessao(idSessao){
  let dados = new FormData();
  dados.append('idSessao', idSessao);
  dados.append('op', 4);

  $.ajax({
    url: "src/controller/controllerSessoes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);
    $("#selectFilmeEdit").val(obj.filmeSessao);
    $("#selectCinemaEdit").val(obj.cineSala);
    $("#selectSalaEdit").val(obj.salaSessao);
    $("#dataSessaoEdit").val(obj.dataSessao);
    $("#horaSessaoEdit").val(obj.horaSessao);
    $("#selectEstadoEdit").val(obj.estadoSessao);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function editarSessao(){
  let dados = new FormData();
  dados.append('filmeSessao', $('#selectFilmeEdit').val());
  dados.append('salaSessao', $('#selectSalaEdit').val());
  dados.append('dataSessao', $('#dataSessaoEdit').val());
  dados.append('horaSessao', $('#horaSessaoEdit').val());
  dados.append('estadoSessao', $('#selectEstadoEdit').val());
  dados.append('idSessao', $('#selectSessao').val());
  dados.append('op', 5);

  $.ajax({
    url: "src/controller/controllerSessoes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);   
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function listarSessoes() {
  let dados = new FormData();
  dados.append('op', 6);
  
  $.ajax({
    url: "src/controller/controllerSessoes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTSessoes')) {
      $('#dataTSessoes').DataTable().destroy();
    }
    $('#listaSessoes').html(msg);
    $('#dataTSessoes').DataTable();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function alteraEstado(idSessao, estadoSessao) {
  let dados = new FormData();
  dados.append('idSessao', idSessao);
  dados.append('estadoSessao', estadoSessao);
  dados.append('op', 8);
  
  $.ajax({
    url: "src/controller/controllerSessoes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    listarSessoes();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function removerSessao(idSessao) {
  let dados = new FormData();
  dados.append('op', 7);
  dados.append('idSessao', idSessao);

  $.ajax({
    url: "src/controller/controllerSessoes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    listarSessoes();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function countCinemas(){
  let dados = new FormData();
  dados.append('op', 0);
  
  $.ajax({
    url: "src/controller/controllerCinemas.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#totalCinemas").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function countFilmes(){
  let dados = new FormData();
  dados.append('op', 0);
  
  $.ajax({
    url: "src/controller/controllerFilmes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#totalFilmes").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}