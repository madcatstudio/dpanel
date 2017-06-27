<?php

namespace Tests\Feature;

use App\Database;
use App\Domain;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageDatabaseTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function authenticated_user_can_create_a_database_for_a_domain()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $this->assertEquals(0, $domain->databases()->count());

        $this->json('POST', '/databases', [
            'domain_id' => $domain->id,
            'name' => 'example-db',
            'username' => 'user-example-db',
            'password' => 'wS2dd02-s'
        ])->assertStatus(201);

        $this->assertEquals(1, $domain->databases()->count());
        $this->assertDatabaseHas('databases', [
            'domain_id' => $domain->id,
            'name' => 'example-db',
            'username' => 'user-example-db',
            'password' => 'wS2dd02-s'
        ]);
    }

    /** @test */
    function authenticated_user_can_edit_a_database()
    {
        $this->signIn();

        $database = factory(Database::class)->create([
            'domain_id' => 1,
            'name' => 'example',
            'username' => 'example-db',
            'password' => '54e21w',
        ]);
        $this->assertEquals('example', $database->name);

        $this->json('PATCH', '/databases/' . $database->id, [
            'domain_id' => 3,
            'name' => 'new-name',
            'username' => 'new-username-db',
            'password' => 'p23sdd',
        ])->assertStatus(201);

        $this->assertEquals(3, $database->fresh()->domain_id);
        $this->assertEquals('new-name', $database->fresh()->name);
        $this->assertEquals('new-username-db', $database->fresh()->username);
        $this->assertEquals('p23sdd', $database->fresh()->password);
    }

    /** @test */
    function authenticated_user_can_delete_a_database()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $database = factory(Database::class)->create(['domain_id' => $domain->id]);
        $this->assertEquals(1, $domain->databases()->count());
        $this->assertDatabaseHas('databases', ['domain_id' => $domain->id]);

        $this->json('DELETE', '/databases/' . $database->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('databases', ['domain_id' => $domain->id]);
        $this->assertEquals(0, $domain->databases()->count());
    }
}
