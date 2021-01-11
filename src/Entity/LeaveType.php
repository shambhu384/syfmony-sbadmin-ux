<?php

namespace App\Entity;

use App\Repository\LeaveTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeaveTypeRepository::class)
 */
class LeaveType
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=LeaveCredit::class, mappedBy="leaveType")
     */
    private $leaveCredits;

    /**
     * @ORM\OneToMany(targetEntity=Leave::class, mappedBy="leaveType")
     */
    private $leaves;

    public function __construct()
    {
        $this->leaveCredits = new ArrayCollection();
        $this->leaves = new ArrayCollection();
    }

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

    /**
     * @return Collection|LeaveCredit[]
     */
    public function getLeaveCredits(): Collection
    {
        return $this->leaveCredits;
    }

    public function addLeaveCredit(LeaveCredit $leaveCredit): self
    {
        if (!$this->leaveCredits->contains($leaveCredit)) {
            $this->leaveCredits[] = $leaveCredit;
            $leaveCredit->setLeaveType($this);
        }

        return $this;
    }

    public function removeLeaveCredit(LeaveCredit $leaveCredit): self
    {
        if ($this->leaveCredits->removeElement($leaveCredit)) {
            // set the owning side to null (unless already changed)
            if ($leaveCredit->getLeaveType() === $this) {
                $leaveCredit->setLeaveType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Leave[]
     */
    public function getLeaves(): Collection
    {
        return $this->leaves;
    }

    public function addLeaf(Leave $leaf): self
    {
        if (!$this->leaves->contains($leaf)) {
            $this->leaves[] = $leaf;
            $leaf->setLeaveType($this);
        }

        return $this;
    }

    public function removeLeaf(Leave $leaf): self
    {
        if ($this->leaves->removeElement($leaf)) {
            // set the owning side to null (unless already changed)
            if ($leaf->getLeaveType() === $this) {
                $leaf->setLeaveType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
