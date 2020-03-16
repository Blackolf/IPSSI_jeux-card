<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardRepository")
 */
class Card
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
     * @ORM\Column(type="integer")
     */
    private $atk;

    /**
     * @ORM\Column(type="integer")
     */
    private $hp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Faction", inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_Faction;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pack", mappedBy="id_card")
     */
    private $id_Pack;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id_cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_creator;

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    public function __construct()
    {
        $this->id_Pack = new ArrayCollection();
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

    public function getAtk(): ?int
    {
        return $this->atk;
    }

    public function setAtk(int $atk): self
    {
        $this->atk = $atk;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getIdFaction(): ?Faction
    {
        return $this->id_Faction;
    }

    public function setIdFaction(?Faction $id_Faction): self
    {
        $this->id_Faction = $id_Faction;

        return $this;
    }

    /**
     * @return Collection|Pack[]
     */
    public function getIdPack(): Collection
    {
        return $this->id_Pack;
    }

    public function addIdPack(Pack $idPack): self
    {
        if (!$this->id_Pack->contains($idPack)) {
            $this->id_Pack[] = $idPack;
            $idPack->addIdCard($this);
        }

        return $this;
    }

    public function removeIdPack(Pack $idPack): self
    {
        if ($this->id_Pack->contains($idPack)) {
            $this->id_Pack->removeElement($idPack);
            $idPack->removeIdCard($this);
        }

        return $this;
    }

    public function getIdCreator(): ?User
    {
        return $this->id_creator;
    }

    public function setIdCreator(?User $id_creator): self
    {
        $this->id_creator = $id_creator;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }
}
