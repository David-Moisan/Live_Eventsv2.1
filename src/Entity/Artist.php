<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scene;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class)
     */
    private $id_program;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHours(): ?string
    {
        return $this->hours;
    }

    public function setHours(string $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getScene(): ?string
    {
        return $this->scene;
    }

    public function setScene(string $scene): self
    {
        $this->scene = $scene;

        return $this;
    }

    public function getIdProgram(): ?Program
    {
        return $this->id_program;
    }

    public function setIdProgram(?Program $id_program): self
    {
        $this->id_program = $id_program;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}
