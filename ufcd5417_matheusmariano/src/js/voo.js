function addVoo() {
    let id_aviao = $('#selectAviao').val();
    let id_destino = $('#selectDestino').val();
    let estado = $('#estadoVoo').val();
    if (!checkSelect(id_aviao)){
        alerta("Selecione um Avião!", "Atenção!", 'error', 'btn btn-danger');
    } else if (!checkSelect(id_destino)){
        alerta("Selecione um Destino!", "Atenção!", 'error', 'btn btn-danger');
    } else if (!checkSelect(estado)){
        alerta("Selecione um Estado!", "Atenção!", 'error', 'btn btn-danger');
    } else {
        let dados = new FormData();
        dados.append('descricao', $('#descVoo').val());
        dados.append("id_aviao", id_aviao);
        dados.append("id_destino", id_destino);
        dados.append("estado", estado);
        dados.append("op", 1);
        $.ajax({
            url: "src/controller/controllerVoos.php",
            method: "POST",
            data: dados,
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function (msg) {
            alerta(msg, "Sucesso!", 'success', 'btn btn-success');
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log("Request failed: " + textStatus + ", " + errorThrown);
            alerta("Erro ao adicionar Voo: " + textStatus, 'Erro', 'error', 'btn btn-danger');
        });
    }
}

function listarVoos() {
    let dados = new FormData();
    dados.append("op", 2);
    $.ajax({
        url: "src/controller/controllerVoos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function (msg) {
        if ($.fn.DataTable.isDataTable('#dataTVoos')) {
            $('#dataTVoos').DataTable().destroy();
          }
           $('#listaVoos').html(msg);
           $('#dataTVoos').DataTable();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Request failed: " + textStatus + ", " + errorThrown);
        alerta("Erro ao listar Voos: " + textStatus, 'Erro', 'error', 'btn btn-danger');
    });
}

function getInfoVoo(id){
    let dados = new FormData();
    dados.append("id", id);
    dados.append('op', 3);
    $.ajax({
        url: "src/controller/controllerVoos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done (function (msg) {
        let obj = JSON.parse(msg);
        $('#modalEdicaoVoo').modal('show');
        $('#idVooEdit').val(obj.id);
        $('#descVooEdit').val(obj.descricao);
        $('#selectAviaoEdit').val(obj.aviaoVoo);
        $('#selectDestinoEdit').val(obj.destinoVoo);
        $('#estadoVooEdit').val(obj.estado);
        $('#btnGravaEditVoo').removeClass('btn-danger disabled').addClass('btn-success');
        $('#btnGravaEditVoo').attr("onclick",'gravarEdicaoVoo('+obj.id+')');
    })
    .fail(function (jqXHR, textStatus) {
        console.log("Request failed: " + textStatus);
    });
}

function gravarEdicaoVoo(id) {
    let id_aviao = $('#selectAviaoEdit').val();
    let id_destino = $('#selectDestinoEdit').val();
    let estado = $('#estadoVooEdit').val();
    if (!checkSelect(id_aviao)){
        alerta("Selecione um Avião!", "Atenção!", 'error', 'btn btn-danger');
    } else if (!checkSelect(id_destino)){
        alerta("Selecione um Destino!", "Atenção!", 'error', 'btn btn-danger');
    } else if (!checkSelect(estado)){
        alerta("Selecione um Estado!", "Atenção!", 'error', 'btn btn-danger');
    } else {
        let dados = new FormData();
        dados.append("id", id);
        dados.append("descricao", $('#descVooEdit').val());
        dados.append("id_aviao",id_aviao);
        dados.append("id_destino", id_destino);
        dados.append("estado", estado);
        dados.append("op", 4);
        $.ajax({
            url: "src/controller/controllerVoos.php",
            method: "POST",
            data: dados,
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
        })
       .done(function (msg) {
            alerta(msg, "Sucesso!",'success', 'btn btn-success');
            $('#modalEdicaoVoo').modal('hide');
            listarVoos();
       })
       .fail(function (jqXHR, textStatus, errorThrown) {
            console.log("Request failed: " + textStatus + ", " + errorThrown);
            alerta("Erro ao gravar as alterações do Voo: " + textStatus, 'Erro', 'error', 'btn btn-danger');
        });
    }
}

function excluirVoo(id) {
    let dados = new FormData();
    dados.append("id", id);
    dados.append('op', 5);
    $.ajax({
        url: "src/controller/controllerVoos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function (msg) {
        if (msg == "Voo excluído com sucesso."){
            alerta(msg, "Sucesso!",'success', 'btn btn-success');
        } else {
            alerta(msg, "Erro!", 'error', 'btn btn-danger');
        }
        listarVoos();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Request failed: " + textStatus + ", " + errorThrown);
        alerta("Erro ao excluir o Voo: " + textStatus, 'Erro', 'error', 'btn btn-danger');
    });
}