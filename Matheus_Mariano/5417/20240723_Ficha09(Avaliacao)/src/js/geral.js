function getSelect(tabela, parametro, destino){
    let dados = new FormData();
    dados.append('op', 0);
    dados.append('tabela', tabela);
    dados.append('parametro', parametro);
    $.ajax({
        url: "src/controller/controllerGeral.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData:false,
    })
    .done(function( msg ) {
        $('#'+destino).html(msg);
    })
    .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
    });
}

function checkSelect(select) {
    let flag = true;
        if (select==-1){
            flag = false;
        }
    return flag;
}

function alerta(msg, titulo, icon, btnClass) {
    Swal.mixin({
        customClass: {
            confirmButton: btnClass,
        },
        buttonsStyling: true,
    }).fire({
        position: "center",
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp animate__faster'
        }
    });
}