<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ChuckController
{
    public function __invoke(Client $client, LoggerInterface $logger)
    {
        
        $response = $client->get('/jokes/random');
        $data = json_decode($response->getBody()->getContents());
        $logger->info('Got a chuck Norris joke', [
            'data'=>dump($data)
            ]);
        return new Response($data->value);
    }
}