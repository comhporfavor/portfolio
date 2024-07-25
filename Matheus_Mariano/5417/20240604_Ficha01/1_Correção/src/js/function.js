function CalculaVolume(){

  let dados = new FormData();
  dados.append('areaBase', $('#areaBase').val());
  dados.append('altura', $('#altura').val());
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
    $('#resultado').val(msg)
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

function calculaExpressao(){
  let dados = new FormData();
  dados.append('x', $('#x').val());
  dados.append('y', $('#y').val());
  dados.append('z', $('#z').val());
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

    $('#resultado2').val(obj.resultado)
    $('#resultado3').val(obj.info)
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}

let conta = [];

function addSaldo(){

  if($('#qtd').val() <= 12 && $('#valor').val() >= 0){

    if(conta.length == $('#qtd').val()){
      alert("limite atingido")
    }else{
      conta.push($('#valor').val())
      console.log(conta);
    }

  }else{
    alert("Valor máximo 12");
  }
}

function calculaSaldo(){
  let soma = 0;

  for(let i = 0; i <conta.length; i++){
      soma += Number(conta[i]);
  }

  let dados = new FormData();
  dados.append('saldo', soma);
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

    $('#saldo').val(soma)
    $('#resultado5').val(msg)
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}


function calculaSaldo1(){

  let arr = JSON.stringify(conta);


  let dados = new FormData();
  dados.append('saldo', arr);
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

    let obj = JSON.parse(msg);

    $('#saldo').val(obj.saldo)
    $('#resultado5').val(obj.msg)
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}