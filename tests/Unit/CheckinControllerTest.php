<?php

namespace Tests\Unit;

use Tests\TestCase;
use findparking\User;
use findparking\Slot;
use findparking\Parking;
use findparking\Administrator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckinControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function checkIn()
    {
        $user = new User;
        $user->name = 'user_test';
        $user->first_name = 'user';
        $user->last_name = 'test';
        $user->email = 'user_test@test.com';
        $user->mobile_number = '000000000';
        $user->password = bcrypt('12345678');
        $user->save();

        $admin = new Administrator;
        $admin->name = 'admin_test';
        $admin->administrator_first_name = 'admin';
        $admin->administrator_last_name = 'test';
        $admin->email = 'admin_test@test.com';
        $admin->password = bcrypt('12345678');
        $admin->save();

        $parking = new Parking;
        $parking->parking_name = 'parking_test';
        $parking->nit = '0000000';
        $parking->phone_number = '000000000';
        $parking->latitude = '0.0124588974';
        $parking->longitude = '-1.12154878';
        $parking->address = 'false street';
        $parking->services = 'Washing and restuarant';
        $parking->schedule = 'Monday to Friday from 5am to 8pm';
        $parking->administrator_id = $admin->id;
        $parking->save();

        $slots = [];
        for ($i=1; $i<=5; $i++) {
            $slot = new Slot;
            $slot->slot_name = "A" . $i;
            $slots[] = $slot;
        }

        $parking->slots()->saveMany($slots);

        $vehicle = new Vehicle;
        $vehicle->last_digit = 'TST109';
        $vehicle->is_active = 1;
        $vehicle->color_id = 1;
        $vehicle->brand_id = 1;
        $vehicle->user_id = $user->id;
        $vehicle->vehicle_type_id = 1;
        $vehicle->save();

        $response = $this->call('POST', '/checkin/store', ['parking_id' => $parking->id]);

        $response->assertStatus(200);

        $vehicle->delete();
        $parking->slots()->delete();
        $parking->delete();
        $admin->delete();
        $user->delete();

        $this->assertTrue(true);
    }
}
