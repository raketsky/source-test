<?php
declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationException extends \Exception
{
    private const MESSAGE = 'Object "%s" validation failed with following errors "%s"';

    /**
     * @var ConstraintViolationListInterface
     */
    private ConstraintViolationListInterface $errors;

    public function __construct(ConstraintViolationListInterface $errors, object $object, int $code = 0, \Throwable $previous = null)
    {
        $this->errors = $errors;
        $violationMessages = $this->formatMessageString($errors);

        parent::__construct(sprintf(static::MESSAGE, get_class($object), $violationMessages), $code, $previous);
    }

    private function formatMessageString(ConstraintViolationListInterface $errors): string
    {
        $message = '';
        /**
         * @var ConstraintViolationInterface $error
         */
        foreach ($errors as $error) {
            $message .= sprintf('"%s": %s; ', $error->getPropertyPath(), $error->getMessage());
        }

        return trim($message);
    }
}
