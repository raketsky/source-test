<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends SymfonyAbstractController
{
    protected function renderTemplate(string $view, array $parameters = [], Response $response = null): Response
    {
        return parent::render($view.'.twig', $parameters, $response);
    }
}
