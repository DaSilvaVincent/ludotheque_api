<?php

namespace Tests\Feature;

use Tests\TestCase;

class JeuTest extends TestCase {

    /**
     * A test for index adherent game.
     */
    public function test_jeu_index_adherent(): void {
        $response = $this->post('/api/loginVisitor', [
            'email' => "vincentAdmin@domain.fr",
            'password' => 'UnSecret',
        ]);

        $token = $response->json('token');

        $response = $this->get('/api/jeu/indexAdherent', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
    }

    /**
     * A test for update url game.
     */
    public function test_jeu_update_url(): void {
        $response = $this->post('/api/loginVisitor', [
            'email' => "vincentAdmin@domain.fr",
            'password' => 'UnSecret',
        ]);

        $token = $response->json('token');

        $response = $this->put('/api/jeu/updateUrl/4', [
            'Authorization' => 'Bearer ' . $token, 'url_media' => 'https://ouistiti.fr'
        ]);

        $response->assertStatus(200);
        $response->assertContent('{"status":"success","message":"Game url media updated successfully!","url_media":"https:\/\/ouistiti.fr"}');
    }
}
