<?php
    require_once __DIR__ . '/inicio-html.php';
    /** @var $videoList */
?>
    <ul class="videos__container" alt="videos alura">
        <?php if(isset($_SESSION['status'])): ?>
            <div style="background-color: green">
                <?php echo $_SESSION['status']; ?>
            </div>
            <?php
            unset($_SESSION['status']);
        endif ?>
        <?php foreach ($videoList as $video): ?>
            <?php if(str_starts_with($video->getUrl(), 'http')): ?>
                <li class="videos__item">
                    <?php if($video->getImage() !== null): ?>
                    <a href="<?=$video->getUrl()?>">
                        <img src="/img/uploads/<?=$video->getImage()?>" alt="<?= $video->getTitle()?>" style="width: 100%; height:72%"/>
                    </a>
                    <?php else: ?>
                    <iframe width="100%" height="72%" src="<?= $video->getUrl(); ?>"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    <?php endif; ?>
                    <div class="descricao-video">
                        <img src="./img/logo.png" alt="logo canal alura">
                        <h3><?= $video->getTitle(); ?></h3>
                        <div class="acoes-video">
                            <a href="./editar-video?id=<?= $video->getId(); ?>">Editar</a>
                            <a href="./remover-thumbnail?id=<?= $video->getId(); ?>">Remover Thumbnail</a>
                            <a href="./remover-video?id=<?= $video->getId(); ?>">Excluir</a>
                        </div>
                    </div>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
<?php require_once __DIR__ . '/fim-html.php';