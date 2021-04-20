<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 */
class Program
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=ProgramForDay::class, mappedBy="rel_program")
     */
    private $rel_for_day;

    public function __construct()
    {
        $this->rel_for_day = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|ProgramForDay[]
     */
    public function getRelForDay(): Collection
    {
        return $this->rel_for_day;
    }

    public function addRelForDay(ProgramForDay $relForDay): self
    {
        if (!$this->rel_for_day->contains($relForDay)) {
            $this->rel_for_day[] = $relForDay;
            $relForDay->setRelProgram($this);
        }

        return $this;
    }

    public function removeRelForDay(ProgramForDay $relForDay): self
    {
        if ($this->rel_for_day->removeElement($relForDay)) {
            // set the owning side to null (unless already changed)
            if ($relForDay->getRelProgram() === $this) {
                $relForDay->setRelProgram(null);
            }
        }

        return $this;
    }
}
