<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of HashString
 *
 * @author suporte
 */
class HashString extends Command {

    //put your code here

    protected static $defaultName = 'avato:test';
    private $string_inicial = "";
    private $number;

    public function __construct(String $_string = "", $_number = 0) {
        $this->string_inicial = (String) $_string;
        $this->number = $_number;

        parent::__construct();
    }

    protected function configure(): void {
        $this->setHelp('Este comando gera uma lista de strings e hash, deve ser passada uma string inicial e numero de requests ex: avato:test string --requests=100')
                ->addArgument('string_inicial', InputArgument::REQUIRED, 'Você precisa especificar a string inicial')
                ->addArgument('number', InputArgument::REQUIRED, 'VOcê precisa especificar o número de vezes.')
        ;
        ;
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $output->writeln('Whoa!');
        $string = $input->getArgument('string_inicial');

        for ($i = 0; $i < $input->getArgument('number'); $i++) {

//           $ch = curl_init();

            $url = 'http://localhost:8000/api/' . $string . '/true';

            repeat:
            $httpClient = HttpClient::create();
            try {
                $response = $httpClient->request('GET', $url);
                $contentType = $response->getHeaders()['content-type'][0];
                echo $contentType . "\n";

                $content = $response->getContent();
                echo $content . "\n";
                $statusCode = $response->getStatusCode();
                if ($statusCode == Response::HTTP_TOO_MANY_REQUESTS) {

                    $contentType = $response->getHeaders()['X-RateLimit-Retry-After'][0];
                    echo $contentType . "\n";

                    goto repeat;
                }
            } catch (\Symfony\Component\HttpClient\Exception\ClientException $e) {
                echo $e;
                sleep(1000);
                goto repeat;
            }


            $result = json_decode($content, true);
            $string = $result['chave'];
        }

        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }

}
