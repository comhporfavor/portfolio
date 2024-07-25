$(document).ready(function() {
    let whereAmI = location.pathname.split("/").pop(); // separar caminho para pegar o nome do arquivo

    let pagRegCliente = "registrar-clientes.php";
    let pagListCliente = "listar-clientes.php";
    let pagRegProdutos = "registrar-produtos.php";
    let pagListProdutos = "listar-produtos.php";
    let pagRegReservas = "registrar-reservas.php";
    let pagListReservas = "listar-reservas.php";
    let pagRegPedidos = "registrar-pedidos.php";
    let pagListarPedidos = "listar-pedidos.php";

    let atvPagina = 'active pagAtiva';

    function ativarMenu(dropdownId, itemId) {
        $(dropdownId).addClass(atvPagina);
        $(itemId).addClass(atvPagina);
    }

    switch (whereAmI) {
        case pagRegCliente:
            ativarMenu('#dropdownClientes', '#estouAquiRegClientes');
            getSelect('type_client', 'descricao', 'tipoCliente');
            break;
        case pagListCliente:
            ativarMenu('#dropdownClientes', '#estouAquiListClientes');
            listarClientes();
            getSelect('type_client', 'descricao', 'selectTipoClienteEdit');
            break;
        case pagRegProdutos:
            ativarMenu('#dropdownProdutos', '#estouAquiRegProdutos');
            getSelect('type_product', 'descricao', 'selectTipoProduto');
            break;
        case pagListProdutos:
            ativarMenu('#dropdownProdutos', '#estouAquiListProdutos');
            listarProdutos();
            break;
        case pagRegReservas:
            ativarMenu('#dropdownReservas', '#estouAquiRegReservas');
            break;
        case pagListReservas:
            ativarMenu('#dropdownReservas', '#estouAquiListReservas');
            break;
        case pagRegPedidos:
            ativarMenu('#dropdownPedidos', '#estouAquiRegPedidos');
            break;
        case pagListarPedidos:
            ativarMenu('#dropdownPedidos', '#estouAquiListarPedidos');
            break;
    }
});
