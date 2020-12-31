<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditorialTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateEditorialExist()
    {
        $this->withExceptionHandling();
        $response = $this->post('/api/editorial',[
            "nombre" => "prueba de editorial",
            "sede" => "sede"
        ]);
        $response->assertOk();
    }
    public function testGetOneEditorial()
    {
        $response = $this->get('/api/editorial/101011');
        $response->assertOk();   
    }
    public function testGetEdotorials()
    {
        $response = $this->get('/api/editorial');
        $response->assertOk();   
    }
}
