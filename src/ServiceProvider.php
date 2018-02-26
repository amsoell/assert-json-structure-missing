<?php

namespace Amsoell\AssertJsonStructureMissing;

use Illuminate\Foundation\Testing\TestResponse;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        TestResponse::macro('assertJsonStructureMissing', function (array $structure = null, $responseData = null) {
            if (is_null($structure)) {
                return $this->assertJson($this->json());
            }

            if (is_null($responseData)) {
                $responseData = $this->decodeResponseJson();
            }

            foreach ($structure as $key => $value) {
                if (is_array($value) && $key === '*') {
                    \PHPUnit\Framework\Assert::assertInternalType('array', $responseData);

                    foreach ($responseData as $responseDataItem) {
                        $this->assertJsonStructureMissing($structure['*'], $responseDataItem);
                    }
                } elseif (is_array($value)) {
                    \PHPUnit\Framework\Assert::assertArrayHasKey($key, $responseData);

                    $this->assertJsonStructureMissing($structure[$key], $responseData[$key]);
                } else {
                    \PHPUnit\Framework\Assert::assertArrayNotHasKey($value, $responseData);
                }
            }

            return $this;
        });
    }
}
