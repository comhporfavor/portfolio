function registaUser(){

  let dados = new FormData();
  dados.append('nome', $('#nome').val());
  dados.append('morada', $('#morada').val());
  dados.append('telefone', $('#telefone').val());
  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerUtilizador.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alert(msg);
    listaUser();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function listaUser(){

  let dados = new FormData();
  dados.append('op', 2);

 
  $.ajax({
    url: "src/controller/controllerUtilizador.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#listaUtilizador').html(msg);
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function removerUser(id){

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('id', id);

 
  $.ajax({
    url: "src/controller/controllerUtilizador.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    alert(msg);
    listaUser();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function editarUser(id){
  $('#editUser').modal('show');

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('id', id);

 
  $.ajax({
    url: "src/controller/controllerUtilizador.php",
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
   $('#moradaEdit').val(obj.morada);
   $('#telefoneEdit').val(obj.telefone);

   $('#btnGuardaEdit').attr('onclick', 'guardaDadosUser('+obj.id+')')
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });


}

function guardaDadosUser(id){

  let dados = new FormData();
  dados.append('nome', $('#nomeEdit').val());
  dados.append('morada', $('#moradaEdit').val());
  dados.append('telefone', $('#telefoneEdit').val());
  dados.append('id', id);
  dados.append('op', 5);

 
  $.ajax({
    url: "src/controller/controllerUtilizador.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {

    $('#editUser').modal('hide');
    alert(msg);
    listaUser();
     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

listaUser();