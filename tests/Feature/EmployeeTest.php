<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function view_all_employees()
    {
        $employee = factory('App\Employee', 2)->create();

        $response = $this->get('/api/employees');

        $response->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id',
                    'name',
                    'lastname',
                    'birthday',
                    'email',
                    'ci',
                    'phone',
                    'cellphone',
                    'address',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    /** @test */
    public function view_specific_employee()
    {
        $employee = factory('App\Employee')->create();

        $response = $this->get('/api/employees/'.$employee->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'lastname',
                'birthday',
                'email',
                'ci',
                'phone',
                'cellphone',
                'address',
                'created_at',
                'updated_at'
            ]);
    }

    /** @test */
    public function create_an_employee()
    {
        $employee = [
            'name' => 'John',
            'lastname' => 'Doe',
            'birthday' => '2017-10-10',
            'email' => 'example@gmail.com',
            'ci' => '10203040',
            'phone' => '(591) 46410203',
            'cellphone' => '(591) 72565234',
            'address' => '698 Devante Plains Apt. 102'
        ];

        $response = $this->post('/api/employees', $employee);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'lastname',
                'birthday',
                'email',
                'ci',
                'phone',
                'cellphone',
                'address',
                'created_at',
                'updated_at'
            ])
            ->assertJson($employee);
    }

    /** @test */
    public function update_an_existing_employee()
    {
        $employee = factory('App\Employee')->create();

        $newEmployee = [
            'name' => 'John',
            'lastname' => 'Doe',
            'birthday' => '2017-10-10',
            'email' => 'example@gmail.com',
            'ci' => '10203040',
            'phone' => '(591) 46410203',
            'cellphone' => '(591) 72565234',
            'address' => '698 Devante Plains Apt. 102'
        ];

        $response = $this->put('/api/employees/'.$employee->id, $newEmployee);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'lastname',
                'birthday',
                'email',
                'ci',
                'phone',
                'cellphone',
                'address',
                'created_at',
                'updated_at'
            ])
            ->assertJson($newEmployee);
    }

    /** @test */
    public function delete_an_existing_employee()
    {
        $employee = factory('App\Employee')->create();

        $response = $this->delete('/api/employees/'.$employee->id);

        $response->assertStatus(200);
    }
}
