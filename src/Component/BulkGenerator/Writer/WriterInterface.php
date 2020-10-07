<?php
namespace App\Component\BulkGenerator\Writer;

interface WriterInterface
{
    /**
     * @param mixed $item
     * @return void
     */
    public function write($item): void;
}
