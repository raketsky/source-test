<?php
declare(strict_types=1);

namespace App\Component\BulkGenerator\Writer;

final class FileStreamedResponseWriter implements WriterInterface
{
    /**
     * @param string $data
     */
    public function write($data): void
    {
        echo $data;
        flush();
    }
}
