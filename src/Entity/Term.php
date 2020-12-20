<?php

namespace App\Entity;

use App\Repository\TermRepository;
use Doctrine\ORM\Mapping as ORM;
use Survos\BaseBundle\Entity\SurvosBaseEntity;

/**
 * @ORM\Entity(repositoryClass=TermRepository::class)
 */
class Term extends SurvosBaseEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $state;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $district;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $party;

    /**
     * @ORM\ManyToOne(targetEntity=Legislator::class, inversedBy="terms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $legislator;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDistrict(): ?int
    {
        return $this->district;
    }

    public function setDistrict(?int $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getParty(): ?string
    {
        return $this->party;
    }

    public function setParty(string $party): self
    {
        $this->party = $party;

        return $this;
    }

    public function getLegislator(): ?Legislator
    {
        return $this->legislator;
    }

    public function setLegislator(?Legislator $legislator): self
    {
        $this->legislator = $legislator;

        return $this;
    }
}
