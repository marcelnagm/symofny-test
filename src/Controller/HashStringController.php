<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\RateLimiter\Storage\InMemoryStorage;
use Symfony\Component\HttpFoundation\JsonResponse;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HashStringController
 *
 * @author suporte
 */
class HashStringController extends AbstractController {
    //put your code here

    /**
     * @Route("/lucky/number/{max}", name="app_lucky_number")
     */
    

    private function process($inicial): array {

        $gerado = substr(md5(random_bytes(10)), 0, 8);

        $n = 1;
        $chave = md5($inicial . $gerado);
        while (substr($chave, 0, 4) !== '0000') {
            $gerado = substr(md5(random_bytes(10)), 0, 8);

            $chave = md5($chave . $gerado);

            $n++;
        }
        $data = array(
            'chave' => $chave,
            'aleartoria'=> $gerado,
            'n' => $n
        );
        
        
        return $data;
    }

    public function hash_string($inicial, Request $request, RateLimiterFactory $anonymousApiLimiter,$json = false): Response {

        $limiter = $anonymousApiLimiter->create($request->getClientIp());

        $limit = $limiter->consume();

        if (false === $limiter->consume(1)->isAccepted()) {
            $headers = [
                'X-RateLimit-Remaining' => $limit->getRemainingTokens(),
                'X-RateLimit-Retry-After' => $limit->getRetryAfter()->getTimestamp(),
                'X-RateLimit-Limit' => $limit->getLimit(),
            ];
            $response = new Response('0', Response::HTTP_TOO_MANY_REQUESTS);
            
            $response->headers->add($headers);

            return $response;
        }
        
        if($json ==false){
        $retorno = $this->process($inicial);
        $response = new Response('Chave - ' . $retorno['chave'] . ' - string aleartoria - ' . $retorno['aleartoria'] . ' n -' . $retorno['n'], Response::HTTP_OK);
        return $response;
        }else   return  new JsonResponse($this->process($inicial));
    }

}
