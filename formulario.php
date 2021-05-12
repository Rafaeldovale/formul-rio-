<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario cadastro</title>
</head>
<body>
    <div id="form">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
        Nome : <input type="text" name="nome"><br>
        Idade : <input type="text" name="idade"><br>
        Email : <input type="text" name="email" ><br>
        Peso : <input type="text" name="peso"><br>
        <input type="file" name="arquivo"><br>
        
        <button type="submit" name="Enviar-formulario"> enviar</button><br>
        </form>
    </div>
    
    <?php
        if(isset($_POST['Enviar-formulario'])):
            $erros=array();
            $formatoPermitido = array("png","jpeg","jpg","gif");
            
            
                if(!$idade = filter_input(INPUT_POST,'idade',FILTER_VALIDATE_INT)):
                    $erros[]="Idade precisa ser inteiro";
                endif;
                    if(!$email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)):
                        $erros[]="Email inválido";
                    endif;
                        if(!$peso = filter_input(INPUT_POST,'idade',FILTER_VALIDATE_FLOAT)):
                            $erros[]="Idade precisa ser Float";
                        endif;
        endif;

        //Exebindo Mensagens
        if(!empty($erros)):
            foreach($erros as $erro):
                echo "<li> $erro</li>";
            endforeach;
            else:
            echo "Parabéns, os dados estão corretos!<br>";
            
        endif;

        // upload de arquivo
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        if(in_array($extensao, $formatoPermitido)):
            $Pasta = "arquivos/";
            $temporario = $_FILES['arquivo']['tmp_name'];
            $novoNome = uniqid(). ".$extensao";

            if(move_uploaded_file($temporario, $Pasta.$novoNome)):
                $mensagem = "Upload feito com sucesso!";
            else:
                $mensagem = "erro, não foi possivel fazer o upload";
            endif;

        else:
            $mensagem = "formato inválido";
        endif;
        echo $mensagem;

    ?>
</body>
</html>
