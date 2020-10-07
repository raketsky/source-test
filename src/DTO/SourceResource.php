<?php
declare(strict_types=1);

namespace App\DTO;

use App\Entity\SourceInterface;

class SourceResource
{
    private ?int $id;
    private int $a;
    private int $b;
    private int $c;

    public function __construct(SourceInterface $source)
    {
        $this->id = $source->getId();
        $this->a = $source->getA();
        $this->b = $source->getB();
        $this->c = $source->getC();
    }

    public function getJsonItemResponse(): array
    {
        return [
            'id' => $this->id,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
        ];
    }
}
