<?php

use Illuminate\Database\Seeder;

use App\Models\Settings;

class Default_Settings_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'setting_name' => 'Customer PIN',
            'setting_value' => true,
        ]);
    }
}
