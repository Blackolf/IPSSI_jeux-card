<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pack", mappedBy="id_User")
     */
    private $id_Pack;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Card", mappedBy="id_creator")
     */
    private $id_cards;

    public function __construct()
    {
        $this->id_Pack = new ArrayCollection();
        $this->id_cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $idPack->setIdUser($this);
        }

        return $this;
    }

    public function removeIdPack(Pack $idPack): self
    {
        if ($this->id_Pack->contains($idPack)) {
            $this->id_Pack->removeElement($idPack);
            // set the owning side to null (unless already changed)
            if ($idPack->getIdUser() === $this) {
                $idPack->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getIdCards(): Collection
    {
        return $this->id_cards;
    }

    public function addIdCard(Card $idCard): self
    {
        if (!$this->id_cards->contains($idCard)) {
            $this->id_cards[] = $idCard;
            $idCard->setIdCreator($this);
        }

        return $this;
    }

    public function removeIdCard(Card $idCard): self
    {
        if ($this->id_cards->contains($idCard)) {
            $this->id_cards->removeElement($idCard);
            // set the owning side to null (unless already changed)
            if ($idCard->getIdCreator() === $this) {
                $idCard->setIdCreator(null);
            }
        }

        return $this;
    }
}
