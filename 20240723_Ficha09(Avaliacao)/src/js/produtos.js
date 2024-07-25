function addProduto() {
    let dados = new FormData();
    dados.append('descricao', $('#nomeProduto').val());
    dados.append('valor', $('#precoProduto').val());
    dados.append('tipo', $('#selectTipoProduto').val());
    dados.append('img', $('#foto').prop('files')[0]);
    dados.append('stock', $('#estoque').val());
    dados.append('op', 1);
    $.ajax({   
        url: "src/controller/controllerProdutos.php",
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

function listarProdutos() {
    let dados = new FormData();
    dados.append('op', 2);
    $.ajax({
        url: "src/controller/controllerProdutos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function( msg ) {
        if ($.fn.DataTable.isDataTable('#dataTProdutos')) {
            $('#dataTProdutos').DataTable().destroy();
        }
        $('#listaProdutos').html(msg);
        $('#dataTProdutos').DataTable();
        console.log(msg);
    })
    .fail(function( jqXHR, textStatus ) {
        alerta("Request failed: " + textStatus, "Erro!", 'error', 'btn btn-danger');
    });
}