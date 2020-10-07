<?php
declare(strict_types=1);

namespace App\Component\BulkGenerator\Translator;

use App\Component\BulkGenerator\DataContract\Item;
use App\Component\BulkGenerator\Exception\TranslatorException;
use App\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CsvTranslator implements TranslatorInterface
{
    private const CSV_END_OF_LINE = "\r\n";
    private const CSV_SEPARATOR = ',';
    private const CSV_ENCLOSURE = '"';
    private const CSV_ESCAPE = '\\';

    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     * @param Item $item
     * @return string
     * @throws ValidationException
     * @throws TranslatorException
     */
    public function translate(Item $item): string
    {
        $errors = $this->validator->validate($item);
        if (count($errors) > 0) {
            throw new ValidationException($errors, $item);
        }

        $data = [];
        foreach (Item::getFieldNames() as $fieldName) {
            $data[] = $item->{'get' . $fieldName}();
        }

        return $this->convertToCsv($data);
    }

    /**
     * @param array $row
     * @return string
     * @throws TranslatorException
     */
    private function convertToCsv(array $row): string
    {
        $f = fopen('php://memory', 'wb');
        if (fputcsv($f, $row, static::CSV_SEPARATOR, static::CSV_ENCLOSURE, static::CSV_ESCAPE) === false) {
            throw new TranslatorException('Unable to generate CSV');
        }
        rewind($f);
        $csvLine = stream_get_contents($f);
        fclose($f);

        return trim($csvLine) . static::CSV_END_OF_LINE;
    }
}
