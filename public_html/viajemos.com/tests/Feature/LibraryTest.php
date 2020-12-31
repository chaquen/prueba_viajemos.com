<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Libro;

class LibraryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   
     public function testCreateBookExist()
    {
        $this->withExceptionHandling();
        $response = $this->post('/api/libro',[
            "ISBN" => "101012",
            "editoriales_id" => 1,
            "titulo" => "El relato de dorian grey",
            "sinopsis" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            "autor_id" => 1,
            "n_paginas" => 1
        ]);
        $response->assertOk();
    }
    public function testGetOneBook()
    {
        $response = $this->get('/api/libro/101011');
        $response->assertOk();   
    }
    public function testGetBooks()
    {
        $response = $this->get('/api/libro');
        $response->assertOk();   
    }
}
