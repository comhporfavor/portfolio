let participantes = [];


function registaParticipante(){

  let dados = new FormData();
  dados.append('idade', $('#idade').val());
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
      if(!msg){
        if (participantes.length <= 15) {
          participantes.push([$('#nome').val(),$('#idade').val(),$('#workshop').val()]);
          alert("Participante Registado");
          console.log(participantes);
        }else{
          alert("Limite máximo de inscriuções atingido!");
        }   
      }else{
        alert("Participante sem idade minima");
      }
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}


function listagemParticipantes(){
  let dados = new FormData();
  dados.append('lista', JSON.stringify(participantes));
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
     $('#tableParticipantes').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function filtraTabela(workshop){
  let dados = new FormData();
  dados.append('lista', JSON.stringify(participantes));
  dados.append('workshop', workshop);
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
     $('#tableParticipantes').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}
