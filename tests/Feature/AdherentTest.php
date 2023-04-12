<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdherentTest extends TestCase{

    /**
     * A test for give information of profil adherent.
     */
    public function test_adherent_afficher_profil(): void {
        $response = $this->post('/api/loginVisitor', [
            'email' => "vincentAdmin@domain.fr",
            'password' => 'UnSecret',
        ]);

        $token = $response->json('token');

        $response = $this->get('/api/adherent/1', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
    }

    /**
     * A test for Update avatar adherent.
     */
    public function test_adherent_modifier_avatar(): void {
        $response = $this->post('/api/loginVisitor', [
            'email' => "vincentAdmin@domain.fr",
            'password' => 'UnSecret',
        ]);

        $token = $response->json('token');

        $response = $this->put('/api/adherent/1/avatar', [
            'Authorization' => 'Bearer ' . $token, 'avatar' => 'images/avatar/avatar-4.png'
        ]);

        $response->assertStatus(200);
    }
}
