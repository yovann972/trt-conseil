<?php

namespace App\Entity;

use App\Repository\RecuitersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecuitersRepository::class)]
class Recuiters
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 100)]
    private ?string $companyName;

    #[ORM\Column(length: 100)]
    private ?string $address;

    #[ORM\Column(length: 80)]
    private ?string $city;

    #[ORM\Column(length: 5)]
    private ?string $zipCode;

    #[ORM\Column]
    private ?bool $isVerify = false ;

    #[ORM\OneToMany(mappedBy: 'authorId', targetEntity: JobsOffers::class)]
    private Collection $myOffers;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $createdBy = null;


    public function __construct()
    {
        $this->myOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function isIsVerify(): ?bool
    {
        return $this->isVerify;
    }

    public function setIsVerify(bool $isVerify): self
    {
        $this->isVerify = $isVerify;

        return $this;
    }

    /**
     * @return Collection<int, JobsOffers>
     */
    public function getMyOffers(): Collection
    {
        return $this->myOffers;
    }

    public function addMyOffer(JobsOffers $myOffer): self
    {
        if (!$this->myOffers->contains($myOffer)) {
            $this->myOffers->add($myOffer);
            $myOffer->setAuthorId($this);
        }

        return $this;
    }

    public function removeMyOffer(JobsOffers $myOffer): self
    {
        if ($this->myOffers->removeElement($myOffer)) {
            // set the owning side to null (unless already changed)
            if ($myOffer->getAuthorId() === $this) {
                $myOffer->setAuthorId(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?Users
    {
        return $this->createdBy;
    }

    public function setCreatedBy(Users $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function __toString()
    {
        return $this->companyName;
    }



}
