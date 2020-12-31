<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateAutor()
    {
        $response = $this->post('/api/autor',[
            "nombre" => "un autor x",
            "apellidos" => "conunos apellidos y"
        ]);
        $response->assertOk();
    }
    public function testGetAutor()
    {
        $response = $this->get('/api/autor/2');
        $response->assertOk();
    }
    public function testGetAutors()
    {
        $response = $this->get('/api/autor');
        $response->assertOk();
    }
}
