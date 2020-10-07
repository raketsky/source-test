<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Source implements SourceInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private int $a;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private int $b;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private int $c;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getA(): int
    {
        return $this->a;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getC(): int
    {
        return $this->c;
    }

    public function setA(int $a): void
    {
        $this->a = $a;
    }

    public function setB(int $b): void
    {
        $this->b = $b;
    }

    public function setC(int $c): void
    {
        $this->c = $c;
    }
}
