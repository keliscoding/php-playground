<?php

namespace Zam0k\PhpMvc\Controller\Video;

use Zam0k\PhpMvc\Controller\Controller;
use Zam0k\PhpMvc\Entity\Video;
use Zam0k\PhpMvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
    public function processaRequisicao()
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $titulo = filter_input(INPUT_POST, 'titulo');

        if($url === false || $titulo === false) {
            $_SESSION['status'] = 'Something went wrong';
            header('Location: /');
            exit();
        }

        $video = new Video($url, $titulo);

        if($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../../public/img/uploads/' . $_FILES['image']['name']

            );
            $video->setImage($_FILES['image']['name']);
        }

        $result = $this->videoRepository->add($video);

        if($result === false) {
            $_SESSION['status'] = 'Something went wrong';
        } else {
            $_SESSION['status'] = 'Video Inserted Successfully';
        }

        header('Location: /');
    }
}