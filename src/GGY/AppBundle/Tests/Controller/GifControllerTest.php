<?php

namespace GGY\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GifControllerTest extends WebTestCase
{
    public function testGetgifs()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getGifs');
    }

}
