function registaUser(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("username", $('#username').val());
    dados.append("password", $('#password').val());
    dados.append("tpUser", $('#tpUser').val());

    $.ajax({
    url: "assets/controller/controllerLogin.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Utilizador",obj.msg,"success");
        }else{
            alerta("Utilizador",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function login(){

    let dados = new FormData();
    dados.append("op", 2);
    dados.append("username", $('#usernameLogin').val());
    dados.append("password", $('#passwordLogin').val());

    $.ajax({
    url: "assets/controller/controllerLogin.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Utilizador",obj.msg,"success");
            
            setTimeout(function(){ 
                window.location.href = "main.php";
            }, 2000);

        }else{
            alerta("Utilizador",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function logout(){
    let dados = new FormData();
    dados.append("op", 3);

    $.ajax({
    url: "assets/controller/controllerLogin.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {


            alerta("Utilizador",msg,"success");
            
            setTimeout(function(){ 
                window.location.href = "index.html";
            }, 2000);
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getTipos(){
    let dados = new FormData();
    dados.append('op', 4);
  
   
    $.ajax({
      url: "assets/controller/controllerLogin.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData:false,
    })
    
    .done(function( msg ) {
  
     $('#tpUser').html(msg)
    })
    
    .fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
  
  }



function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,

      })
}

$(function() {
    getTipos();
  });