<?php

namespace Tests\Feature;

use App\Domain;
use App\Email;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageEmailTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function authenticated_user_can_create_email_for_a_domain()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $this->assertEquals(0, $domain->emails()->count());

        $this->json('POST', '/emails', [
            'domain_id' => $domain->id,
            'name' => 'example',
            'password' => 'password-of-the-email',
        ])->assertStatus(201);

        $email = $domain->emails()->first();
        $this->assertEquals(1, $domain->emails()->count());
        $this->assertDatabaseHas('emails', [
            'domain_id' => $domain->id,
            'name' => 'example',
            'password' => 'password-of-the-email',
        ]);
        $this->assertEquals('example@' . $domain->name, $email->fullName);
    }

    /** @test */
    function authenticated_user_can_edit_an_email()
    {
        $this->signIn();

        $email = factory(Email::class)->create([
            'domain_id' => 1,
            'name' => 'example',
            'password' => '54e21w',
        ]);

        $this->json('PATCH', '/emails/' . $email->id, [
            'domain_id' => 3,
            'name' => 'new-name',
            'password' => 'p23sdd',
        ])->assertStatus(201);

        $this->assertEquals(3, $email->fresh()->domain_id);
        $this->assertEquals('new-name', $email->fresh()->name);
        $this->assertEquals('p23sdd', $email->fresh()->password);
    }

    /** @test */
    function authenticated_user_can_delete_an_email()
    {
        $this->signIn();

        $domain = factory(Domain::class)->create();
        $email = factory(Email::class)->create(['domain_id' => $domain->id]);
        $this->assertEquals(1, $domain->emails()->count());
        $this->assertDatabaseHas('emails', ['domain_id' => $domain->id]);

        $this->json('DELETE', '/emails/' . $email->id)
            ->assertStatus(201);

        $this->assertDatabaseMissing('emails', ['domain_id' => $domain->id]);
        $this->assertEquals(0, $domain->emails()->count());
    }
}
