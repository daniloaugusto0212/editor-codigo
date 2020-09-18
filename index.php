<?php
    if (isset($_POST['acao'])) {
        $texto = $_POST['texto'];
        $arquivo = $_POST['arquivo'];
        file_put_contents($arquivo,$texto);
        echo '<script>alert("Salvo com sucesso!")</script>';
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <title>Editor - Listagem de arquivos</title>
</head>
<body>
<?php
    $files = scandir('files');
    for ($i=0; $i < count($files); $i++) { 
        if (is_dir($files[$i])) {
            continue;
            
        }
        $file_extension = explode('.',$files[$i]);
        if (@$file_extension[1] == 'php' || @$file_extension[1] == 'html' || @$file_extension[1] == 'js') {
            if (@$file_extension[1] == 'php'){
                $icon = '<i class="fab fa-php"></i>';
            }else if (@$file_extension[1] == 'html') {
                $icon = '<i class="fab fa-html5"></i>';
            }else if (@$file_extension[1] == 'js') {
                $icon = '<i class="fab fa-js"></i>';
            }
            
?>
    <div class="lista-arquivo-single">
         <p><a href="?file=<?= $files[$i] ?>"><?= $icon ?> <?= $files[$i] ?></a></p>   
    </div>

            

<?php
        }
    }
    if (isset($_GET['file']) && file_exists('files/'.$_GET['file'])) {
?>
    <h2><?= 'Editando o arquivo: '.$_GET['file'] ?></h2>
    <form action="" method="post">
        <textarea name="texto"><?= file_get_contents('files/'.$_GET['file']) ?></textarea>
        <br>
        <input type="hidden" name="arquivo" value="<?= ('files/'.$_GET['file']) ?>">
        <input type="submit" name="acao" value="Salvar!">
    </form>
    <?php } ?>
    
</body>
</html>