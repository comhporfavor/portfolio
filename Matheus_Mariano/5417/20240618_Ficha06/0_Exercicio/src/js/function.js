// Ficha 06
function addClube(){

  let dados = new FormData();
  dados.append('nomeClube', $('#nomeClube').val());
  dados.append('localClube', $('#localClube').val());
  dados.append('emailClube', $('#emailClube').val());
  dados.append('anoFund', $('#anoFund').val());
  dados.append('telClube', $('#telClube').val());
  dados.append('logotipo', $('#logotipo').prop('files')[0]);
  dados.append('op', 1);
 
  $.ajax({
    url: "src/controller/controllerClubes.php",
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

function getSelect(){

  let dados = new FormData();
  dados.append('op', 6);

  $.ajax({
    url: "src/controller/controllerClubes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#selectClube").html(msg);
    $("#selectClubeEdit").html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

$(document).ready(function(){
  getSelect();
}
);

function listarClubes(){
  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerClubes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTClubes')) {
      $('#dataTClubes').DataTable().destroy();
    }
     $('#tableClubes').empty().html(msg);
     $('#dataTClubes').DataTable();
     $('#dataTClubes').removeClass('d-none').addClass('d-block');
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function removerClube(idClube) {
  let dados = new FormData();
  dados.append('op', 3);
  dados.append('idClube', idClube);
 
  $.ajax({
    url: "src/controller/controllerClubes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    listarClubes();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getDadosClube(idClube){
  $('#modalClubeEdit').modal('show');
  let dados = new FormData();
  dados.append('op', 4);
  dados.append('idClube', idClube);

  $.ajax({
    url: "src/controller/controllerClubes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   let obj = JSON.parse(msg);
   $('#logoModal').attr('src', obj.logotipo);
   $('#nomeClubeEdit').val(obj.nomeClube);
   $('#localClubeEdit').val(obj.localClube);
   $('#emailClubeEdit').val(obj.emailClube);
   $('#anoFundEdit').val(obj.anoFund);
   $('#telClubeEdit').val(obj.telClube);
   $('#btnGuardarEditClube').attr('onclick', 'guardaEdicaoClube('+obj.idClube+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function guardaEdicaoClube(idClube){
  let dados = new FormData();
  dados.append('idClube', idClube);
  dados.append('nomeClube', $('#nomeClubeEdit').val());
  dados.append('localClube', $('#localClubeEdit').val());
  dados.append('emailClube', $('#emailClubeEdit').val());
  dados.append('anoFund', $('#anoFundEdit').val());
  dados.append('telClube', $('#telClubeEdit').val());
  dados.append('logotipo', $('#logotipoEdit').prop('files')[0]);
  dados.append('op', 5);
 
  $.ajax({
    url: "src/controller/controllerClubes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $('#modalClubeEdit').modal('hide');
    alert(msg);
    listarClubes();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function addJogador() {
  let dados = new FormData();
  dados.append('numFed', $('#numFed').val());
  dados.append('nomeJog', $('#nomeJog').val());
  dados.append('idadeJog', $('#idadeJog').val());
  dados.append('moradaJog', $('#moradaJog').val());
  dados.append('emailJog', $('#emailJog').val());
  dados.append('telJog', $('#telJog').val());
  dados.append('selectClube', $('#selectClube').val());
  dados.append('fotoJog', $('#fotoJog').prop('files')[0]);
  dados.append('op', 1);
 
  $.ajax({
    url: "src/controller/controllerJogadores.php",
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

function listarJogadores(){
  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerJogadores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTJogadores')) {
      $('#dataTJogadores').DataTable().destroy();
    }
     $('#tableJogadores').empty().html(msg);
     $('#dataTJogadores').DataTable();
     $('#dataTJogadores').removeClass('d-none').addClass('d-block');
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function removerJogador(numFed) {
  let dados = new FormData();
  dados.append('op', 3);
  dados.append('numFed', numFed);

  $.ajax({
    url: "src/controller/controllerJogadores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    alert(msg);
    listarJogadores();   
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getDadosJogador(numFed){
  $('#modalJogadorEdit').modal('show');

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('numFed', numFed);
 
  $.ajax({
    url: "src/controller/controllerJogadores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   let obj = JSON.parse(msg);
   $('#fotoModal').attr('src', obj.fotoJog);
   $('#numFedEdit').val(obj.numFed);
   $('#nomeJogEdit').val(obj.nomeJog);
   $('#idadeJogEdit').val(obj.idadeJog);
   $('#moradaJogEdit').val(obj.moradaJog);
   $('#emailJogEdit').val(obj.emailJog);
   $('#telJogEdit').val(obj.telJog);
   $('#selectClubeEdit').val(obj.clube);
   $('#btnGuardarEditJogador').attr('onclick', 'guardaEdicaoJogador('+obj.numFed+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function guardaEdicaoJogador(numFed){
  let dados = new FormData();
  dados.append('oldNumFed', numFed);
  dados.append('newNumFed', $('#numFedEdit').val());
  dados.append('nomeJog', $('#nomeJogEdit').val());
  dados.append('idadeJog', $('#idadeJogEdit').val());
  dados.append('moradaJog', $('#moradaJogEdit').val());
  dados.append('emailJog', $('#emailJogEdit').val());
  dados.append('telJog', $('#telJogEdit').val());
  dados.append('clube', $('#selectClubeEdit').val());
  dados.append('fotoJog', $('#fotoJogEdit').prop('files')[0]);
  dados.append('op', 5);
 
  $.ajax({
    url: "src/controller/controllerJogadores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $('#modalJogadorEdit').modal('hide');
    alert(msg);
    listarJogadores();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function esconderTabela(idTabela){
  let tabela = '#'+idTabela;
  $(tabela).removeClass('d-block').addClass('d-none');
  $(tabela).DataTable().destroy();  
}
