function addPrato(){
    let dados = new FormData();
    dados.append('nome', $('#nomePrato').val());
    dados.append('preco', $('#preco').val());
    dados.append('tipoPrato', $('#selectTipoPrato').val());
    dados.append('foto', $('#foto').prop('files')[0]);
    dados.append('op', 1);
    $.ajax({
        url: "src/controller/controllerPratos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function( msg ) {
        alerta(msg, "Sucesso!", "success", 'btn btn-success');
    })
    .fail(function( jqXHR, textStatus ) {
        alerta("Request failed: " + textStatus + "<br>" + msg, "Erro!", 'error', 'btn btn-danger');
    });
}

function listarPratos(pagina) {
    let dados = new FormData();
    dados.append('op', 4);
    dados.append('pagina', pagina);
    $.ajax({
        url: "src/controller/controllerPratos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData:false,
      })
      .done(function( msg ) {
        if ($.fn.DataTable.isDataTable('#dataTPratos')) {
        $('#dataTPratos').DataTable().destroy();
        }
        $('#listaPratos').html(msg);
        $('#dataTPratos').DataTable();
      })
      .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
      });
}

function getInfoPrato(id){
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 2);
    $.ajax({
        url: "src/controller/controllerPratos.php",
        method: "POST",
        data: dados,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done (function (msg) {
        $('#modalEdicaoPrato').modal('show');
        $('#id').val(msg.id);
        $('#nomePratoEdit').val(msg.nome);
        $('#precoPratoEdit').val(msg.preco);
        $('#selectTipoPrato').val(msg.idTipo);
        $('#fotoPratoShow').attr('src', msg.foto);
        $('#btnGravaEditPrato').removeClass('btn-danger disabled').addClass('btn-success');
        $('#btnGravaEditPrato').attr("onclick",'gravarEdicaoPrato('+msg.id+')');
    })
    .fail(function (jqXHR, textStatus) {
        console.log("Request failed: " + textStatus);
    });
}

function gravarEdicaoPrato(id){
    let dados = new FormData();
    dados.append('id', id);
    dados.append('nome', $('#nomePratoEdit').val());
    dados.append('preco', $('#precoPratoEdit').val());
    dados.append('idTipo', $('#selectTipoPrato').val());
    dados.append('foto', $('#fotoPratoEdit').prop('files')[0]);
    dados.append('op', 3);
    $.ajax({
        url: "src/controller/controllerPratos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData:false,
    })
    .done(function( msg ) {
        alerta(msg, "Sucesso!", "success", 'btn btn-success');
        listarPratos(1);
    })
    .fail(function( jqXHR, textStatus ) {
        alerta("Request failed: " + textStatus + "<br>" + msg, "Erro!", 'error', 'btn btn-danger');
    });
    $('#modalEdicaoPrato').modal('hide');
    listarPratos(1);
}

function excluirPrato(id){
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 5);
    $.ajax({
        url: "src/controller/controllerPratos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function( msg ) {
        if (msg == "Registro excluído com sucesso.") {
            alerta(msg, "Sucesso!", "success", 'btn btn-success');
        } else {
            alerta(msg, "Error!", "error", 'btn btn-danger');
        }
        listarPratos(1);
    })
    .fail(function( jqXHR, textStatus ) {
        alerta("Request failed: " + textStatus, "Erro!", 'error', 'btn btn-danger');
    });
}

function addReserva(){
    let selectCliente = $('#selectCliente').val();
    let selectMesa = $('#selectMesa').val();
    let hora = $('#hora').val();
    if (checkSelect(selectCliente) && checkSelect(selectMesa) && checkSelect(hora)){
        let dados = new FormData();
        dados.append('selectCliente', selectCliente);
        dados.append('selectMesa', selectMesa);
        dados.append('data', $('#data').val());
        dados.append('hora', hora);
        dados.append('op', 1);
        $.ajax({
            url: "src/controller/controllerReservas.php",
            method: "POST",
            data: dados,
            dataType: "html",
            cache: false,
            contentType: false,
            processData:false,
        })
        .done(function( msg ) {
            if (msg == "Reserva efetuada com sucesso.") {
                alerta(msg, "Sucesso!", "success", 'btn btn-success');
            } else {
                alerta(msg, "Erro!", "error", 'btn btn-danger');
            }
        })
        .fail(function( jqXHR, textStatus ) {
            alerta("Request failed: " + textStatus, "Erro!", 'error', 'btn btn-danger');
        });
    } else if (!checkSelect(selectCliente)){
        alerta("Selecione um cliente!", "Atenção!", 'warning', 'btn btn-warning');
    } else if (!checkSelect(selectMesa)){
        alerta("Selecione uma mesa!", "Atenção!", 'warning', 'btn btn-warning');
    } else if (!checkSelect(hora)){
        alerta("Selecione uma hora!", "Atenção!", 'warning', 'btn btn-warning');
    }
}

function listarReservas(){
    let dados = new FormData();
    dados.append('op', 4);
    $.ajax({
        url: "src/controller/controllerReservas.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(msg) {
        if ($.fn.DataTable.isDataTable('#dataTReservas')) {
            $('#dataTReservas').DataTable().destroy();
        }
           $('#listaReservas').html(msg);
           $('#dataTReservas').DataTable();
    })
    .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
    });
}

function getInfoReserva(id){
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 2);
    $.ajax({
        url: "src/controller/controllerReservas.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done (function (msg) {
        msg = JSON.parse(msg);
        $('#modalEdicaoReserva').modal('show');
        $('#id').val(msg.idReserva);
        $('#clienteReserva').val(msg.nomeCliente);
        $('#mesaEdit').val(msg.nomeMesa);
        $('#dataReserva').val(msg.dataReserva);
        $('#horaEdit').val(msg.hora);
        $('#btnGravaEditReserva').removeClass('btn-danger disabled').addClass('btn-success');
        $('#btnGravaEditReserva').attr("onclick",'gravarEdicaoReserva(' +msg.idReserva+')');
    })
    .fail(function (jqXHR, textStatus) {
        console.log("Request failed: " + textStatus);
    });
}

function gravarEdicaoReserva(id){
    let dados = new FormData();
    dados.append('id', id);
    dados.append('dataReserva', $('#dataReserva').val());
    dados.append('hora', $('#horaEdit').val());
    dados.append('estado', $('#estadoEdit').val());
    dados.append('op', 3);
    $.ajax({
        url: "src/controller/controllerReservas.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function( msg ) {
        alerta(msg, "Sucesso!", "success", 'btn btn-success');
        listarReservas();
    })
    .fail(function( jqXHR, textStatus ) {
        alerta("Request failed: " + textStatus + "<br>", "Atenção!", 'error', 'btn btn-danger');
    });
}

function excluirReserva(id){
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 5);
    $.ajax({
        url: "src/controller/controllerReservas.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function( msg ) {
        let obj = JSON.parse(msg);
        if (obj[1]==1){
            alerta(obj[0], "Erro!", "error", 'btn btn-danger');
        } else {
            alerta(obj[0], "Sucesso!", "success", 'btn btn-success');
            listarReservas();
        }
    })
    .fail(function( jqXHR, textStatus ) {
        alerta("Request failed: " + textStatus, "Erro!", 'error', 'btn btn-danger');
    });
}

function getReservas(){
    let dados = new FormData();
    dados.append('op', 6);
    $.ajax({
        url: "src/controller/controllerReservas.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done (function (msg) {
        $('#selectReserva').html(msg);
    })
    .fail(function (jqXHR, textStatus) {
        console.log("Request failed: " + textStatus);
    });
}

function addPedido() {
    let pratosCheck = [];
    $('#listaPratos input[type="checkbox"]:checked').each(function() {
        pratosCheck.push($(this).val());
    });

    let dados = new FormData();
    dados.append('idReserva', $('#selectReserva').val());
    dados.append('pratos', JSON.stringify(pratosCheck)); 
    dados.append('op', 1);
    $.ajax({
        url: "src/controller/controllerPedidos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(msg) {
        console.log(msg);
        alerta(msg, "Sucesso!", "success", 'btn btn-success');
    })
    .fail(function(jqXHR, textStatus) {
        alerta("Request failed: " + textStatus + "<br>", "Atenção!", 'error', 'btn btn-danger');
    });
}

function listarPedidos(){
    let dados = new FormData();
    dados.append('op', 2);
    $.ajax({
        url: "src/controller/controllerPedidos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(msg) {
        if ($.fn.DataTable.isDataTable('#dataTPedidos')) {
            $('#dataTPedidos').DataTable().destroy();
        }
        $('#listaPedidos').html(msg);
        $('#dataTPedidos').DataTable();
    })
    .fail(function( jqXHR, textStatus ) {
        alerta( "Request failed: " + textStatus, "Erro!", 'error', 'btn btn-danger');
    });
}

function getInfoPedido(id){
    let dados = new FormData();
    dados.append('idPedido', id);
    dados.append('op', 3);
    $.ajax({
        url: "src/controller/controllerPedidos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done (function (msg) {
        msg = JSON.parse(msg);
        $('#modalEdicaoPedido').modal('show');
        $('#id').val(msg.idPedido);
        $('#mesaEdit').val(msg.nomeMesa);
        listarPratosPedido(id);
        $('#estadoEdit').val(msg.idEstado);
        $('#btnGravaEditPedido').removeClass('btn-danger disabled').addClass('btn-success');
        $('#btnGravaEditPedido').attr("onclick",'gravarEdicaoPedido('+msg.idPedido+')');
    })
    .fail(function (jqXHR, textStatus) {
        alerta("Request failed: " + textStatus, "Atenção!", 'error', 'btn btn-danger');
    });
}

function listarPratosPedido(idPedido){
    let dados = new FormData();
    dados.append('idPedido', idPedido);
    dados.append('op', 6);
    $.ajax({
        url: "src/controller/controllerPedidos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(msg) {
        $('#listaPratos').html(msg);
    })
    .fail(function( jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);
    });
}

function gravarEdicaoPedido(id){
    let dados = new FormData();
    dados.append('idPedido', id);
    dados.append('idEstado', $('#estadoEdit').val());
    dados.append('op', 4);
    $.ajax({
        url: "src/controller/controllerPedidos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(msg) {
        if (msg=="Pedido editado com sucesso"){
            alerta(msg, "Sucesso!", "success", 'btn btn-success');
        } else {
            alerta(msg, "Erro!", "error", 'btn btn-danger');
        }
        $('#modalEdicaoPedido').modal('hide');
        listarPedidos();
    })
    .fail(function(jqXHR, textStatus ) {
        alerta("Request failed: " + textStatus + "<br>", "Atenção!", 'error', 'btn btn-danger');
    });
}

function excluirPedido(id){
    let dados = new FormData();
    dados.append('idPedido', id);
    dados.append('op', 5);
    $.ajax({
        url: "src/controller/controllerPedidos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(msg) {
        if (msg=="Pedido excluído com sucesso"){
            alerta(msg, "Sucesso!", "success", 'btn btn-success');
        } else {
            alerta(msg, "Erro!", "error", 'btn btn-danger');
        }
        listarPedidos();
    })
    .fail(function(jqXHR, textStatus ) {
        alerta("Request failed: " + textStatus, "Erro!", 'error', 'btn btn-danger');
    });
}

function encerrarPedido(id) {
    let dados = new FormData();
    dados.append('idPedido', id);
    dados.append('op', 7);
    $.ajax({
        url: "src/controller/controllerPedidos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(response) {
        try {
            let msg = JSON.parse(response);
            if (msg.msg === "Pedido encerrado com sucesso") {
                alerta(msg.msg, "Sucesso!", "success", 'btn btn-success');
                abrirModalFatura(msg.txt); // Use a função para abrir o modal com os dados da fatura
            } else {
                alerta(msg.msg, "Erro!", "error", 'btn btn-danger');
            }
            listarPedidos();
        } catch (e) {
            console.error("Erro ao analisar resposta do servidor: ", e, response);
            alerta("Erro inesperado ao encerrar pedido.", "Erro!", 'error', 'btn btn-danger');
        }
    })
    .fail(function(jqXHR, textStatus) {
        alerta("Request failed: " + textStatus, "Erro!", 'error', 'btn btn-danger');
    });
}

function abrirModalFatura(dadosFatura) {
    if (typeof dadosFatura === 'string') {
        dadosFatura = JSON.parse(dadosFatura);
    }

    let txt = "";
    $('#idPedidoFatura').val(dadosFatura.idPedido);
    $('#mesaFatura').val(dadosFatura.nomeMesa);

    $.each(dadosFatura.pratos, function(index, prato) {
        txt += "<tr>";
        txt += "<td>" + (index + 1) + "</td>";
        txt += "<td>" + prato.nome + "</td>";
        txt += "<td>" + prato.preco.toFixed(2).replace('.', ',') + " €</td>";       
        txt += "</tr>";
    });
    $('#listaPratosFatura').html(txt);
    $('#total').val(dadosFatura.total.toFixed(2).replace('.', ',') + ' €');

    $('#modalFatura').modal('show');
}

