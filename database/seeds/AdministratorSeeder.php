<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;    
        $administrator->username = 'fajar7xx';
        $administrator->name = 'site admin';
        $administrator->email = 'fajar7xx@larashop.test';
        $administrator->roles = json_encode(['ADMIN']);
        $administrator->password = \Hash::make('azhari30');
        $administrator->avatar = 'no.jpg';
        $administrator->address = 'Medan, Sumatera Utara';
        $administrator->phone = '081265324212';

        $administrator->save();

        $this->command->info('user admin berhasil di insert');
    }
}
