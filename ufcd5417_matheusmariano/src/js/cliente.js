function addCliente() {
    let tipoCliente = $('#tipoCliente').val();
    if (!checkSelect(tipoCliente)){
        alerta("Selecione um tipo de cliente!", "Atenção!", 'error', 'btn btn-danger');
    } else {
        let dados = new FormData();
        dados.append("nif", $('#nif').val());
        dados.append("nome", $('#nome').val());
        dados.append("morada", $('#morada').val());
        dados.append("telefone", $('#telefone').val());
        dados.append("email", $('#email').val());
        dados.append('idade', $('#idade').val());
        dados.append('tipoCliente', tipoCliente);
        dados.append("op", 1);
        $.ajax({
            url: "src/controller/controllerClientes.php",
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
}

function listarClientes() {
    let dados = new FormData();
    dados.append("op", 2);
    $.ajax({
        url: "src/controller/controllerClientes.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function (msg) {
        if ($.fn.DataTable.isDataTable('#dataTClientes')) {
            $('#dataTClientes').DataTable().destroy();
          }
           $('#listaClientes').html(msg);
           $('#dataTClientes').DataTable();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Request failed: " + textStatus + ", " + errorThrown);
        alerta("Erro ao listar clientes: " + textStatus, 'Erro', 'error', 'btn btn-danger');
    });
}

function getInfoCliente(nif){
    let dados = new FormData();
    dados.append("nif", nif);
    dados.append('op', 3);
    $.ajax({
        url: "src/controller/controllerClientes.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done (function (msg) {
        let obj = JSON.parse(msg);
        $('#modalEdicaoCliente').modal('show');
        $('#nomeClienteHeader').html(obj.nome);
        $('#nifClienteEdit').val(obj.nif);
        $('#nomeClienteEdit').val(obj.nome);
        $('#moradaClienteEdit').val(obj.morada);
        $('#telefoneClienteEdit').val(obj.telefone);
        $('#emailClienteEdit').val(obj.email);
        $('#idadeClienteEdit').val(obj.idade);
        $('#selectTipoClienteEdit').val(obj.id_tipo);
        $('#btnGravaEditCliente').removeClass('btn-danger disabled').addClass('btn-success');
        $('#btnGravaEditCliente').attr("onclick",'gravarEdicaoCliente("'+obj.nif+'", "'+obj.email+'")');
    })
    .fail(function (jqXHR, textStatus) {
        console.log("Request failed: " + textStatus);
    });
}

function gravarEdicaoCliente(nif, oldEmail) {
    let tipoEdit = $('#selectTipoClienteEdit').val();
    if (!checkSelect(tipoEdit)){
        alerta("Selecione um tipo de cliente!", "Atenção!", 'error', 'btn btn-danger');
    } else {
        let dados = new FormData();
        dados.append("oldNif", nif);
        dados.append("nif", $('#nifClienteEdit').val());
        dados.append("nome", $('#nomeClienteEdit').val());
        dados.append("morada", $('#moradaClienteEdit').val());
        dados.append("telefone", $('#telefoneClienteEdit').val());
        dados.append("email", $('#emailClienteEdit').val());
        dados.append('oldEmail', oldEmail);
        dados.append('idade', $('#idadeClienteEdit').val());
        dados.append('tipoCliente', tipoEdit);
        dados.append("op", 4);
        $.ajax({
            url: "src/controller/controllerClientes.php",
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
            } else {
                alerta(msg, "Sucesso!",'success', 'btn btn-success');
                $('#modalEdicaoCliente').modal('hide');
                listarClientes();
            }
       })
       .fail(function (jqXHR, textStatus, errorThrown) {
            console.log("Request failed: " + textStatus + ", " + errorThrown);
            alerta("Erro ao gravar as alterações do cliente: " + textStatus, 'Erro', 'error', 'btn btn-danger');
        });
    }
}
// TESTE DE EDIÇÃO	