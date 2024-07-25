$(document).ready(function() {
    let whereAmI = location.pathname;

    let pagRegCliente = "/Matheus_Mariano/5417/20240703_Ficha08(Avaliacao)/registrar-clientes.php";
    let pagListCliente = "/Matheus_Mariano/5417/20240703_Ficha08(Avaliacao)/listar-clientes.php";
    let pagRegPratos = "/Matheus_Mariano/5417/20240703_Ficha08(Avaliacao)/registrar-pratos.php";
    let pagListPratos = "/Matheus_Mariano/5417/20240703_Ficha08(Avaliacao)/listar-pratos.php";
    let pagRegReservas = "/Matheus_Mariano/5417/20240703_Ficha08(Avaliacao)/registrar-reservas.php";
    let pagListReservas = "/Matheus_Mariano/5417/20240703_Ficha08(Avaliacao)/listar-reservas.php";
    let pagRegPedidos = "/Matheus_Mariano/5417/20240703_Ficha08(Avaliacao)/registrar-pedidos.php";
    let pagListarPedidos = "/Matheus_Mariano/5417/20240703_Ficha08(Avaliacao)/listar-pedidos.php";

    let atvPagina = 'active pagAtiva';

    function ativarMenu(dropdownId, itemId) {
        $(dropdownId).addClass(atvPagina);
        $(itemId).addClass(atvPagina);
    }

    if ([pagRegCliente, pagListCliente].includes(whereAmI)) {
        ativarMenu('#dropdownClientes', {
            [pagRegCliente]: '#estouAquiRegClientes',
            [pagListCliente]: '#estouAquiListClientes'
        }[whereAmI]);
    }
    
    if (whereAmI == pagListCliente) {
        listarClientes();
    }

    if ([pagRegPratos, pagListPratos].includes(whereAmI)) {
        ativarMenu('#dropdownPratos', {
            [pagRegPratos]: '#estouAquiRegPratos',
            [pagListPratos]: '#estouAquiListPratos'
        }[whereAmI]);
    }
    
    if (whereAmI == pagRegPratos || whereAmI == pagListPratos){
        getSelect('tipoprato', 'descricao', 'selectTipoPrato');
    }

    if ([pagRegReservas, pagListReservas].includes(whereAmI)) {
        ativarMenu('#dropdownReservas', {
            [pagRegReservas]: '#estouAquiRegReservas',
            [pagListReservas]: '#estouAquiListReservas'
        }[whereAmI]);
    }
    
    if (whereAmI==pagRegReservas){
        getSelect('clientes', 'nome', 'selectCliente');
        getSelect('mesas', 'nome', 'selectMesa');
    }

    if (whereAmI==pagListReservas){
        alert('Para editar reserva, clique no botão do Estado na lista.');
        listarReservas();
        getSelect('estadoreserva', 'descricao', 'estadoEdit');
    }

    if ([pagRegPedidos, pagListarPedidos].includes(whereAmI)) {
        ativarMenu('#dropdownPedidos', {
            [pagRegPedidos]: '#estouAquiRegPedidos',
            [pagListarPedidos]: '#estouAquiListPedidos'
        }[whereAmI]);
    }
    if ([pagListPratos].includes(whereAmI)) {
        listarPratos(1);
    }
    if (whereAmI == pagRegPedidos){
        getReservas();
        listarPratos(2);
    }
    if (whereAmI==pagListarPedidos){
        alert('Para editar o pedido, clique no botão do Estado na lista.');
        listarPedidos();
        getSelect('estadoPedido', 'descricao', 'estadoEdit');
    }
});
