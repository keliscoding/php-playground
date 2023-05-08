<?php

namespace Zam0k\PhpMvc\Controller\Video;

use Zam0k\PhpMvc\Controller\Controller;
use Zam0k\PhpMvc\Repository\VideoRepository;

class VideoFormController implements Controller
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        session_start();
        $this->videoRepository = $videoRepository;
    }
    public function processaRequisicao()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $video = null;

        if($id !== false && $id !== null) {
            $video = $this->videoRepository->getById($id);
        }

        require_once __DIR__ . '/../../../views/form.php';
    }
}