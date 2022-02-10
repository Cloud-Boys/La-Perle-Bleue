<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbAdulte;

    /**
     * @ORM\Column(type="integer", options={"default": "0"}, nullable=true)
     */
    private $nbEnfant;

    /**
     * @ORM\Column(type="integer", options={"default": "0"}, nullable=true)
     */
    private $nbBebe;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}, nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @var \DateTime
     */
    private $defaultDate;

    public function __construct()
    {
        $this->defaultDate = new \DateTime();
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
    
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNbAdulte(): ?int
    {
        return $this->nbAdulte;
    }

    public function setNbAdulte(int $nbAdulte): self
    {
        $this->nbAdulte = $nbAdulte;

        return $this;
    }

    public function getNbEnfant(): ?int
    {
        return $this->nbEnfant;
    }

    public function setNbEnfant(int $nbEnfant): self
    {
        $this->nbEnfant = $nbEnfant;

        return $this;
    }

    public function getNbBebe(): ?int
    {
        return $this->nbBebe;
    }

    public function setNbBebe(int $nbBebe): self
    {
        $this->nbBebe = $nbBebe;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
