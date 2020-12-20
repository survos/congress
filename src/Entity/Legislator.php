<?php

namespace App\Entity;

use App\Repository\LegislatorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Survos\BaseBundle\Entity\SurvosBaseEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=LegislatorRepository::class)
 */
class Legislator extends SurvosBaseEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="object")
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Term::class, mappedBy="legislator", orphanRemoval=true, cascade="persist")
     */
    private $terms;

    public function __construct()
    {
        $this->terms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Term[]
     */
    public function getTerms(): Collection
    {
        return $this->terms;
    }

    public function addTerm(Term $term): self
    {
        if (!$this->terms->contains($term)) {
            $this->terms[] = $term;
            $term->setLegislator($this);
        }

        return $this;
    }

    public function removeTerm(Term $term): self
    {
        if ($this->terms->removeElement($term)) {
            // set the owning side to null (unless already changed)
            if ($term->getLegislator() === $this) {
                $term->setLegislator(null);
            }
        }

        return $this;
    }
}
