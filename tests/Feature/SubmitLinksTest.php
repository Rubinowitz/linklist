<?php

namespace Tests\Feature;

use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitLinksTest extends TestCase
{
    use RefreshDatabase;
    public function loginWithFakeUser()
    {
        $user = new User([
            'id' => 1,
            'name' => 'yish'
        ]);

        $this->be($user);
    }

    /** @test */
    /*function guest_can_submit_a_new_link()
    {
        $response = $this->post('/link', [
            'title' => 'Example Title',
            'url' => 'http://example.com',
            'description' => 'Example description.',
            'user_id' => '1',
        ]);

        $this->assertDatabaseHas('links', [
            'title' => 'Example Title'
        ]);

        $response
            ->assertStatus(302)
            ->assertHeader('Location', url('/'));

        $this
            ->get('/')
            ->assertSee('Example Title');
    }*/
    function link_is_not_created_with_an_invalid_url()
    {
        $this->withoutExceptionHandling();
        $user = new User([
            'id' => 1,
            'name' => 'yish'
        ]);

        $this->be($user);

        $cases = ['//invalid-url.com', '/invalid-url', 'foo.com'];

        foreach ($cases as $case) {
            try {
                $response = $this->post('/link', [
                    'title' => 'Example Title',
                    'url' => $case,
                    'description' => 'Example description',
                    'user_id' => 1,
                ]);
            } catch (ValidationException $e) {
                $this->assertEquals(
                    'The url format is invalid.',
                    $e->validator->errors()->first('url')
                );
                continue;
            }

            $this->fail("The URL $case passed validation when it should have failed.");
        }
    }
    function link_is_not_created_if_validation_fails()
    {
        $response = $this->post('/link');

        $response->assertSessionHasErrors(['title', 'url', 'description']);
    }
}