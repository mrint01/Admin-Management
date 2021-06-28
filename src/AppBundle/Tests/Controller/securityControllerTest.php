<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class securityControllerTest extends WebTestCase
{
    public function testRedirect()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/home');
    }

}
