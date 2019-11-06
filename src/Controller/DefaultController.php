<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function __invoke(Request $request): Response 
    {
        $name = $request->get('name', 'anonymous');
        $util = new class {
            public $maVariable = "tt";
        };
        //return new Response(json_encode($util));
        return new Response("hello $name !");
    }
}