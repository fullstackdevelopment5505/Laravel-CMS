<?php

use Illuminate\Database\Seeder;
use App\Addon;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $add_on_name = $this->command->ask('Please enter addon name ?', 'ADDON');
        $admin_name = $this->command->ask('Please enter admin menu name ?', 'ADDON');
        Addon::where('add_on_constant', strtoupper($add_on_name))->delete();
        $url = "";
        if($add_on_name == 'REVIEW') {
            $url = "textla/addon/review";
        }
        Addon::create([
            'add_on_name' => $add_on_name,
            'add_on_constant' => strtoupper($add_on_name),
            'admin_route_param' => $url,
            'admin_route'=> $admin_name,
            'status'=>0,
        ]);
    }
}
