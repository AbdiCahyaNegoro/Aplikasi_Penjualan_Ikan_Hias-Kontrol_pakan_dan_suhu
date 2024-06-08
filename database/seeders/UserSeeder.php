<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = "Abdi Cahya Negoro";
        $user->email = "abdicahyan@gmail.com";
        $user->password = bcrypt('12345');
        $user->leveluser = 1;
        $user->alamat = "Cikembar";
        $user->tanggallahir = "1994-12-08";
        $user->jeniskelamin = "L";
        $user->foto = "default.jpg";
        $user->folder = 'public/assets/img/user';
        $user->save();

        $user = new User;
        $user->name = "Pelanggan";
        $user->email = "pelanggan@gmail.com";
        $user->password = bcrypt('12345');
        $user->leveluser = 2;
        $user->alamat = "Cikembar";
        $user->tanggallahir = "1994-12-08";
        $user->jeniskelamin = "L";
        $user->foto = "default.jpg";
        $user->folder = 'public/assets/img/user';
        $user->save();
    }
}
