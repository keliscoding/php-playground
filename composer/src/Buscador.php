<?php

namespace Zam0k\BuscadorCursos;

use GuzzleHttp\ClientInterface;

class Buscador
{
    private $httpClient;
    private $crawler;

    public function __construct(ClientInterface $httpClient, $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar($url) 
    {
        $resposta = $this->httpClient->request('GET', $url);
        $html = $resposta->getBody();
        $this->crawler->addHtmlContent($html);

        $elementos = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach($elementos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;
    }
}