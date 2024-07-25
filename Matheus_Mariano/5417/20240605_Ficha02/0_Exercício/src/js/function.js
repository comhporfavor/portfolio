function calculaMedia() {
    let dados = new FormData();
    dados.append('nomeAluno', $('#nomeAluno').val());
    dados.append('nota1', $('#nota1').val());
    dados.append('nota2', $('#nota2').val());
    dados.append('nota3', $('#nota3').val());
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
        let obj;
        try {
            obj = JSON.parse(info);
        } catch (e) {
            alert("Erro ao processar resposta do servidor: " + info);
            return;
        }
        $('#infoAluno').val(obj.nomeAluno);
        $('#media').val(obj.resultado);
        if (obj.info == "Aprovado") {
            alerta(obj.info, "Aprovado", "success", "btn btn-success");
        } else {
            alerta(obj.info, "Reprovado", "error", "btn btn-danger");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
  }
  
  function calculaVelocidade() {
    let dados = new FormData();
    dados.append('dist', $('#dist').val());
    dados.append('tempo', $('#tempo').val());
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
    .done(function(resposta) {
        let obj;
        try {
            obj = JSON.parse(resposta);
        } catch (e) {
            alert("Erro ao processar resposta do servidor: " + resposta);
            return;
        }
        $('#vel').val(obj.velocidade);
        $('#coment').val(obj.comentario);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
  }

  let veiculos = [];
  
  function registrarVeiculo() {
    if (veiculos.length <= 10) {
        veiculos.push([
            $('#matricula').val(),
            $('#marca').val(),
            $('#kmsVeic').val()
        ]);
        alerta ("Veículo registrado com sucesso!", "Sucesso", "success", "btn btn-success");
    } else {
        alerta("Limite de veículos atingido!", "Erro", "error", "btn btn-danger");
    }   
  }
  
  function listarVeiculos() {
    let dados = new FormData();
    dados.append('veiculos', JSON.stringify(veiculos));
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
    .done(function(info) {
        let obj;
        try {
            obj = JSON.parse(info);
        } catch (e) {
            alert("Erro ao processar resposta do servidor: " + info);
            return;
        }
        if ($.fn.DataTable.isDataTable('#dataTVeiculos')) {
            $('#dataTVeiculos').DataTable().destroy();  
        }   
        $('#listaVeiculos').html(obj.lista);
        $('#totalKms').html(obj.totalKms);
        $('#dataTVeiculos').DataTable();
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
  