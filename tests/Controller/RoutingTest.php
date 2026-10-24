<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Checks routing, localization and security without needing a database.
 */
class RoutingTest extends WebTestCase
{
    public static function aboutUrls(): iterable
    {
        yield ['/about'];
        yield ['/fr/about'];
    }

    #[DataProvider('aboutUrls')]
    public function testAboutRedirectsToPersonalWebsite(string $url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseStatusCodeSame(301);
        $this->assertResponseRedirects('https://baptiste.candellier.me');
    }

    public function testTrailingSlashRedirectsToCanonicalUrl(): void
    {
        $client = static::createClient();
        $client->request('GET', '/projects/foo/');

        $this->assertResponseRedirects('http://localhost/projects/foo', 301);
    }

    public function testRoutesAreLocalized(): void
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');

        $this->assertSame('/projects/foo', $router->generate('project', ['project' => 'foo', '_locale' => 'en']));
        $this->assertSame('/fr/projects/foo', $router->generate('project', ['project' => 'foo', '_locale' => 'fr']));
        $this->assertSame('/fr/', $router->generate('home', ['_locale' => 'fr']));
    }

    public function testEnglishIsNotPrefixed(): void
    {
        $client = static::createClient();
        $client->request('GET', '/en/about');

        $this->assertResponseStatusCodeSame(404);
    }

    public function testAdminRequiresAuthentication(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testAdminRejectsWrongPassword(): void
    {
        $client = static::createClient([], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => 'wrong']);
        $client->request('GET', '/admin');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testAdminRedirectsToProjects(): void
    {
        $client = static::createClient([], ['PHP_AUTH_USER' => 'admin', 'PHP_AUTH_PW' => 'test-password']);
        $client->request('GET', '/admin');

        $this->assertResponseRedirects('/admin/project');
    }
}
