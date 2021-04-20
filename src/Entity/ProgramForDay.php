<?php

namespace App\Entity;

use App\Repository\ProgramForDayRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramForDayRepository::class)
 */
class ProgramForDay
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
    private $artist;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scene;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="rel_for_day")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rel_program;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

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

    public function getRelProgram(): ?Program
    {
        return $this->rel_program;
    }

    public function setRelProgram(?Program $rel_program): self
    {
        $this->rel_program = $rel_program;

        return $this;
    }
}
