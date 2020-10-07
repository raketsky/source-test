<?php
declare(strict_types=1);

namespace App\Component\BulkGenerator\Translator;

use App\Component\BulkGenerator\DataContract\Item;

interface TranslatorInterface
{
    /**
     * @param Item $item
     * @return mixed
     */
    public function translate(Item $item);
}
