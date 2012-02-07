<?php

namespace Acme\TransportBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/TransportBundle/');
        $this->assertTrue($crawler->filter('html:contains("Swift_NullTransport")')->count() === 1);
        $this->assertTrue($crawler->filter('html:contains("Swift_Transport_NullTransport")')->count() === 1);
    }
}
