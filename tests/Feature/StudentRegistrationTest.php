<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StudentRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_register(): void
    {
        $profilePicture = UploadedFile::fake()->image('profile.jpg');

        $response = $this->post('/students/register', [
            'student_id' => 'TEST-0001',
            'first_name' => 'Juan',
            'middle_name' => 'Dela',
            'last_name' => 'Cruz',
            'email' => 'juan.test@example.com',
            'mobile_number' => '09171234567',
            'date_of_birth' => '2005-05-15',
            'gender' => 'Male',
            'program' => 'BS Information Technology',
            'year_level' => '1st Year',
            'address' => 'Manila, Philippines',
            'profile_picture' => $profilePicture,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('students', [
            'student_id' => 'TEST-0001',
            'email' => 'juan.test@example.com',
        ]);
    }
}
