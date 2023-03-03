<?php

namespace App\Entity;

use App\Repository\ReportedProblemRepository;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ReportedPromblemController;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReportedProblemRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
        'post',
        'handle' => [
            'method' => 'POST',
            'path' => '/reported/{email}/{name}/{comment}',
            'controller' => ReportedPromblemController::class,
            'read' => false,

        ],
    ],
    itemOperations: [
        'get',
    ],
)]

class ReportedProblem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(max: 180)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(max: 255)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    private ?string $comments = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }
}
