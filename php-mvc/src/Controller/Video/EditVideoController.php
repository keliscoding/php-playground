<?php

namespace Zam0k\PhpMvc\Controller\Video;

use Zam0k\PhpMvc\Controller\Controller;
use Zam0k\PhpMvc\Entity\Video;
use Zam0k\PhpMvc\Repository\VideoRepository;

class EditVideoController implements Controller
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
    public function processaRequisicao()
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
}