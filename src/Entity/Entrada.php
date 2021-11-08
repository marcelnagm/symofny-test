<?php

namespace App\Entity;

use App\Repository\EntradaRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="datetime")
     */
    private $batch;

    /**
     * @ORM\Column(type="bigint")
     */
    private $bloco;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBatch(): ?\DateTimeInterface
    {
        return $this->batch;
    }

    public function setBatch(\DateTimeInterface $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    public function getBloco(): ?string
    {
        return $this->bloco;
    }

    public function setBloco(string $bloco): self
    {
        $this->bloco = $bloco;

        return $this;
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
