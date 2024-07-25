function registaJogador(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("numJogador", $('#numJogador').val());
    dados.append("nome", $('#nome').val());
    dados.append("idade", $('#idade').val());
    dados.append("telefone", $('#telefone').val());
    dados.append("email", $('#email').val());
    dados.append("morada", $('#morada').val());
    dados.append("clube", $('#clubeJogador').val());
    dados.append("foto", $('#fotoJogador').prop('files')[0]);

    $.ajax({
    url: "assets/controller/controllerJogador.php",
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
            alerta("Jogador",obj.msg,"success");
            getListaJogadores();
        }else{
            alerta("Jogador",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getListaJogadores(){

    if ( $.fn.DataTable.isDataTable('#tblJogador') ) {
        $('#tblJogador').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 2);


    $.ajax({
    url: "assets/controller/controllerJogador.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        $('#listagemJogador').html(msg);
        $('#tblJogador').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerJogador(num){

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("num", num);

    $.ajax({
    url: "assets/controller/controllerJogador.php",
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
            alerta("Jogador",obj.msg,"success");
            getListaJogadores();    
        }else{
            alerta("Jogador",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getDadosJogador(numOld){


    let dados = new FormData();
    dados.append("op", 4);
    dados.append("num", numOld);

    $.ajax({
    url: "assets/controller/controllerJogador.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);

        $('#numJogadorEdit').val(obj.num);    
        $('#nomeEdit').val(obj.nome);  
        $('#idadeEdit').val(obj.idade);
        $('#telefoneEdit').val(obj.tel);
        $('#emailEdit').val(obj.email);
        $('#clubeJogadorEdit').val(obj.idclube);
        $('#moradaEdit').val(obj.morada);
        $('#fotoAtual').attr('src', obj.foto);

        

       $('#btnGuardar').attr("onclick","guardaEditJogador("+numOld+")") 
        
       $('#formEditJogador').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditJogador(numOld){

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("numJogador", $('#numJogadorEdit').val());
    dados.append("nome", $('#nomeEdit').val());
    dados.append("idade", $('#idadeEdit').val());
    dados.append("telefone", $('#telefoneEdit').val());
    dados.append("email", $('#emailEdit').val());
    dados.append("clube", $('#clubeJogadorEdit').val());
    dados.append("morada", $('#moradaEdit').val());
    dados.append("foto", $('#fotoJogadorEdit').prop('files')[0]);
    dados.append("numOld", numOld);

    $.ajax({
    url: "assets/controller/controllerJogador.php",
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
            alerta("Jogador",obj.msg,"success");
            getListaJogadores();
            $('#formEditJogador').modal('hide')    
        }else{
            alerta("Jogador",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });


}


function getSelectClubes(){

    let dados = new FormData();
    dados.append("op", 6);


    $.ajax({
    url: "assets/controller/controllerClube.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {
        $('#clubeJogadorEdit').html(msg); 
        $('#clubeJogador').html(msg);  
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

function erroPermissao(){
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: "Sem permissão!",
        text: "Não pode aceder a este conteudo",
        showConfirmButton: true,

      })
}


$(function() {
    getListaJogadores();
    getSelectClubes();
    $('#clubeJogadorEdit').select2();

    $('#clubeJogadorEdit').select2({
        dropdownParent: $('#formEditJogador')
    });
});

