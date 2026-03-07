<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

#[AsController]
readonly class HomeController
{
    public function __construct(
        private Environment $twig
    )
    {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/', name: 'home', methods: ['GET'])]
    public function __invoke()
    {
        return new Response($this->twig->render('home.html.twig'));
    }
}
