
function getSelect(){

  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerTipo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    $("#tipoProduto").html(msg);
    $('#editTipoProduto').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

$(document).ready(function(){
  getSelect();
}
);

function addTipo(){
  let dados = new FormData();
  dados.append('novoTipo', $('#novoTipo').val());
  dados.append('op', 1);

  $.ajax({
    url: "src/controller/controllerTipo.php",
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

function addProduto(){

  let dados = new FormData();
  dados.append('nomeProduto', $('#nomeProduto').val());
  dados.append('tipoProduto', $('#tipoProduto').val());
  dados.append('descProduto', $('#descProduto').val());
  dados.append('precoProduto', $('#precoProduto').val());
  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerProdutos.php",
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


function listarProdutos(){
  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerProdutos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    if ($.fn.DataTable.isDataTable('#dataTProdutos')) {
      $('#dataTProdutos').DataTable().destroy();
    }
     $('#tableProdutos').empty().html(msg);
     $('#dataTProdutos').DataTable();
     $('#dataTProdutos').removeClass('invisible').addClass('visible');
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function removerProd(ref){

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('ref', ref);

 
  $.ajax({
    url: "src/controller/controllerProdutos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alert(msg);
    listarProdutos();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function getDadosProd(ref){
  $('#editProd').modal('show');

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('ref', ref);

 
  $.ajax({
    url: "src/controller/controllerProdutos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

   let obj = JSON.parse(msg);
   $('#nomeEdit').val(obj.nome);
   $('#editTipoProduto').val(obj.tipo);
   $('#descEdit').val(obj.descricao);
   $('#precoEdit').val(obj.preco);

   $('#btnGuardaEdit').attr('onclick', 'guardaEdicaoProd('+obj.ref+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });


}


function guardaEdicaoProd(ref){

  let dados = new FormData();
  dados.append('nome', $('#nomeEdit').val());
  dados.append('tipo', $('#editTipoProduto').val());
  dados.append('descricao', $('#descEdit').val());
  dados.append('preco', $('#precoEdit').val());
  dados.append('ref', ref);
  dados.append('op', 5);

 
  $.ajax({
    url: "src/controller/controllerProdutos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#editProd').modal('hide');
    alert(msg);
    listarProdutos();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}
