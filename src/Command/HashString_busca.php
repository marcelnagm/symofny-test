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
use App\Entity\Entrada;
use Doctrine\ORM\EntityManagerInterface;


/**
 * Description of HashString
 *
 * @author suporte
 */
class HashString_busca extends Command {

    //put your code here

    protected static $defaultName = 'avato:test-busca';    
    private $number;
    private $entityManager;

 
    public function __construct( $_number = 0,EntityManagerInterface $entityManager) {        
        $this->entityManager = $entityManager;
          
        parent::__construct();
    }

    protected function configure(): void {
        $this->setHelp('Este comando gera uma lista de strings e hash, deve ser passada uma string inicial e numero de requests ex: avato:test string --requests=100')
                ->addArgument('page', InputArgument::REQUIRED, 'Você precisa especificar a pagina ')
                ->addArgument('number', InputArgument::OPTIONAL, 'VOcê precisa especificar o numero de tentativas .')        
        ;
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $output->writeln('Whoa!');
        $n = $input->getArgument('number');
        $page = $input->getArgument('page');
//        TODO usar prepared sql para a consulta
        $em = $this->entityManager;
               
          $entradas = $em->getRepository(Entrada::class);

    // build the query for the doctrine paginator
    $query = $entradas->createQueryBuilder('u')
                        ->where('u.n >= :n')->setParameter('n', $n)
                        ->orderBy('u.id', 'DESC')
                        ->getQuery();

    //set page size
    $pageSize = '2';

    // load doctrine Paginator
    $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);

    // you can get total items
    $totalItems = count($paginator);

    // get total pages
    $pagesCount = ceil($totalItems / $pageSize);
//    dd ($totalItems);
    // now get one page's items:
    $paginator
        ->getQuery()
        ->setFirstResult($pageSize * ($page-1)) // set the offset
        ->setMaxResults($pageSize); // set the limit

    foreach ($paginator as $pageItem) {
        // do stuff with results...
        
         $output->writeln($pageItem);
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
