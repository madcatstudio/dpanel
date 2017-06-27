<?php

namespace Tests\Feature;

use App\Database;
use App\Domain;
use App\Email;
use App\Hosting;
use App\Maintainer;
use App\Subdomain;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageDomainsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function authenticated_user_can_create_a_domain()
    {
        $this->signIn();

        $hosting = factory(Hosting::class)->create();
        $maintainer = factory(Maintainer::class)->create();

        $this->json('POST', '/domains', [
            'name' => 'example.com',
            'registration_date' => $date = Carbon::now()->toDateTimeString(),
            'ip' => '250.6.12.10',
            'hosting_id' => $hosting->id,
            'maintainer_id' => $maintainer->id,
        ])->assertStatus(201);


        $this->assertDatabaseHas('domains', [
            'name' => 'example.com',
            'registration_date' => $date,
            'ip' => '250.6.12.10',
            'hosting_id' => $hosting->id,
            'maintainer_id' => $maintainer->id,
        ]);
    }

    /** @test */
    function authenticated_user_can_see_a_list_of_domains()
    {
        $this->signIn();

        factory(Domain::class)->create(['name' => 'example.com']);
        factory(Domain::class)->create(['name' => 'apple.com']);
        factory(Domain::class)->create(['name' => 'cnn.org']);

        $this->get('/domains')
            ->assertSee('example.com')
            ->assertSee('apple.com')
            ->assertSee('cnn.org');
    }

    /** @test */
    function authenticated_user_can_see_domains_information_formatted_for_humans()
    {
        $this->signIn();

        $hosting = factory(Hosting::class)->create(['name' => 'hoster']);
        $maintainer = factory(Maintainer::class)->create(['name' => 'mainter']);

        $domain = factory(Domain::class)->create([
            'name' => 'example.com',
            'registration_date' => '2016-10-22 12:50:31',
            'ip' => '250.6.12.10',
            'hosting_id' => $hosting->id,
            'maintainer_id' => $maintainer->id,
        ]);

        factory(Email::class, 1)->create(['domain_id' => $domain->id, 'name' => 'test-email']);
        factory(Database::class, 1)->create(['domain_id' => $domain->id, 'name' => 'test-database']);
        factory(Subdomain::class, 1)->create(['domain_id' => $domain->id, 'name' => 'test-subdomain']);

        $this->get('/domains/' . $domain->id)
            ->assertSee('example.com')
            ->assertSee('22/10/2016')
            ->assertSee('250.6.12.10')
            ->assertSee('hoster')
            ->assertSee('mainter')
            ->assertSee('test-email@example.com')
            ->assertSee('test-database')
            ->assertSee('test-subdomain.example.com');
    }

    /** @test */
    function authenticated_user_can_edit_a_domain()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create([
            'name' => 'example.com',
            'ip' => '168.58.24.12',
            'registration_date' => '2014-11-05 12:45:12',
            'hosting_id' => 1,
            'maintainer_id' => 1,
        ]);
        $this->assertEquals('example.com', $domain->name);
        $this->assertEquals('168.58.24.12', $domain->ip);
        $this->assertEquals('2014-11-05 12:45:12', $domain->registration_date);
        $this->assertEquals(1, $domain->hosting_id);
        $this->assertEquals(1, $domain->maintainer_id);

        $this->json('PATCH', '/domains/' . $domain->id, [
            'name' => 'newdomain.org',
            'ip' => '192.168.5.8',
            'registration_date' => '2017-08-22 16:05:10',
            'hosting_id' => 2,
            'maintainer_id' => 1,
        ])->assertStatus(201);

        $this->assertEquals('newdomain.org', $domain->fresh()->name);
        $this->assertEquals('192.168.5.8', $domain->fresh()->ip);
        $this->assertEquals('2017-08-22 16:05:10', $domain->fresh()->registration_date);
        $this->assertEquals(2, $domain->fresh()->hosting_id);
        $this->assertEquals(1, $domain->fresh()->maintainer_id);
    }

    /** @test */
    function authenticated_user_can_delete_a_domain()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $email = factory(Email::class)->create(['domain_id' => $domain->id]);
        $database = factory(Database::class)->create(['domain_id' => $domain->id]);
        $subdomain = factory(Subdomain::class)->create(['domain_id' => $domain->id]);
        $this->assertDatabaseHas('domains', ['id' => $domain->id]);
        $this->assertDatabaseHas('emails', ['id' => $email->id]);
        $this->assertDatabaseHas('databases', ['id' => $database->id]);
        $this->assertDatabaseHas('subdomains', ['id' => $subdomain->id]);

        $this->json('DELETE', '/domains/' . $domain->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('domains', ['id' => $domain->id]);
        $this->assertDatabaseMissing('emails', ['id' => $email->id]);
        $this->assertDatabaseMissing('databases', ['id' => $database->id]);
        $this->assertDatabaseMissing('subdomains', ['id' => $subdomain->id]);
    }
}
