<?php

namespace Acme\AndRoleVoterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function アクセスパターンデータ()
    {
        return array(
            array('',          '',     '/AndRoleVoterBundle/hello/test',   302, ''),
            array('',          '',     '/AndRoleVoterBundle/user/test',    302, ''),
            array('',          '',     '/AndRoleVoterBundle/private/test', 302, ''),
            array('role_a',    'pass', '/AndRoleVoterBundle/hello/test',   200, 'test in hello'),
            array('role_a',    'pass', '/AndRoleVoterBundle/user/test',    200, 'test in user'),
            array('role_a',    'pass', '/AndRoleVoterBundle/private/test', 403, ''),
            array('role_both', 'pass', '/AndRoleVoterBundle/hello/test',   200, 'test in hello'),
            array('role_both', 'pass', '/AndRoleVoterBundle/user/test',    200, 'test in user'),
            array('role_both', 'pass', '/AndRoleVoterBundle/private/test', 200, 'test in private'),
        );
    }

    /**
     * @test
     * @dataProvider アクセスパターンデータ
     */
    public function Voter動作テスト($username, $password, $url, $statusCode, $checkString)
    {
        $client = static::createClient();
        if (!empty($username)) {
            $form = $client->request('GET', '/AndRoleVoterBundle/login')->selectButton('login')->form();
            $form['_username'] = $username;
            $form['_password'] = $password;
            $client->submit($form);
        }

        $crawler = $client->request('GET', $url);
        $this->assertEquals($statusCode, $client->getResponse()->getStatusCode(), 'ステータスコードチェック');
        if (!empty($checkString)) {
            $this->assertTrue($crawler->filter('html:contains("'.$checkString.'")')->count() === 1, 'レスポンスチェック');
        }
    }

}
