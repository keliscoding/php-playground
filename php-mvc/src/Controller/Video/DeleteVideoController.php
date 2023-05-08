<?php

namespace Zam0k\PhpMvc\Controller\Video;

use Zam0k\PhpMvc\Controller\Controller;
use Zam0k\PhpMvc\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        session_start();
        $this->videoRepository = $videoRepository;
    }
    public function processaRequisicao()
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