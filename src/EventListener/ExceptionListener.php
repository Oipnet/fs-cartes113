<?php
namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

class ExceptionListener
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[AsEventListener(event: ExceptionEvent::class)]
    public function onKernelException(ExceptionEvent $event): void
    {
        // Obtenez l'exception depuis l'événement
        $exception = $event->getThrowable();

        // Si l'exception est NotFoundHttpException, affichez votre page d'erreur personnalisée
        if ($exception instanceof NotFoundHttpException) {
            $response = new Response($this->twig->render('errors/error404.html.twig'));
            $event->setResponse($response);
        }
    }
}
