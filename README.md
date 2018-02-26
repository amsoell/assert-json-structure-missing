# TestResponse::assertJsonStructureMissing

The `TestResponse::assertJsonStructureMissing` assertion works just like [TestResponse::assertJsonStructure](https://laravel.com/api/5.6/Illuminate/Foundation/Testing/TestResponse.html#method_assertJsonStructure), except that it tests for the absence of a particular structure.

```
$response = $this->get('/data');
$response->assertJsonStructureMissing([
    'data' => [
        'related' => [
            '*' => [
                'attribute',
            ],
        ],
    ],
]);
```

Full credit for this package goes to [Behzad Shabani](https://github.com/behzadsh). This package just takes his [pull request](https://github.com/laravel/framework/pull/20435) and packages it up so it's super easy to add to your Laravel application.
