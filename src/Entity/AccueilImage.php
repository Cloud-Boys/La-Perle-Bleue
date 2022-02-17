<?php

namespace App\Entity;

use App\Repository\AccueilImageRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccueilImageRepository::class)
 * @Vich\Uploadable()
 */
class AccueilImage
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

     /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="Image")
     */
    private $imageFichier;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of imageFichier
     */ 
    public function getImageFichier()
    {
        return $this->imageFichier;
    }

    /**
     * Set the value of imageFichier
     *
     * @return  self
     */ 
    public function setImageFichier($imageFichier)
    {
        $this->imageFichier = $imageFichier;

        return $this;
    }
}
