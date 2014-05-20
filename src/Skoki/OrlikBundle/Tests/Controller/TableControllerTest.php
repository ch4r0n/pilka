<?php

namespace Skoki\OrlikBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TableControllerTest extends WebTestCase
{
    public function testShowtable()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/table');
    }

}
