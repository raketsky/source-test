<?php
declare(strict_types=1);

namespace App\Component\BulkGenerator\DataContract;

use Symfony\Component\Validator\Constraints as Assert;

final class Item
{
    public const FIELD_ID = 'id';
    public const FIELD_A = 'a';
    public const FIELD_B = 'b';
    public const FIELD_C = 'c';

    /**
     * @Assert\Positive
     * @Assert\NotBlank
     */
    private int $id;

    /**
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private int $a;

    /**
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private int $b;

    /**
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private int $c;

    /**
     * @param array{string: mixed} $parameters key value pair, with field name as key, and mixed value
     */
    public function __construct(array $parameters)
    {
        foreach ($parameters as $fieldName => $fieldValue) {
            $this->{'set'.$fieldName}($fieldValue);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getA(): int
    {
        return $this->a;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getC(): int
    {
        return $this->c;
    }

    private function setId(int $id): void
    {
        $this->id = $id;
    }

    private function setA(int $a): void
    {
        $this->a = $a;
    }

    private function setB(int $b): void
    {
        $this->b = $b;
    }

    private function setC(int $c): void
    {
        $this->c = $c;
    }

    public static function getFieldNames(): array
    {
        return [
            static::FIELD_ID,
            static::FIELD_A,
            static::FIELD_B,
            static::FIELD_C,
        ];
    }
}
