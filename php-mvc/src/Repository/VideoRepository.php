<?php
namespace Zam0k\PhpMvc\Repository;
use BadMethodCallException;
use PDO;
use Zam0k\PhpMvc\Entity\Video;

class VideoRepository
{
    public function __construct(private \PDO $pdo)
    {}

    public function add(Video $video): bool
    {
        $sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $video->getUrl());
        $stmt->bindValue(2, $video->getTitle());

        $result = $stmt->execute();

        if($result === false) {
            throw new BadMethodCallException("Could not add a new video");
        }

        $id = $this->pdo->lastInsertId();

        $video->setId(intval($id));

        return $result;
    }

    public function getById(int $id): Video
    {
        $stmt = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        if($stmt->execute() === false){
            throw new \http\Exception\BadMethodCallException("Algo errado aconteceu.");
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $video = new Video($result['url'], $result['title']);
        $video->setId($id);
        return $video;
    }

    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }

    public function update(Video $video): bool
    {
        $sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $video->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':title', $video->getTitle());
        $stmt->bindValue(':url', $video->getUrl());

        return $stmt->execute();
    }

    public function all(): array
    {
        $videoList = $this->pdo
            ->query('SELECT * FROM videos')
            ->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map(
            function(array $videoData)
            {
                $video = new Video($videoData['url'], $videoData['title']);
                $video->setId($videoData['id']);
                return $video;
            }, $videoList);
    }
}