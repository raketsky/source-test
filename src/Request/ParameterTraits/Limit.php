<?php
declare(strict_types=1);

namespace App\Request\ParameterTraits;

use Symfony\Component\Validator\Constraints as Assert;

trait Limit
{
    /**
     * @Assert\Range(min = 1, max = 50000)
     * @Assert\NotBlank
     */
    protected int $limit;

    private function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
