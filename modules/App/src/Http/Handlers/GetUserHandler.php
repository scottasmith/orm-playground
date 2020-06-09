<?php

declare(strict_types=1);

namespace App\Http\Handlers;

use App\Services\UserManager;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Uri;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetUserHandler
{
    /**
     * @var UserManager
     */
    private UserManager $userManager;

    /**
     * GetUserHandler constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getQueryParams();
        if (!isset($queryParams['username'])) {
            return new RedirectResponse(new Uri('/'));
        }

        $username = $queryParams['username'];

        $user = $this->userManager->findByUsername($username);
        if (!$user) {
            $response->getBody()->write("User with username ${username} not found");
            return $response;
        }

        dd($user);
    }
}
