<?php
declare(strict_types=1);

namespace App\Request\ParameterTraits;

use Symfony\Component\Validator\Constraints as Assert;

trait PageNr
{
    /**
     * @Assert\Positive
     * @Assert\NotBlank
     */
    protected int $pageNr;

    private function setPageNr(int $pageNr): void
    {
        $this->pageNr = $pageNr;
    }

    public function getPageNr(): int
    {
        return $this->pageNr;
    }
}
