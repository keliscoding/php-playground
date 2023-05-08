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
        require_once __DIR__ . '/../../views/video-list.php';
    }

    public function showFormularioPage(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $video = null;

        if($id !== false && $id !== null) {
            $video = $this->videoRepository->getById($id);
        }

        require_once __DIR__ . '/../../views/form.php';
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