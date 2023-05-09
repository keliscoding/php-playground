<?php

namespace Zam0k\PhpMvc\Util;

use finfo;
use Zam0k\PhpMvc\Entity\Video;

class FileSettings
{
    public static function uploadImage(Video $video)
    {
        if($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $safeFileName = uniqid("upload_") . "_" . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);

            if(str_starts_with($mimeType, 'image/')) {
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/' . $safeFileName
                );
                $video->setImage($safeFileName);
            }
        }
    }
}