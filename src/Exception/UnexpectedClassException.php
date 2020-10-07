<?php
declare(strict_types=1);

namespace App\Exception;

final class UnexpectedClassException extends \InvalidArgumentException implements AppExceptionInterface
{
    private const MESSAGE = 'Expected: "%s"; got: "%s"';

    /**
     * @param $expectedClassName
     * @param mixed $received values received
     */
    public function __construct($expectedClassName, $received)
    {
        $receivedClass = '';

        switch (true) {
            case is_object($received):
                $receivedClass = get_class($received);
                break;
            case is_array($received):
                $receivedClass = 'array';
                break;
        }

        parent::__construct(sprintf(static::MESSAGE, $expectedClassName, $receivedClass));
    }
}
