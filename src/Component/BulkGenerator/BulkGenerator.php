<?php
declare(strict_types=1);

namespace App\Component\BulkGenerator;

use App\Component\BulkGenerator\Exception\BulkGeneratorException;
use App\Component\BulkGenerator\Item\ItemFactory;
use App\Component\BulkGenerator\Translator\TranslatorInterface;
use App\Component\BulkGenerator\Writer\WriterInterface;
use App\Entity\Source;
use App\Entity\SourceInterface;
use App\Exception\UnexpectedClassException;

final class BulkGenerator
{
    private ItemFactory $itemFactory;
    private TranslatorInterface $translator;
    private ?WriterInterface $writer;

    public function __construct(
        ItemFactory $itemFactory,
        TranslatorInterface $translator,
        WriterInterface $writer = null
    ) {
        $this->itemFactory = $itemFactory;
        $this->translator = $translator;
        $this->writer = $writer;
    }

    public function getWriter(): ?WriterInterface
    {
        return $this->writer;
    }

    public function setWriter(WriterInterface $writer): void
    {
        $this->writer = $writer;
    }

    /**
     * @param Source[] $source
     * @return void
     * @throws BulkGeneratorException
     */
    public function generate(iterable $source): void
    {
        if (!$this->writer) {
            throw new BulkGeneratorException('Writer not initialized');
        }

        foreach ($source as $sourceItem) {
            if (!$sourceItem instanceof SourceInterface) {
                throw new UnexpectedClassException(SourceInterface::class, $sourceItem);
            }

            $item = $this->itemFactory->createItem($sourceItem);
            $translatedItem = $this->translator->translate($item);
            $this->writer->write($translatedItem);
        }
    }
}
