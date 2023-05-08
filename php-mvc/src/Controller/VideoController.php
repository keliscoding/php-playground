<?php

namespace Zam0k\PhpMvc\Controller;

use PDO;
use Zam0k\PhpMvc\Entity\Video;
use Zam0k\PhpMvc\Repository\VideoRepository;

class VideoController
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        session_start();
        $this->videoRepository = $videoRepository;
    }

    public function showListVideoPage(): void {
        $videoList = $this->videoRepository->all();
        require_once __DIR__ . '/../../inicio-html.php';
        ?>
            <ul class="videos__container" alt="videos alura">
                <?php if(isset($_SESSION['status'])): ?>
                    <div style="background-color: green">
                        <?php echo $_SESSION['status']; ?>
                    </div>
                    <?php
                        unset($_SESSION['status']);
                endif ?>
                <?php foreach ($videoList as $video): ?>
                    <?php if(str_starts_with($video->getUrl(), 'http')): ?>
                        <li class="videos__item">
                            <iframe width="100%" height="72%" src="<?= $video->getUrl(); ?>"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            <div class="descricao-video">
                                <img src="./img/logo.png" alt="logo canal alura">
                                <h3><?= $video->getTitle(); ?></h3>
                                <div class="acoes-video">
                                    <a href="./editar-video?id=<?= $video->getId(); ?>">Editar</a>
                                    <a href="./remover-video?id=<?= $video->getId(); ?>">Excluir</a>
                                </div>
                            </div>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        <?php require_once __DIR__ . '/../../fim-html.php';
    }

    public function showFormularioPage(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $video = new Video('https://www.google.com.br', '');

        if($id !== false && $id !== null) {
            $video = $this->videoRepository->getById($id);
        }

        require_once __DIR__ . '/../../inicio-html.php'; ?>
            <main class="container">

                <form class="container__formulario"
                method="post">
                    <h2 class="formulario__titulo">Envie um vídeo!</h2>
                        <div class="formulario__campo">
                            <label class="campo__etiqueta" for="url">Link embed</label>
                            <input name="url"
                                value="<?= $video->getUrl() ?>"
                                class="campo__escrita" required
                                placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' />
                        </div>


                        <div class="formulario__campo">
                            <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                            <input name="titulo"
                            value="<?= $video->getTitle() ?>"
                            class="campo__escrita" required
                            placeholder="Neste campo, dê o nome do vídeo"
                            id='titulo' />
                        </div>

                        <input class="formulario__botao" type="submit" value="Enviar" />
                </form>

            </main>
        <?php require_once __DIR__ . '/../../fim-html.php';
    }

    public function editVideo(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $titulo = filter_input(INPUT_POST, 'titulo');

        if($url === false || $titulo === false || $id === false || $id === null) {
            $_SESSION['status'] = 'Something went wrong';
            header('Location: /');
            exit();
        }

        $video = new Video($url, $titulo);
        $video->setId($id);

        $result = $this->videoRepository->update($video);

        if($result === false) {
            $_SESSION['status'] = 'Something went wrong';
        } else {
            $_SESSION['status'] = 'Video Removed Successfully';
        }

        header('Location: /');
    }

    public function createVideo(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $titulo = filter_input(INPUT_POST, 'titulo');

        if($url === false || $titulo === false) {
            $_SESSION['status'] = 'Something went wrong';
            header('Location: /');
            exit();
        }

        $video = new Video($url, $titulo);
        $result = $this->videoRepository->add($video);

        if($result === false) {
            $_SESSION['status'] = 'Something went wrong';
        } else {
            $_SESSION['status'] = 'Video Inserted Successfully';
        }

        header('Location: /');
    }

    public function removeVideo(): void
    {
        $id = $_GET['id'];

        if($id === false || $id === null) {
            $_SESSION['status'] = 'Something went wrong';
            header('Location: /');
            exit();
        }

        $result = $this->videoRepository->remove($id);

        if($result === false) {
            $_SESSION['status'] = 'Something went wrong';
        } else {
            $_SESSION['status'] = 'Video Removed Successfully';
        }

        header('Location: /');
    }
}