<!DOCTYPE html>
<html>
  <head>
    <title>Minha Cidade - Coronel Vivida/PR</title>
    
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta lang="pt-BR">
    <meta name="author" content="Guilherme Menegussi">
	  <meta name="description" content="Web App para registros de problemas na cidade de Coronel Vivida - PR">
	  <meta name="keywords" content="tecnologias sociais, coronel vivida">
    
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="lightbox.css">
    <link href='https://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      
      *{font-family: 'Sanchez', serif;}
      
      #map {
        position: relative;
        height: 700px; 
        width: 100%;
      }
      
      #header{
        position: relative;
        height: auto;
        background-color: #075e82;
      }
      
      .titulo{
        color: #fff; 
        font-family: 'Montserrat', sans-serif;
        padding: 8px;
      }
      .sub_titulo{
        color: #fff; 
        font-family: 'Montserrat', sans-serif;
      }
      
      .texto_rodape{
        color: #fff; 
        font-family: 'Montserrat', sans-serif;
        padding-top: 5px;
      }
      
      #footer{
        position: relative;
        height: 35px;
        background-color: #075e82;
      }
      
    </style>
  </head>
  <body>
    <div class="container-fluid">
        
      <div class="row">
          <div class="col-md-12 col-xs-12 col-xm-12" id="header">
            <center><h1 class="titulo"><i class="fa fa-map-o"></i> Minha Cidade </h1>
                    <p class="sub_titulo">Edição Coronel Vivida - PR</p>
            </center>              
          </div>  
      </div>
      
      <div class="row">
          <div id="map"></div>
      </div>
      
      <div class="row">
          <div class="col-md-12" id="footer">
            <center><p class="texto_rodape"><i class="fa fa-code"></i> Guilherme Menegussi </p></center>            
          </div>  
      </div>
    
    </div>    
    
    <script language="JavaScript" src="script.js"></script>
    <script language="JavaScript" src="lightbox.js"></script>
    <script src="lightbox-plus-jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYK6kUM2MlkezuknMA_qkzDtDsSzfHYOk&signed_in=true&callback=initMap"></script>
  </body>
</html>