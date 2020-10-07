<?php
declare(strict_types=1);

namespace App\Tests\Functional\BulkGenerator;

use App\Component\BulkGenerator\BulkGenerator;
use App\Component\BulkGenerator\Item\ItemFactory;
use App\Component\BulkGenerator\Translator\CsvTranslator;
use App\Component\BulkGenerator\Writer\FileWriter;
use App\Entity\SourceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validation;

class CsvFileExportTest extends KernelTestCase
{
    public function testCsvFileGenerating()
    {
        $filename = 'var/test.csv';
        $sourceCount = 10;
        if (file_exists($filename)) {
            unlink($filename);
        }

        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $writer = new FileWriter($filename);
        $translator = new CsvTranslator($validator);
        $itemFactory = new ItemFactory();

        $source = $this->getSourceMock($sourceCount);

        $bulkGenerator = new BulkGenerator($itemFactory, $translator, $writer);
        $bulkGenerator->generate($source);

        $handle = fopen($filename, 'r');
        $rowCount = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $this->validateRow($row);
            $rowCount++;
        }
        fclose($handle);

        $this->assertEquals($sourceCount, $rowCount, 'Written lines count does not match');
        $this->assertTrue(unlink($filename), 'Unable to delete test file');
    }

    private function validateRow(array $row): void
    {
        $this->assertCount(4, $row, 'Column count does not match');

        $id = $row[0];
        $a = $row[1];
        $b = $row[2];
        $c = $row[3];

        $this->assertEquals($id, $a);
        $this->assertEquals($b, $a % 3, 'Number B incorrect %3');
        $this->assertEquals($c, $a % 5, 'Number B incorrect %3');
    }

    /**
     * @param int $limit
     * @return SourceInterface[]
     */
    private function getSourceMock(int $limit): array
    {
        $source = [];

        for ($i = 1; $i <= $limit; $i++) {
            $sourceMock = $this->getMockBuilder(SourceInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $sourceMock->method('getId')->willReturn($i);
            $sourceMock->method('getA')->willReturn($i);
            $sourceMock->method('getB')->willReturn($i % 3);
            $sourceMock->method('getC')->willReturn($i % 5);

            $source[] = $sourceMock;
        }

        return $source;
    }
}
