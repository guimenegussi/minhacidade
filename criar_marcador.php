<?php
    $coordenadas = $_GET['coord'];
?>
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
    <link href='https://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>

    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      *{font-family: 'Sanchez', serif;}


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
        bottom: 0px;
        width: 100%;
      }

      #form_marcador{
          position: relative;
          width: 100%;
          border-radius: 5px;
          border: solid 2px #888;
          box-shadow: 10px 10px 5px #888888;
      }
      .form{
          position: relative;
          width: 90%;
          margin: 0px auto;
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
          <div class="col-md-6 col-md-offset-3">
              <br/>
              <div id="form_marcador">
                 <div class="form">
                    <br/>
                
                  <form action="" method="post" enctype="multipart/form-data">
                    <p> <b>Coordenadas do marcador: </b><?php echo $coordenadas ?></p>
                    <input type="hidden" name="coord" value="<?php echo $coordenadas ?>"/>
                    <input type="text" name="titulo" required class="form-control" placeholder="Título da reclamação ou sugestão"><br/>
                    <input type="text" name="nome" required class="form-control" placeholder="Nome Completo"><br/>
                    <input type="email" name="email" class="form-control" placeholder="E-mail válido"><br/>
                    <textarea name="comentarios" class="form-control" placeholder="Deixei aqui observações e comentários "></textarea><br/>
                    <h5><b>Tirou uma foto? Ótimo, queremos ver!</b></h5>
                    <input type="file"  name="fotos[]"><br/>
                    <h5><b>Selecione a categoria do registro: </b></h5>
                    <select name="categoria" class="form-control">
                        <option> Reclamação </option>
                        <option> Sugestão </option>
                        <option> Dúvida </option>
                    </select><br/>
                    <input type="checkbox" required name="termos" value="sim"> <b>Eu concordo com os termos de uso.</b><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ornare erat, a hendrerit dui. Cras lacinia nisi neque, nec blandit dolor lacinia vel. Pellentesque id pellentesque quam, rutrum molestie libero. Donec nec feugiat nisi. Nunc sed purus a magna cursus feugiat id a metus. Aliquam tristique laoreet fermentum. </p><br/>
                    <center>

                        <a href="index.php"><button type="button" class="btn btn-primary"><i class="fa fa-arrow-circle-o-left"></i> Voltar </button></a>
                        <button type="submit" name="registrar" class="btn btn-success"><i class="fa fa-map-marker"></i> Registrar </button>
                               
                    </center>
                 </form>
                    <br/>
                 <?php include "cadastrando.php"; ?>
                </div>
              </div>
              <br/>
          </div>
      </div>


      <div class="row">
          <div class="col-md-12" id="footer">
            <center><p class="texto_rodape"><i class="fa fa-code"></i> Guilherme Menegussi </p></center>
          </div>
      </div>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.js"></script>

  </body>
</html>
