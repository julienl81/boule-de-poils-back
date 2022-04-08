<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("api_animals_list")
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", length=255)
     * @Groups("api_animals_list")
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("api_animals_list")
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     * @Groups("api_animals_list")
     */
    private $age;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("api_animals_list")
     */
    private $child_compatibility;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("api_animals_list")
     */
    private $other_animal_compatibility;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("api_animals_list")
     */
    private $garden_needed;

    /**
     * @ORM\Column(type="smallint")
     * @Groups("api_animals_list")
     */
    private $status;

    /**
     * @ORM\Column(type="text")
     * @Groups("api_animals_list")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("api_animals_list")
     */
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity=Species::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("api_animals_list")
     */
    private $species;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("api_animals_list")
     */
    private $association;

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

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getChildCompatibility(): ?bool
    {
        return $this->child_compatibility;
    }

    public function setChildCompatibility(bool $child_compatibility): self
    {
        $this->child_compatibility = $child_compatibility;

        return $this;
    }

    public function getOtherAnimalCompatibility(): ?bool
    {
        return $this->other_animal_compatibility;
    }

    public function setOtherAnimalCompatibility(bool $other_animal_compatibility): self
    {
        $this->other_animal_compatibility = $other_animal_compatibility;

        return $this;
    }

    public function getGardenNeeded(): ?bool
    {
        return $this->garden_needed;
    }

    public function setGardenNeeded(bool $garden_needed): self
    {
        $this->garden_needed = $garden_needed;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }
}
