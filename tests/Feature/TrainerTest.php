<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrainerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_can_get_its_courses()
    {
        $data = [
            'trainer_id' => 1
        ];
        
        $this->get(route('get-courses-of-trainer'), $data)
            ->assertStatus(200)
            ->assertJson(['data' => true]);
    }
}
