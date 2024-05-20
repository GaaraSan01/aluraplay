<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$sql = 'SELECT * FROM videos WHERE id = ?;';

$video = [
    'url'=> '',
    'title'=> ''
];

if($id !== false ){
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $video = $statement->fetch(PDO::FETCH_ASSOC);
}
?><?php require_once 'inicio-html.php'; ?>
    <main class="container">

        <form class="container__formulario" method="post">
            <h2 class="formulario__titulo">Envie um vídeo!</h2>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input 
                        name="url" 
                        class="campo__escrita" 
                        required
                        placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" 
                        id='url'
                        value="<?= $video['url'] ?>"
                    />
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input 
                        name="title" 
                        class="campo__escrita" 
                        required 
                        placeholder="Neste campo, dê o nome do vídeo"
                        value="<?= $video['title'] ?>"
                        id='titulo' 
                    />
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>
<?php require_once 'fim-html.php';?>