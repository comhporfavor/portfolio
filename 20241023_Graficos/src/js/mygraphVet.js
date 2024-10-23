let graficoBarrasVet = "";
let graficoLinhasVet = "";

function lineVet(veterinarios, datas) {
  let data = {
    labels: datas,
    datasets: [{
      label: 'Preços',
      backgroundColor: 'rgb(255, 255, 132)',
      borderColor: 'rgb(255, 99, 1)',
      data: veterinarios,
    }]
  };

  let graph = {
    type: 'line',
    data,
    options: {}
  };


  if (graficoLinhasVet == "") {
    graficoLinhasVet = new Chart($('#line'), graph);
  } else {
    graficoLinhasVet.destroy();
    graficoLinhasVet = new Chart($('#line'), graph);
  }
}

function bar(precos, datas) {

  let label = 'Total Orçamentos';

  const data = {
    labels: datas,
    datasets: [{
      label: label,
      data: precos,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const graph = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  if (graficoBarras == "") {
    graficoBarras = new Chart($('#bar'), graph);
  } else {
    graficoBarras.destroy();
    graficoBarras = new Chart($('#bar'), graph);
  }


}

$(function () {

  //grafico de Linhas
  linhas(157)

  //grafico de barras
  barras(2021);

  //selects
  getSelect('veterinario', 'id', 'selectVeterinario');
  getSelect('animal', 'chip', 'selectAnimal');

});

function linhasVet(veterinario) {

  $.ajax({
    url: "src/controller/controllerGrafico.php",
    method: "POST",
    data: { 
      op: 1,
      veterinario: veterinario
    }
  })

    .done(function (resposta) {
      let obj = JSON.parse(resposta)

      let veterinarios = [];
      let datas = [];

      for (let veterinario of obj.veterinarios) {
        veterinarios.push(veterinario);
      }

      for (let data of obj.datas) {
        datas.push(data);
      }

      line(precos, datas);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}

function barrasVet(ano) {
  $.ajax({
    url: "src/controller/controllerGrafico.php",
    method: "POST",
    data: {
      op: 2,
      ano
    }
  })

    .done(function (resposta) {
      let obj = JSON.parse(resposta)

      
      let meses = ["Janeiro", "Fevereiro", "Março", "Abril",
        "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]

      bar(obj.total, meses);

    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}

function getSelect(tabela, parametro, destino){

  $.ajax({
    url: "src/controller/controllerVet.php",
    method: "POST",
    data: {
      op: 1,
      tabela: tabela,
      parametro: parametro,
    }
  })
   
  .done(function( resposta ) {
    $('#' + destino).html(resposta);
  })
   
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });

}



