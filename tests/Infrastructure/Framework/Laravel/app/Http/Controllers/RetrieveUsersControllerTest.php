<?php
declare(strict_types=1);

namespace Tests\Infrastructure\Framework\Laravel\App\Http\Controllers;

use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Session;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class RetrieveUsersControllerTest extends TestCase
{
    /** @var  Session $session */
    private $session;

    private const URL           = 'http://172.17.0.2:8181';
    private const URL_NEW_USER  = self::URL . '/users/new';
    private const URL_STATS     = self::URL . '/stats';

    protected function setUp(): void
    {
        parent::setUp();

        $driver = new GoutteDriver();

        $this->session = new Session($driver);

        $this->session->start();

        $this->session->visit(self::URL);

    }
    public function testItReturnsValidPage()
    {
        $page = $this->session->getPage();

        $content = $page->getContent();

        Assert::assertContains('<table', $content);

    }

    public function testItRedirectsToNewUserOnClick()
    {
        $page = $this->session->getPage();

        $page->clickLink('link_to_new_user');

        Assert::assertSame(self::URL_NEW_USER, $this->session->getCurrentUrl());
    }

    public function testItRedirectsToStatsOnClick()
    {
        $page = $this->session->getPage();

        $page->clickLink('link_to_stats');

        Assert::assertSame(self::URL_STATS, $this->session->getCurrentUrl());
    }

    public function testItRedirectsToUsersOnClick()
    {

        $page = $this->session->getPage();

        $page->clickLink('link_to_users');

        Assert::assertSame(self::URL, $this->session->getCurrentUrl());
    }
}
