<?php

namespace Zam0k\PhpMvc\Controller\Video;

use Zam0k\PhpMvc\Controller\Controller;
use Zam0k\PhpMvc\Repository\VideoRepository;

class VideoListController implements Controller
{

    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
    public function processaRequisicao()
    {
        $videoList = $this->videoRepository->all();
        require_once __DIR__ . '/../../../views/video-list.php';
    }
}