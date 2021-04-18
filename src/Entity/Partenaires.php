<?php

namespace App\Entity;

use App\Repository\PartenairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartenairesRepository::class)
 */
class Partenaires
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tw;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $yt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $insta;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

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

    public function getFb(): ?string
    {
        return $this->fb;
    }

    public function setFb(?string $fb): self
    {
        $this->fb = $fb;

        return $this;
    }

    public function getTw(): ?string
    {
        return $this->tw;
    }

    public function setTw(?string $tw): self
    {
        $this->tw = $tw;

        return $this;
    }

    public function getYt(): ?string
    {
        return $this->yt;
    }

    public function setYt(?string $yt): self
    {
        $this->yt = $yt;

        return $this;
    }

    public function getInsta(): ?string
    {
        return $this->insta;
    }

    public function setInsta(?string $insta): self
    {
        $this->insta = $insta;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
