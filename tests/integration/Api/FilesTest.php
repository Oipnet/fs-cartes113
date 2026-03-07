<?php

namespace integration\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class FilesTest extends ApiTestCase
{
    public function testCreateGreeting(): void
    {
        static::createClient()->request('GET', '/files/test/1.jpeg');

        $this->assertResponseStatusCodeSame(200);
    }
}
