function addDestino() {
    let dados = new FormData();
    dados.append('descricao', $('#descDestino').val());
    dados.append('localidade', $('#localDestino').val());
    dados.append('observacoes', $('#obsDestino').val());
    dados.append('valor', $('#valorDestino').val());    
    dados.append('img_capa', $('#imgDestino').prop('files')[0]);
    dados.append('op', 1);
    $.ajax({
        url: "src/controller/controllerDestinos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function (msg) {
        if (msg == "Cliente já existe!"){
            alerta(msg, "Aviso!", 'warning', 'btn btn-warning');
        } else if (msg == "Email já existe!"){
            alerta(msg, "Aviso!", 'warning', 'btn btn-warning');
        } else {
            alerta(msg, "Sucesso!", 'success', 'btn btn-success');
        }
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Request failed: " + textStatus + ", " + errorThrown);
        alerta("Erro ao adicionar cliente: " + textStatus, 'Erro', 'error', 'btn btn-danger');
    });
}

function listarDestinos() {
    let dados = new FormData();
    dados.append("op", 2);
    $.ajax({
        url: "src/controller/controllerDestinos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function (msg) {
        if ($.fn.DataTable.isDataTable('#dataTDestinos')) {
            $('#dataTDestinos').DataTable().destroy();
        }
        $('#listaDestinos').html(msg);
        $('#dataTDestinos').DataTable();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Request failed: " + textStatus + ", " + errorThrown);
        alerta("Erro ao listar Destinos: " + textStatus, 'Erro', 'error', 'btn btn-danger');
    });
}

function mostrarModalFoto(imgSrc, nomeLocal) {
    try {
        $('#modalFoto').modal('show');
        $('#imgLocal').attr('src', imgSrc);
        $('imgLocal').attr('alt', nomeLocal);
        $('#nomeLocal').html(nomeLocal);
    } catch (e) {
        console.error('Erro ao mostrar modal de foto:', e);
    }
} 