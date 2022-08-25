<?php

namespace App\Entity;

use App\Repository\ApplicantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantsRepository::class)]
class Applicants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $firstName = null;

    #[ORM\Column(length: 100)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $cv = null;

    #[ORM\Column]
    private ?bool $isVerify = null;

    #[ORM\OneToMany(mappedBy: 'applicantsId', targetEntity: Apply::class)]
    private Collection $myApply;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $createdBy = null;

    public function __construct()
    {
        $this->myApply = new ArrayCollection();
        $this->isVerify = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function isVerify(): ?bool
    {
        return $this->isVerify;
    }

    public function setIsVerify(bool $isVerify): self
    {
        $this->isVerify = $isVerify;

        return $this;
    }

    /**
     * @return Collection<int, Apply>
     */
    public function getMyApply(): Collection
    {
        return $this->myApply;
    }

    public function addMyApply(Apply $myApply): self
    {
        if (!$this->myApply->contains($myApply)) {
            $this->myApply->add($myApply);
            $myApply->setApplicantsId($this);
        }

        return $this;
    }

    public function removeMyApply(Apply $myApply): self
    {
        if ($this->myApply->removeElement($myApply)) {
            // set the owning side to null (unless already changed)
            if ($myApply->getApplicantsId() === $this) {
                $myApply->setApplicantsId(null);
            }
        }

        return $this;
    }

    
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
    
    
    public function setCreatedBy($createdBy):self
    {
        $this->createdBy = $createdBy;
        
        return $this;
    }

    public function __toString()
    {
        return $this->id;
        return $this->firstName;
    }
}
