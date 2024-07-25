function calculaMedia(){

  let dados = new FormData();
  dados.append('nota1', $('#nota1').val());
  dados.append('nota2', $('#nota2').val());
  dados.append('nota3', $('#nota3').val());
  dados.append('op', 1);

 
  $.ajax({
    url: "src/controller/controllerScript.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);

    $('#nomeAlunoRes').html($('#nomeAluno').val()+" Estado: "+obj.estado);
    $('#media').val(obj.media)
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}


function calcularVelocidadeMedia(){
  let dados = new FormData();
  dados.append('distancia', $('#distancia').val());
  dados.append('tempo', $('#tempo').val());
  dados.append('op', 2);

 
  $.ajax({
    url: "src/controller/controllerScript.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
    let obj = JSON.parse(msg);

    $('#infoVelocidade').html(obj.informacao);
    $('#vm').val(obj.vm)
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

let veiculos = [];


function registarVeiculo(){

  if(veiculos.length < 10){
    veiculos.push([
      $('#matricula').val(), 
      $('#marca').val(),
      $('#kms').val()
    ]);
  }else{
    alert("limite de 10 veiculos atingidos");
  }
}


function listarVeiculos(){
  let dados = new FormData();
  dados.append('veiculos', JSON.stringify(veiculos));
  dados.append('op', 3);

 
  $.ajax({
    url: "src/controller/controllerScript.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#listagemVeiculos').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}