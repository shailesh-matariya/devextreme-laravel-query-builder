<?php

namespace ShaileshMatariya\DevextremeQueryBuilder\Tests;

use Orchestra\Testbench\TestCase;
use ShaileshMatariya\DevextremeQueryBuilder\DevextremeQueryBuilderFacade;
use ShaileshMatariya\DevextremeQueryBuilder\DevextremeQueryBuilderServiceProvider;
use ShaileshMatariya\DevextremeQueryBuilder\Tests\Models\DummyModel;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [DevextremeQueryBuilderServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function initial_check()
    {
        $filter = ["first_name", "contains", "End"];
        $response = DevextremeQueryBuilderFacade::model(DummyModel::class)->filter($filter)->get();
        dd($response);
    }
}
