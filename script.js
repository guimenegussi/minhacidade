function initMap() {

        //CRIA O MAPA
		var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
       	  center: {lat: -25.979665, lng:-52.567116 }
		});

        //objeto de janela generico
        infoWindow = new google.maps.InfoWindow({maxWidth: 250});


        //CARREGA PONTOS PRÉ-EXISTENTES!
        pontos_BD(map);

        //quando clicar em algum lugar do mapa.....
        map.addListener('click', function(e) {
                //quando clicado, cria o ponto!
                //e.latLng é as coordenadas
                //antes de criar o ponto vou criar uma caixa de mensagem personalizada!
                var caixa = new google.maps.InfoWindow({
                    content: criar_caixa_registro(e.latLng),
                    maxWidth: 330
                });
                var ponto = new google.maps.Marker({
                    position: e.latLng,
                    map: map
                });
                map.panTo(e.latLng);
                //abre a caixa
                caixa.open(map, ponto);
                //quando clicado, também abre a caixa :()
                ponto.addListener('click', function() {
                    caixa.open(map, ponto);
                });

                // Evento que fecha a infoWindow com click no mapa.
                google.maps.event.addListener(map, 'click', function() {
                    infoWindow.close();
                    caixa.close();

                });

        });


}


function criar_caixa_registro(coordenadas){

  //html da caixa de informações!
  /*var form_registro =  '<div id="content">'+
                            '<center><h4><B> ALGUM PROBLEMA OU SUGESTÃO ?  </B></h4>'+
                            '<h6>'+coordenadas+'</h6></center>'+
                            '<hr/>'+
                            '<form method="post" action="registrar.php?coord='+coordenadas+'">'+
                              '<input type="text" name="titulo" required class="form-control" placeholder="Título da reclamação ou sugestão"><br/>'+
                              '<input type="text" name="nome" required class="form-control" placeholder="Nome Completo"><br/>'+
                              '<input type="email" name="email" class="form-control" placeholder="E-mail válido"><br/>'+
                              '<textarea name="comentarios" class="form-control" placeholder="Deixei aqui observações e comentários "></textarea><br/>'+
                              '<h5><b>Tirou uma foto? Ótimo, queremos ver!</b></h5>'+
                              '<input type="file" name="fotos[]"><br/>'+
                               '<h5><b>Selecione a categoria do registro: </b></h5>'+
                               '<select name="categoria" class="form-control">'+
                                '<option> Reclamação </option>'+
                                '<option> Sugestão </option>'+
                                '<option> Dúvida </option>'+
                              '</select><br/>'+
                              '<center><button type="submit" class="btn btn-success"><i class="fa fa-map-marker"></i> Registrar </button></center>'+

                            '</form>'+
                        '</div>';*/
  var form_registro =  '<div id="content">'+
                          '<center><h4><B> Crie um marcador para registrar uma reclamação, sugestão ou dúvida</B></h4>'+
                          '<a href="criar_marcador.php?coord='+coordenadas+'"><button class="btn btn-success"> Criar Marcador </button></a>'+
                       '</div>'
  return form_registro;
}
function criar_caixa_info(titulo, nome, comentarios, imagem, categoria){
  //html da caixa de informações!
  if(comentarios == ''){
      comentarios = "Esse marcador não possui observações e/ou comentários";
  }
  var info =  '<div id="content">'+
                            '<center><h3>'+titulo+'</h3></center>'+
                            '<hr/>'+
                            '<p><b>Comentários do marcador: </b>'+comentarios+'</p></br>'+
                            '<center><img src="'+imagem+'" width="130px"/><br/><a href="'+imagem+'" data-lightbox="Imagem-1" data-title="Clique fora da imagem para fechar">Clique para ampliar</a><br/><br/></center>'+                           
                            '<center><p><b>Criado por: </b>'+nome+' - <b>Categoria: </b>'+categoria+'</p><br/></center>'+
                        '</div>';
  return info;
}

function cria_pontos(latlng, titulo, nome, map, categoria, comentarios, imagem){
    var image;

    if(categoria == 'Reclamação'){
      image = 'imagens/reclamacao.png';
    }else if (categoria == 'Dúvida'){
      image = 'imagens/duvida.png';
    }else if (categoria == 'Sugestão'){
      image = 'imagens/sugestao.png';
    }else{
      image = 'imagens/estasendofeito.png';
    }

    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      title: titulo,
      icon: image
     });

   // Evento que dá instrução à API para estar alerta ao click no marcador.
   // Define o conteúdo e abre a Info Window.
   google.maps.event.addListener(marker, 'click', function() {

      // Variável que define a estrutura do HTML a inserir na Info Window.
      /*var iwContent = '<div id="iw_container">' +
      '<div class="iw_title">' + titulo + '</div>' +
      '<div class="iw_content">' + nome + '<br />' +
      '</div></div>';*/
      var iwContent = criar_caixa_info(titulo, nome, comentarios, imagem,categoria);

      // O conteúdo da variável iwContent é inserido na Info Window.
      infoWindow.setContent(iwContent);
     
      // A Info Window é aberta com um click no marcador.
      infoWindow.open(map, marker);
   });
}

function pontos_BD(map){

   //var bounds = new google.maps.LatLngBounds();

    $.ajax({
      type:'post',		//Definimos o método HTTP usado
      dataType: 'json',	//Definimos o tipo de retorno
      url: 'api_pontos.php',//Definindo o arquivo onde serão buscados os dados
      contentType: "text/plain",
      success: function(dados){
        for(var i=0;dados.length>i;i++){
          var lat = parseFloat(dados[i].lat);
          var lng = parseFloat(dados[i].lng);
          var latlng = new google.maps.LatLng(lat, lng);


          cria_pontos(latlng, dados[i].titulo, dados[i].nome, map, dados[i].categoria, dados[i].comentarios, dados[i].link);
          //bounds.extend(latlng);
             
        }
      }

    });

     //map.fitBounds(bounds);

}
