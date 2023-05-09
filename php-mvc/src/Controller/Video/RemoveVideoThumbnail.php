<?php

namespace Zam0k\PhpMvc\Controller\Video;

use Zam0k\PhpMvc\Repository\VideoRepository;

class RemoveVideoThumbnail implements \Zam0k\PhpMvc\Controller\Controller
{

    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
    public function processaRequisicao()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if($id === false || $id === null) {
            $_SESSION['status'] = 'Something went wrong';
            header('Location: /');
            exit();
        }

        if($this->videoRepository->removeImage($id) === false) {
            $_SESSION['status'] = 'Something went wrong';
            header('Location: /');
            exit();
        }
        $_SESSION['status'] = 'Thumbnail Removed Successfully';
        header('Location: /');
    }
}