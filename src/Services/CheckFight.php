<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CheckFight
{
    private Request $request;
    private RouterInterface $router;
    private $session;

    public function _construct(Request $request, RouterInterface $router)
    {
        $this->request = $request;
        $this->router = $router;
        $this->session = $request->getSession();
    }

    public function checkIfInFight(): array
    {
        if($this->session->get('in fight') == 'yes')
        {
            return new RedirectResponse($this->router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        }
    }
}