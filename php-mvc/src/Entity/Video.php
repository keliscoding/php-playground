<?php
namespace Zam0k\PhpMvc\Entity;

class Video
{
    private $id;
    private $url;
    private $title;

    public function __construct(
        string $url,
        string $title
    )
    {
        $this->setUrl($url);
        $this->title = $title;
    }

    public function setUrl(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)){
            throw new \InvalidArgumentException();
        }

        $this->url = $url;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

}