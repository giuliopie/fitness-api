<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttendeeTest extends TestCase
{
    /** @test */
    public function it_can_link_attendee_and_course()
    {
        $data = [
            'name' => $this->faker->name,
            'limitPartecipant' => 10,
            'active' => 1
        ];

        $this->post(route('create-course'), $data);
        
        $data = [
            'course_id' => 1,
            'trainer_id' => 2
        ];
        
        $this->post(route('link-attendee-course'), $data)
            ->assertStatus(200);
    }

    /** @test */
    public function it_cannot_link_attendee_and_course_if_course_is_full()
    {
        $data = [
            'name' => $this->faker->name,
            'limitPartecipant' => 1,
            'active' => 1
        ];

        $this->post(route('create-course'), $data);
        
        $data = [
            'course_id' => 1,
            'attendee_id' => 1
        ];
        
        $this->post(route('link-attendee-course'), $data);
        $this->post(route('link-attendee-course'), $data)
            ->assertStatus(302);
    }
}
