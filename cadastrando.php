<?php

	if(isset($_POST['registrar'])){

		include 'conexao.php';
       
        $coordenadas = $_POST['coord'];
        $titulo = $_POST['titulo'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $categoria = $_POST['categoria'];
        $comentarios = $_POST['comentarios'];
        
        //bem, antes de tudo vamos arrumar esse formato e coordenada
        //formato legal =  {lat: -25.979689328057756, lng: -52.57786273956299},
        $obj = ',';
        $tam = strlen($coordenadas);
        $posicao_virgula = strpos($coordenadas, $obj);
        $lat = substr($coordenadas, 1, $posicao_virgula-1);
        $lng = substr($coordenadas, $posicao_virgula+1, $tam);
        $lng = substr($lng,0,-1);

	 	

	 	//inserindo
		$query = "INSERT INTO reclamacoes (titulo, nome, email, comentarios, lat, lng, categoria) 
		values('".$titulo."','".$nome."','".$email."','".$comentarios."', '".$lat."','".$lng."','".$categoria."')";

		 $exec = $conexao->exec($query);

		 //recuperando o id inserindo para usar no cadastro das imagens.
		 $id_inserido = $conexao->lastInsertId();



		 //-------------PARTE DAS IMAGENS!!!!---------------//
		
		//informacoes das imagens
		$file = $_FILES['fotos'];

		//quantas imagens eu tenho?
		$num_img = count(array_filter($file['name']));

		//pasta das imagens
		$pasta = 'fotos';

		//requisitos
		$permite = array('image/jpeg', 'image/png');
		$tamanho_maximo = 1024 * 1024 * 5;

		//MENSAGEM
		$msg = array();
		$erroMsg = array(
			1 => 'O arquivo é maior que o limite',
			2 => 'O arquivo é muito grande',
			3 => 'Upload parcialmente',
			4 => 'Nao foi feito o upload'
		);

		$aux  = 0;


			for($i = 0; $i < $num_img; $i++){

				$name = $file['name'][$i];
				$type = $file['type'][$i];
				$size = $file['size'][$i];
				$error = $file['error'][$i];
				$tmp = $file['tmp_name'][$i];

				$extensao = @end(explode('.', $name));


				$novoNome = rand().".$extensao";

				//SE FOR DIFERENTE DE 0 TEM ERRO!
				if($error != 0){
					$msg[] = "<b>$name: </b>".$erroMsg[$error];
				}
				else if(!in_array($type, $permite)){
					$msg[] = "<b>$name: </b> Imagem não suportada";
				}
				else if($size > $tamanho_maximo){
					$msg[] = "<b>$name: </b> Imagem maior que 5mb";
				}
				else{
					//se tiver tudo ok..vamos jogar para pasta!
					// e posteriormente no BD
					if(move_uploaded_file($tmp, $pasta."/".$novoNome)){
						//vou agora armazenar no banco de dados das imagens

						$link = $pasta."/".$novoNome;

						//   INICIO DA REDIMENSIONALIZAÇÃO
								# Caminho da imagem a ser redimensionada: 
								$input_image = $link;
								 
								// Pega o tamanho original da imagem e armazena em um Array:
								$size = getimagesize($input_image);
								 
								// Configura a nova largura da imagem:
								$thumb_width = "500";
								 
								// Calcula a altura da nova imagem para manter a proporção na tela: 
								$thumb_height = "500";
								 
								// Cria a imagem com as cores reais originais na memória.
								$thumbnail = ImageCreateTrueColor($thumb_width,$thumb_height);
								 
								// Criará uma nova imagem do arquivo.
								if(($extensao == 'png') || ($extensao == 'PNG')){
									$src_img = ImageCreateFromPNG($input_image );
								}
								else if(($extensao =='jpg') || ($extensao =='jpeg') || ($extensao == 'JPG')){
									$src_img = ImageCreateFromJPEG($input_image );
								}
								
								 
								// Criará a imagem redimensionada:
								ImageCopyResampled( $thumbnail, $src_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $size[0], $size[1] );
								 
								// Informe aqui o novo nome da imagem e a localização:
								ImageJPEG($thumbnail, $link, 100);
								 
								// Limpa da memoria a imagem criada temporáriamente: 
								ImageDestroy($thumbnail );

						// FIM DA REDIMENSIONALIZAÇÃO !!
						
						//INSERIR imagem no banco!
						//inserindo
						$query = "UPDATE reclamacoes SET link='".$link."' WHERE id='".$id_inserido."'"; 

						 $exec = $conexao->exec($query);						

						$aux++;
                        
						$msg[] = "<b>$name: </b> Upload realizado com sucesso!";
					}
					else{
						$msg[] = "<b>$name: </b> Desculpe..Ocorreu um erro!";
				 	}

				}
				/*foreach ($msg as $pop) {
					echo $pop.'<br/>';
				}*/
			}

      

		if($aux != $num_img) {
			//se não conseguiu armazenar todas as imagens!
			//deleta as imagens e deleta as 'info' das sessoes!

			$query = "DELETE FROM  reclamacoes WHERE id = '$id_inserido'"; 
			$exec = $conexao->exec($query);

			/*$query = "DELETE FROM  tbl_fotos WHERE id_produto = '$id_inserido'"; 
			$exec = $conexao->exec($query);*/


			echo "	
                <center>		
                    <button type='button' class='btn btn-danger'>
                        <h5>Ocorreu algum erro! Pode ser:<br/></h5>
                        <h6>1) Alguma imagem com mais de 5mb <br/>
                        2) Extensão de alguma imagem difere de .jpg/jpeg e .png <br/>
                        3) Upload incompleto de alguma imagem <br/></h6>
					</button>
                 </center><br/>			
			";

		}
		else{
			echo"
            <center>
                <button type='button' class='btn btn-success'>
                    <h4>Obrigado! O marcador já está no mapa.</h4>									
                </button>
            </center><br/>
			";
		}
	 }
    

?>