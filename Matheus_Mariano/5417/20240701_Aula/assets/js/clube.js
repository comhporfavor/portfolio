function registaClube(){

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("nome", $('#nome').val());
    dados.append("anoFundacao", $('#anoFundacao').val());
    dados.append("telefone", $('#telefone').val());
    dados.append("email", $('#email').val());
    dados.append("localidade", $('#localidade').val());
    dados.append("logotipo", $('#logoClube').prop('files')[0]);

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

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Clubes",obj.msg,"success");
            getListaClubes();
        }else{
            alerta("Clubes",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getListaClubes(){

    if ( $.fn.DataTable.isDataTable('#tblClubes') ) {
        $('#tblClubes').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append("op", 2);


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

        $('#listagemClubes').html(msg);
        $('#tblClubes').DataTable();
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerClube(id){

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("id", id);

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

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Clubes",obj.msg,"success");
            getListaClubes();    
        }else{
            alerta("Clubes",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getDadosClube(id){


    let dados = new FormData();
    dados.append("op", 4);
    dados.append("id", id);

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

        let obj = JSON.parse(msg);
        $('#nomeEdit').val(obj.nome);    
        $('#nmClube').html(obj.nome);  
        $('#anoFundacaoEdit').val(obj.anoF);
        $('#telefoneEdit').val(obj.telefone);
        $('#emailEdit').val(obj.email);
        $('#localidadeEdit').val(obj.localidade);
        $('#logoAtual').attr('src', obj.logo);

       $('#btnGuardar').attr("onclick","guardaEditClube("+obj.id+")") 
        
       $('#formEditClube').modal('show')
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

    
}

function guardaEditClube(id){

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("nome", $('#nomeEdit').val());
    dados.append("anoFundacao", $('#anoFundacaoEdit').val());
    dados.append("telefone", $('#telefoneEdit').val());
    dados.append("email", $('#emailEdit').val());
    dados.append("localidade", $('#localidadeEdit').val());
    dados.append("logotipo", $('#logotipoEdit').prop('files')[0]);
    dados.append("id", id);

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

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Clube",obj.msg,"success");
            getListaClubes();
            $('#formEditClube').modal('hide')    
        }else{
            alerta("Clube",obj.msg,"error");    
        }
        
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
    getListaClubes();
});

