<?php

namespace Tests\Unit;

use App\Domain;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DomainTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function domains_list_can_be_ordered_by_name()
    {
        factory(Domain::class)->create(['name' => 'example.com']);
        factory(Domain::class)->create(['name' => 'apple.com']);
        factory(Domain::class)->create(['name' => 'cnn.org']);

        $response = Domain::orderBy('name')->get()->toArray();

        $this->assertEquals(['apple.com', 'cnn.org', 'example.com'], array_column($response, 'name'));
    }
}
