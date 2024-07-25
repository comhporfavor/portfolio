function addAgendamento() {
    let id_cliente = $('#selectCliente').val();
    let id_voo = $('#selectVoo').val();
    let qtd_passageiros = $('#qtdPassageiros').val();
    if (!checkSelect(id_cliente)){
        alerta("Selecione um Avião!", "Atenção!", 'error', 'btn btn-danger');
    } else if (!checkSelect(id_voo)){
        alerta("Selecione um Voo!", "Atenção!", 'error', 'btn btn-danger');
    } else if (qtd_passageiros<1){
        alerta("Quantidade de passageiros não pode ser inferior a um!", "Atenção!", 'error', 'btn btn-danger');
    } else {
        let dados = new FormData();
        dados.append('id_cliente', id_cliente);
        dados.append("id_voo", id_voo);
        dados.append("qtd_passageiros", qtd_passageiros);
        dados.append("valor_total", 0);
        dados.append("op", 1);
        $.ajax({
            url: "src/controller/controllerAgendamentos.php",
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
            alerta("Erro ao adicionar Agendamento: " + textStatus, 'Erro', 'error', 'btn btn-danger');
        });
    }
}

function listarAgendamentos(id_voo) {
    let dados = new FormData();
    dados.append('id_voo', id_voo);
    dados.append("op", 2);
    $.ajax({
        url: "src/controller/controllerAgendamentos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function (msg) {
        if ($.fn.DataTable.isDataTable('#dataTAgendamentos')) {
            $('#dataTAgendamentos').DataTable().destroy();
          }
           $('#listaAgendamentos').html(msg);
           $('#dataTAgendamentos').DataTable();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Request failed: " + textStatus + ", " + errorThrown);
        alerta("Erro ao listar Agendamentos: " + textStatus, 'Erro', 'error', 'btn btn-danger');
    });
}

function getInfoAgendamento(id){
    let dados = new FormData();
    dados.append("id", id);
    dados.append('op', 3);
    $.ajax({
        url: "src/controller/controllerAgendamentos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done (function (msg) {
        let obj = JSON.parse(msg);
        $('#modalEdicaoAgendamento').modal('show');
        $('#idAgendamentoEdit').val(obj.id);
        $('#descAgendamentoEdit').val(obj.descricao);
        $('#selectAviaoEdit').val(obj.aviaoAgendamento);
        $('#selectDestinoEdit').val(obj.destinoAgendamento);
        $('#estadoAgendamentoEdit').val(obj.estado);
        $('#btnGravaEditAgendamento').removeClass('btn-danger disabled').addClass('btn-success');
        $('#btnGravaEditAgendamento').attr("onclick",'gravarEdicaoAgendamento('+obj.id+')');
    })
    .fail(function (jqXHR, textStatus) {
        console.log("Request failed: " + textStatus);
    });
}

function excluirAgendamento(id) {
    let dados = new FormData();
    dados.append("id", id);
    dados.append('op', 5);
    $.ajax({
        url: "src/controller/controllerAgendamentos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function (msg) {
        if (msg == "Agendamento excluído com sucesso."){
            alerta(msg, "Sucesso!",'success', 'btn btn-success');
        } else {
            alerta(msg, "Erro!", 'error', 'btn btn-danger');
        }
        listarAgendamentos();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Request failed: " + textStatus + ", " + errorThrown);
        alerta("Erro ao excluir o Agendamento: " + textStatus, 'Erro', 'error', 'btn btn-danger');
    });
}
