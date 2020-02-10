<?php

declare(strict_types=1);

namespace AppTest\Integration;

use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Uri;
use Mezzio\Authentication\UserInterface;
use PHPUnit\Framework\TestCase;

class OpenHomePageTest extends TestCase
{
    private $app;

    protected function setUp()
    {
        $this->app = AppFactory::create();
    }

    /*public function testOpenHomePageAsAguestRedirectToLoginPage()
    {
        $uri           = new Uri('/');
        $serverRequest = new ServerRequest([], [], $uri);

        $response = $this->app->handle($serverRequest);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->getHeaderLine('Location'));
    }*/

    public function testOpenHomePageAsAuserGotOK()
    {
        $sessionData                    = [
            'username' => 'samsonasik',
            'roles'    => [
                'user',
            ],
        ];
        $_SESSION[UserInterface::class] = $sessionData;

        $uri           = new Uri('/');
        $serverRequest = new ServerRequest([], [], $uri);

        $response = $this->app->handle($serverRequest);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function tearDown()
    {
        if (PHP_SESSION_ACTIVE === session_status()) {
            session_destroy();
        }
    }
}
