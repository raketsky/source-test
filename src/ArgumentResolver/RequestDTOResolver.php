<?php
declare(strict_types=1);

namespace App\ArgumentResolver;

use App\Exception\ValidationException;
use App\Request\RequestDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RequestDTOResolver implements ArgumentValueResolverInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        $argumentType = $argument->getType();
        if (in_array($argumentType, [null, 'bool'])) {
            return false;
        }

        $reflection = new \ReflectionClass($argumentType);
        if ($reflection->implementsInterface(RequestDTOInterface::class)) {
            return true;
        }

        return false;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        // creating new instance of custom request ValueObject
        $class = $argument->getType();
        $dto = new $class($request);

        // throw bad request exception in case of invalid request data
        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            throw new ValidationException($errors, $dto);
        }

        yield $dto;
    }
}
