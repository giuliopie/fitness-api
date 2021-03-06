<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    // AdminController@create
    public function it_can_create_an_admin()
    {
        $data = [
            'username' => $this->faker->username,
            'email' => $this->faker->email
        ];

        $this->post(route('create-admin'), $data)
            ->assertStatus(200)
            ->assertJson(["data" => true]);
    }

    /** @test */
    // CourseController@create
    public function it_can_create_a_course()
    {
        $data = [
            'name' => $this->faker->name,
            'limitPartecipant' => 10,
            'active' => 1
        ];
        
        $this->post(route('create-course'), $data)
            ->assertStatus(200)
            ->assertJson(["data" => true]);
    }

    /** @test */
    // CourseController@create
    public function it_can_create_more_courses_with_same_name()
    {
        $data = [
            'name' => $this->faker->name,
            'limitPartecipant' => 10,
            'active' => 1
        ];
        
        $this->post(route('create-course'), $data);
        $this->post(route('create-course'), $data)
            ->assertStatus(302);
    }

    /** @test */
    // TrainerController@create
    public function it_can_create_a_trainer()
    {
        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->name,
            'username' => $this->faker->username,
            'email' => $this->faker->email,
            'active' => 1
        ];
        
        $this->post(route('create-trainer'), $data)
            ->assertStatus(200)
            ->assertJson(['data' => true]);
    }

    /** @test */
    // TrainerController@create
    public function it_cannot_create_a_trainer_with_wrong_email()
    {
        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->name,
            'username' => $this->faker->username,
            'email' => "qwerty",
            'active' => 1
        ];
        
        $this->post(route('create-trainer'), $data)
            ->assertStatus(302);
    }

    /** @test */
    // TrainerController@create
    public function it_cannot_create_more_trainers_with_same_email()
    {
        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->name,
            'username' => $this->faker->username,
            'email' => 'g.piepoli@gmail.com',
            'active' => 1
        ];
        $this->post(route('create-trainer'), $data);
        $this->post(route('create-trainer'), $data)
            ->assertStatus(302);
    }

    /** @test */
    // CourseController@linkCourseToTrainer
    public function it_can_link_course_and_trainer()
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
        
        $this->post(route('link-course-trainer'), $data)
            ->assertStatus(200)
            ->assertJson(['data' => true]);
    }

    /** @test */
    // AttendeeController@create
    public function it_can_create_an_attendee()
    {
        $data = [
            'username' => $this->faker->username,
            'email' => $this->faker->email,
            'active' => 1
        ];
        
        $this->post(route('create-attendee'), $data)
            ->assertStatus(200)
            ->assertJson(['data' => true]);
    }

    /** @test */
    // AttendeeController@create
    public function it_cannot_create_an_attendee_with_wrong_email()
    {
        $data = [
            'username' => $this->faker->username,
            'email' => "prova.prova",
            'active' => 1
        ];
        
        $this->post(route('create-attendee'), $data)
            ->assertStatus(302);
    }

    /** @test */
    // AttendeeController@create
    public function it_cannot_create_more_attendees_with_same_email()
    {
        $data = [
            'username' => $this->faker->username,
            'email' => $this->faker->email,
            'active' => 1
        ];
        
        $this->post(route('create-attendee'), $data);
        $this->post(route('create-attendee'), $data)
            ->assertStatus(302);
    }

}