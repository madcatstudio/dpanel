<?php

namespace Tests\Feature;

use App\Domain;
use App\Subdomain;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageSubdomainTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function authenticated_user_can_create_a_subdomain_for_a_domain()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $this->assertEquals(0, $domain->subdomains()->count());

        $this->json('POST', '/subdomains', [
            'domain_id' => $domain->id,
            'name' => 'example',
        ])->assertStatus(201);

        $subdomain = $domain->subdomains()->first();
        $this->assertEquals(1, $domain->subdomains()->count());
        $this->assertDatabaseHas('subdomains', [
            'domain_id' => $domain->id,
            'name' => 'example',
        ]);
        $this->assertEquals('example.' . $domain->name, $subdomain->fullUrl);
    }

    /** @test */
    function authenticated_user_can_edit_a_subdomain()
    {
        $this->signIn();

        $subdomain = factory(Subdomain::class)->create([
            'domain_id' => 1,
            'name' => 'example',
        ]);
        $this->assertEquals('example', $subdomain->name);

        $this->json('PATCH', '/subdomains/' . $subdomain->id, [
            'domain_id' => 2,
            'name' => 'new-subdomain',
        ])->assertStatus(201);


        $this->assertEquals(2, $subdomain->fresh()->domain_id);
        $this->assertEquals('new-subdomain', $subdomain->fresh()->name);
    }

    /** @test */
    function authenticated_user_can_delete_a_subdomain()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $subdomain = factory(Subdomain::class)->create(['domain_id' => $domain->id]);
        $this->assertEquals(1, $domain->subdomains()->count());
        $this->assertDatabaseHas('subdomains', ['domain_id' => $domain->id]);

        $this->json('DELETE', '/subdomains/' . $subdomain->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('subdomains', ['domain_id' => $domain->id]);
        $this->assertEquals(0, $domain->subdomains()->count());
    }
}
