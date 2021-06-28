<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Login');
    }

    public function testLogout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Logout');
    }

}
