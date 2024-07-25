
function getSelect(){

  let dados = new FormData();
  dados.append('op', 6);

  $.ajax({
    url: "src/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#clienteProj").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

$(document).ready(function(){
  getSelect();
}
);

function addCliente(){

  let dados = new FormData();
  dados.append('nifCliente', $('#nifCliente').val());
  dados.append('nomeCliente', $('#nomeCliente').val());
  dados.append('localCliente', $('#localCliente').val());
  dados.append('emailCliente', $('#emailCliente').val());
  dados.append('telCliente', $('#telCliente').val());
  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerClientes.php",
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
    $('#modalAddCliente').modal('hide');
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function listarClientes(){
  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTClientes')) {
      $('#dataTClientes').DataTable().destroy();
    }
     $('#tableClientes').empty().html(msg);
     $('#dataTClientes').DataTable();
     $('#dataTClientes').removeClass('d-none').addClass('d-block');
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function removerCliente(idCliente) {

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('idCliente', idCliente);

 
  $.ajax({
    url: "src/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alert(msg);
    listarClientes();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function getDadosCliente(idCliente){
  $('#editCliente').modal('show');

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('idCliente', idCliente);

 
  $.ajax({
    url: "src/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

   let obj = JSON.parse(msg);
   $('#nifEdit').val(obj.nifCliente);
   $('#nomeEdit').val(obj.nomeCliente);
   $('#localEdit').val(obj.localCliente);
   $('#emailEdit').val(obj.emailCliente);
   $('#telEdit').val(obj.telCliente);

   $('#btnGuardaEdit').attr('onclick', 'guardaEdicaoCliente('+obj.idCliente+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });


}

function guardaEdicaoCliente(idCliente){

  let dados = new FormData();
  dados.append('nifCliente', $('#nifEdit').val());
  dados.append('nomeCliente', $('#nomeEdit').val());
  dados.append('localCliente', $('#localEdit').val());
  dados.append('emailCliente', $('#emailEdit').val());
  dados.append('telCliente', $('#telEdit').val());
  dados.append('idCliente', idCliente);
  dados.append('op', 5);

 
  $.ajax({
    url: "src/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#editCliente').modal('hide');
    alert(msg);
    listarClientes();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function addProjeto() {
  let dados = new FormData();
  dados.append('descProj', $('#descProj').val());
  dados.append('tipoProj', $('#tipoProj').val());
  dados.append('clienteProj', $('#clienteProj').val());
  dados.append('op', 1);
 
  $.ajax({
    url: "src/controller/controllerProjetos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    $('#modalAddProjeto').modal('hide')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });


}

function listarProjetos(){

  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerProjetos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTProjetos')) {
      $('#dataTProjetos').DataTable().destroy();
    }
     $('#tableProjetos').empty().html(msg);
     $('#dataTProjetos').DataTable();
     $('#dataTProjetos').removeClass('d-none').addClass('d-block');
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function removerProjeto(idProj) {
  let dados = new FormData();
  dados.append('op', 3);
  dados.append('idProj', idProj);

 
  $.ajax({
    url: "src/controller/controllerProjetos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alert(msg);
    listarProjetos();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });


}

function mostrarModalCliente(){
  $('#modalAddCliente').modal('show');
}

function mostrarModalProj(){
  $('#modalAddProjeto').modal('show');
}

function esconderTabela(idTabela){
  let tabela = '#'+idTabela;
  $(tabela).removeClass('d-block').addClass('d-none');
  $(tabela).DataTable().destroy();  
}
