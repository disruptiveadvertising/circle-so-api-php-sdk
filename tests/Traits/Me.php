<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Traits;

use AdroSoftware\CircleSoSdk\Exception\{
    RequestUnauthorizedException,
};
use GuzzleHttp\Psr7\Response;

trait Me
{
    public function test_get_me(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('me')),
        ]);

        $me = $circleSo->me()->info();

        $this->assertArrayHasKey('id', $me);

        $this->assertSame(1, $me['id']);
        $this->assertSame('Adro', $me['first_name']);
    }

    public function test_get_me_not_authorized(): void
    {
        $this->expectException(RequestUnauthorizedException::class);
        $this->expectExceptionMessage('Your account could not be authenticated.');
        $this->expectExceptionCode(500);

        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('unauthorized')),
        ]);

        $circleSo->me()->info();
    }
}
