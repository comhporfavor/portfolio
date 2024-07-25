$(document).ready(function() {
    let whereAmI = location.pathname.split("/").pop(); // separar caminho para pegar o nome do arquivo

    let pagRegCliente = "registrar-clientes.php";
    let pagListCliente = "listar-clientes.php";
    let pagRegDestinos = "registrar-destinos.php";
    let pagListDestinos = "listar-destinos.php";
    let pagRegVoos = "registrar-voos.php";
    let pagListVoos = "listar-voos.php";
    let pagRegAgendamentos = "registrar-agendamentos.php";
    let pagListAgendamentos = "listar-agendamentos.php";

    let atvPagina = 'active pagAtiva';

    function ativarMenu(dropdownId, itemId) {
        $(dropdownId).addClass(atvPagina);
        $(itemId).addClass(atvPagina);
    }

    switch (whereAmI) {
        case pagRegCliente:
            ativarMenu('#dropdownClientes', '#estouAquiRegClientes');
            getSelect('tipo_cliente', 'descricao', 'tipoCliente');
            break;
        case pagListCliente:
            ativarMenu('#dropdownClientes', '#estouAquiListClientes');
            listarClientes();
            getSelect('tipo_cliente', 'descricao', 'selectTipoClienteEdit');
            break;   
        case pagRegDestinos:
            ativarMenu('#dropdownDestinos', '#estouAquiRegDestinos');
            break;
        case pagListDestinos:
            ativarMenu('#dropdownDestinos', '#estouAquiListDestinos');
            listarDestinos();
            break;
        case pagRegVoos:
            ativarMenu('#dropdownVoos', '#estouAquiRegVoos');
            getSelect('aviao', 'matricula', 'selectAviao');
            getSelect('destino', 'descricao', 'selectDestino');
            break;
        case pagListVoos:
            ativarMenu('#dropdownVoos', '#estouAquiListVoos');
            listarVoos();
            getSelect('aviao', 'matricula', 'selectAviaoEdit');
            getSelect('destino', 'descricao', 'selectDestinoEdit');
            break;
        case pagRegAgendamentos:
            ativarMenu('#dropdownAgendamentos', '#estouAquiRegAgendamentos');
            getSelect('cliente', 'nome', 'selectCliente');
            getSelect('voo', 'descricao', 'selectVoo');
            break;
        case pagListAgendamentos:
            ativarMenu('#dropdownAgendamentos', '#estouAquiListAgendamentos');
            getSelect('voo', 'descricao', 'filtroVoo');
            break;
        
    }
});
