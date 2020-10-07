<?php
declare(strict_types=1);

namespace App\Component\BulkGenerator\Item;

use App\Component\BulkGenerator\DataContract\Item;
use App\Entity\SourceInterface;

final class ItemFactory
{
    public function createItem(SourceInterface $source): Item
    {
        return new Item([
            Item::FIELD_ID => $source->getA(),
            Item::FIELD_A => $source->getA(),
            Item::FIELD_B => $source->getB(),
            Item::FIELD_C => $source->getC(),
        ]);
    }
}
