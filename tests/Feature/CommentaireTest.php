<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentaireTest extends TestCase{

    /**
     * A test for delete commentary.
     */
    public function test_commentaire_delete(): void {
        exec('php artisan migrate:fresh');
        exec('php artisan db:seed');

        $response = $this->post('/api/loginVisitor', [
            'email' => "vincentAdmin@domain.fr",
            'password' => 'UnSecret',
        ]);

        $token = $response->json('token');

        $response = $this->delete('/api/commentaires/deleteCommentaire/3', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertContent('{"status":"success","message":"Comment successfully deleted"}');
    }
}
