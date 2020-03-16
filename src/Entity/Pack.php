<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PackRepository")
 */
class Pack
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Card", inversedBy="id_Pack")
     */
    private $id_card;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id_Pack")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_User;

    public function __construct()
    {
        $this->id_card = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getIdCard(): Collection
    {
        return $this->id_card;
    }

    public function addIdCard(Card $idCard): self
    {
        if (!$this->id_card->contains($idCard)) {
            $this->id_card[] = $idCard;
        }

        return $this;
    }

    public function removeIdCard(Card $idCard): self
    {
        if ($this->id_card->contains($idCard)) {
            $this->id_card->removeElement($idCard);
        }

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_User;
    }

    public function setIdUser(?User $id_User): self
    {
        $this->id_User = $id_User;

        return $this;
    }
}
