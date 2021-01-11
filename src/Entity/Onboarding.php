<?php

namespace App\Entity;

use App\Repository\OnboardingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OnboardingRepository::class)
 */
class Onboarding
{
    public const TYPE_INTERESTED = 1;
    public const TYPE_NOT_INTERESTED = 0;
    public const TYPE_FOLLOW_UP = 2;
    public const TYPE_REPEATED_FOLLOW_UP = 3;

    public const OPTIONS = [
        self::TYPE_INTERESTED => 'Intrested',
        self::TYPE_NOT_INTERESTED => 'Not Intrested',
        self::TYPE_FOLLOW_UP => 'Follow Up',
        self::TYPE_REPEATED_FOLLOW_UP => 'Repeated Follow Up'
    ];
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
     * @ORM\Column(type="smallint")
     */
    private $response;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;

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

    public function getResponse(): ?int
    {
        return $this->response;
    }

    public function setResponse(int $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
