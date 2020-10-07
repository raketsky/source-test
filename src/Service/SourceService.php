<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Source;
use App\Repository\SourceRepository;

class SourceService
{
    private SourceRepository $sourceRepository;

    public function __construct(SourceRepository $fooRepository)
    {
        $this->sourceRepository = $fooRepository;
    }

    /**
     * @param int $pageNr
     * @param int $itemsPerPage
     * @return Source[]
     */
    public function findLimited(int $pageNr, int $itemsPerPage): array
    {
        return $this->sourceRepository->findLimited($pageNr, $itemsPerPage);
    }

    /**
     * @return Source[]
     */
    public function findAll(): array
    {
        return $this->sourceRepository->findAll();
    }
}
