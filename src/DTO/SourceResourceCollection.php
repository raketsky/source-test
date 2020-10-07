<?php
declare(strict_types=1);

namespace App\DTO;

use App\Entity\SourceInterface;
use App\Exception\UnexpectedClassException;

class SourceResourceCollection
{
    /**
     * @var SourceResource[]
     */
    private array $items = [];

    /**
     * @param SourceInterface[] $collectionRecords
     */
    public function __construct(iterable $collectionRecords) {
        foreach ($collectionRecords as $collectionRecord) {
            if (!$collectionRecord instanceof SourceInterface) {
                throw new UnexpectedClassException(SourceInterface::class, $collectionRecord);
            }
            $this->items[] = new SourceResource($collectionRecord);
        }
    }

    public function getJsonItemResponse(): array
    {
        $collection = [];
        foreach ($this->items as $item) {
            $collection[] = $item->getJsonItemResponse();
        }

        return $collection;
    }
}
