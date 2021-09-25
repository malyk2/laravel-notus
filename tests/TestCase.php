<?php

namespace Tests;

use Mockery;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // /**
    //  * @inheritdoc
    //  * */
    // public function tearDown(): void
    // {
    //     Mockery::close();
    //     parent::tearDown();
    // }
}
