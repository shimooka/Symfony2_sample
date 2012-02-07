<?php

namespace Acme\ResponseListenerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function getExtensionData()
    {
        return array(
            array('', 'text/html', 200),
            array('html', 'text/html', 200),
            array('json', 'application/json', 200),
            array('xml', 'text/xml', 200),
            array('csv', 'application/octet-stream; name=ResponseListenerBundle.csv', 200),
            array('invalid', 'text/html', 404),
        );
    }


    public function testDefault()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/ResponseListenerBundle/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), 'ステータスコードチェック');
        $this->assertEquals('text/html', $client->getResponse()->headers->get('Content-Type'), 'Content-Typeチェック');
        $this->assertTrue($crawler->filter('html:contains("Hello ResponseListenerBundle")')->count() === 1);
    }

    /**
     * @dataProvider getExtensionData
     */
    public function testIndex($format, $content_type, $status_code)
    {
        $extension = ($format !== '' ? ".{$format}" : $format);
        $client = static::createClient();
        $crawler = $client->request('GET', '/ResponseListenerBundle/hello/ResponseListenerBundle' . $extension);
        $this->assertEquals($status_code, $client->getResponse()->getStatusCode(), 'ステータスコードチェック');
        $this->assertEquals($content_type, $client->getResponse()->headers->get('Content-Type'), 'Content-Typeチェック');

        if ($status_code === 200) {
            $extension = ($format !== '' ? ".{$format}" : ".html");
            $this->assertEquals(file_get_contents(__DIR__ . "/DefaultControllerTest_result{$extension}"), $client->getResponse()->getContent());
        }
    }
}
