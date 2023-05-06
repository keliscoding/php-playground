<?php

require 'vendor/autoload.php';

Teste::teste();
exit();

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client([
    'base_uri' => 'https://www.alura.com.br',
    'verify' => false //desabilita verificação de certificado SSL
]);
$crawler = new Crawler();

$buscador = new \Zam0k\BuscadorCursos\Buscador($client, $crawler);

$cursos = $buscador->buscar('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    echo $curso . PHP_EOL;
}