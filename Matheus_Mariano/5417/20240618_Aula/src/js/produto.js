function registaProduto(){

  let dados = new FormData();
  dados.append('ref', $('#refProduto').val());
  dados.append('nome', $('#nomeProduto').val());
  dados.append('descricao', $('#descrProduto').val());
  dados.append('preco', $('#precoProduto').val());
  dados.append('tipo', $('#tipoProduto').val());
  dados.append('imagem', $('#imgProduto').prop('files')[0]);
  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerProduto.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
     alerta("success", msg);
     listaProdutos();
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function listaProdutos(){

  let dados = new FormData();
  dados.append('op', 2);

 
  $.ajax({
    url: "src/controller/controllerProduto.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#tableProdutos').html(msg);
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function removerProduto(id){
  let dados = new FormData();
  dados.append('ref', id);
  dados.append('op', 3);

 
  $.ajax({
    url: "src/controller/controllerProduto.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaProdutos();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function getDadosProduto(id){

  $('#modalEdit').modal('show');

  let dados = new FormData();
  dados.append('ref', id);
  dados.append('op', 4);

 
  $.ajax({
    url: "src/controller/controllerProduto.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);
    $('#refProdutoEdit').val(obj.ref);  
    $('#nomeProdutoEdit').val(obj.nome);
    $('#descrProdutoEdit').val(obj.descricao);
    $('#precoProdutoEdit').val(obj.preco);
    $('#tipoProdutoEdit').val(obj.tipo);
    $('#btnGuardarEdit').attr('onclick', 'guardaEditProduto('+id+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function guardaEditProduto(id){

  let dados = new FormData();
  dados.append('ref', $('#refProdutoEdit').val());
  dados.append('refOld', id);
  dados.append('nome', $('#nomeProdutoEdit').val());
  dados.append('descricao', $('#descrProdutoEdit').val());
  dados.append('preco', $('#precoProdutoEdit').val());
  dados.append('tipo', $('#tipoProdutoEdit').val());
  dados.append('op', 5);

 
  $.ajax({
    url: "src/controller/controllerProduto.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alerta("success", msg);
    listaProdutos();
    $('#modalEdit').modal('hide');  
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getTipos(){
  let dados = new FormData();
  dados.append('op', 6);

 
  $.ajax({
    url: "src/controller/controllerProduto.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

   $('#tipoProduto').html(msg)
   $('#tipoProdutoEdit').html(msg)
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function alerta(icon, msg){
  Swal.fire({
    icon: icon,
    text: msg,
  });
}


// Shorthand for $( document ).ready()
$(function() {
  listaProdutos();
  getTipos();
});
