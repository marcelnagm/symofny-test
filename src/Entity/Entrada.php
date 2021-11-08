<?php

namespace App\Entity;

use App\Repository\EntradaRepository;
use Doctrine\ORM\Mapping as ORM;
use Assert\DateTime;
/**
 * @ORM\Entity(repositoryClass=EntradaRepository::class)
 */
class Entrada
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", length=255)
     * @var string A "Y-m-d H:i:s" formatted value     
     */
    private $batch;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entrada;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chave;

    /**
     * @ORM\Column(type="bigint")
     */
    private $n;
    
        public function __toString(): String
        {
            return '['.($this->getBatchFormatted(). ' ').' , '.$this->getBloco().' , '.$this->getEntrada(). ' , '.$this->getChave().']';
        }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBatchFormatted(): String
    {
        
        if ($this->batch instanceof \DateTime) {
    return  $this->batch->format('Y-m-d H:i:s');
        }
    }
    
    public function getBatch(): ?\DateTimeInterface
    {
        
        if ($this->batch instanceof \DateTime) {
    return  $this->batch->format('Y-m-d H:i:s');
        }
    }

    public function setBatch(\DateTimeInterface $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    public function getBloco(): ?string
    {
        return $this->id;
    }

    

    public function getEntrada(): ?string
    {
        return $this->entrada;
    }

    public function setEntrada(string $entrada): self
    {
        $this->entrada = $entrada;

        return $this;
    }

    public function getChave(): ?string
    {
        return $this->chave;
    }

    public function setChave(string $chave): self
    {
        $this->chave = $chave;

        return $this;
    }

    public function getN(): ?string
    {
        return $this->n;
    }

    public function setN(string $n): self
    {
        $this->n = $n;

        return $this;
    }
}
