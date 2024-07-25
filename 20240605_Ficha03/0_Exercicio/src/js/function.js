let participantes = []; 

function registraParticipante() {
    let dados = new FormData();
    dados.append('idadeParticipante', $('#idadeParticipante').val());
    dados.append('op', 1);
  
    $.ajax({
        url: "src/controller/controllerScript.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(info) {
        if (!info) {
            alerta("Erro ao registrar participante", "danger", "error", "btn btn-danger");
        } else if (participantes.length < 15) {
            participantes.push([
                $('#nifParticipante').val(),
                $('#nomeParticipante').val(),
                $('#moradaParticipante').val(),
                $('#idadeParticipante').val(),
                $('#telefoneParticipante').val(),
                $('#workshop').val()
            ]);
            alerta("Participante registrado com sucesso", "success", "success", "btn btn-success");
            console.log(participantes);
        } else {
            alerta("Limite de participantes atingido", "danger", "error", "btn btn-danger");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}
  
function listarParticipantes(){
    let dados = new FormData();
    dados.append('participantes', JSON.stringify(participantes));
    dados.append('op', 2);

    $.ajax({
        url: "src/controller/controllerScript.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(txt) {
        if ($.fn.DataTable.isDataTable('#dataTParticipantes')) {
            $('#dataTParticipantes').DataTable().destroy();  
        }
        $('#listaParticipantes').html(txt);
        $('#dataTParticipantes').DataTable();
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function filtrarPorWorkshop(){
    let dados = new FormData();
    dados.append('participantes', JSON.stringify(participantes));
    dados.append('filtroWorkshop', $('#filtroWorkshop').val());
    dados.append('op', 3);

    $.ajax({
        url: "src/controller/controllerScript.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(txt) {
        $('#listaFiltradaParticipantes').html(txt);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });

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