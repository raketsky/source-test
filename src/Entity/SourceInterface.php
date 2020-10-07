<?php
declare(strict_types=1);

namespace App\Entity;

interface SourceInterface
{
    public function getId(): ?int;

    public function getA(): int;

    public function getB(): int;

    public function getC(): int;

    public function setA(int $a): void;

    public function setB(int $b): void;

    public function setC(int $c): void;
}
