<?php

namespace Tests\Feature\Contacts;

use App\Models\Contact;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group contacts
 * @group contactList
 */
class ContactListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function canListContacts()
    {
        $user = User::factory()->withPersonalTeam()->create();
        Contact::factory(5)->create();

        $this->actingAs($user)
            ->get(route('contacts.index'))
            ->assertPropCount('contacts.data', 5);
    }
}
