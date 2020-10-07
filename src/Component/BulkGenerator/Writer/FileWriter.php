<?php
declare(strict_types=1);

namespace App\Component\BulkGenerator\Writer;

use App\Component\BulkGenerator\Exception\WriterException;

final class FileWriter implements WriterInterface
{
    private string $filename;
    private $fo;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->fo = fopen($this->filename, 'wb');
    }

    /**
     * @param string $item
     * @throws WriterException
     */
    public function write($item): void
    {
        if (!fwrite($this->fo, $item)) {
            throw new WriterException('Unable to write to file');
        }
    }

    public function __destruct()
    {
        fclose($this->fo);
    }
}
