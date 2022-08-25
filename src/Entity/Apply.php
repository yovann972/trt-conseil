<?php

namespace App\Entity;

use App\Repository\ApplyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplyRepository::class)]
class Apply
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?JobsOffers $jobsOffersId = null;

    #[ORM\ManyToOne(inversedBy: 'myApply')]
    private ?Applicants $applicantsId = null;

    #[ORM\ManyToOne(inversedBy: 'listApply')]
    private ?JobsOffers $applies = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobsOffersId(): ?JobsOffers
    {
        return $this->jobsOffersId;
    }

    public function setJobsOffersId(?JobsOffers $jobsOffersId): self
    {
        $this->jobsOffersId = $jobsOffersId;

        return $this;
    }

    public function getApplicantsId(): ?Applicants
    {
        return $this->applicantsId;
    }

    public function setApplicantsId(?Applicants $applicantsId): self
    {
        $this->applicantsId = $applicantsId;

        return $this;
    }

    public function getApplies(): ?JobsOffers
    {
        return $this->applies;
    }

    public function setApplies(?JobsOffers $applies): self
    {
        $this->applies = $applies;

        return $this;
    }

}
