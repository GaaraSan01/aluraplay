<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class FormVideoController
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $video = null;

        if ($id !== false || $id !== null) {
            $video = $this-> videoRepository->find($id);
        }

        require_once 'inicio-html.php'; ?>
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
                            value="<?= $video?->url ?>"
                        />
                    </div>


                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                        <input 
                            name="title" 
                            class="campo__escrita" 
                            required 
                            placeholder="Neste campo, dê o nome do vídeo"
                            value="<?= $video?->title ?>"
                            id='titulo' 
                        />
                    </div>

                    <input class="formulario__botao" type="submit" value="Enviar" />
            </form>    
        </main>
        <?php require_once 'fim-html.php';
    }
}
