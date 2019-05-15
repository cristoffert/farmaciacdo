<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::create([
            $dato = new User();
            $dato->name="Cristian Fernando Alvarez Trujillo";
            $dato->tipo_documento_id=1;
            $dato->number_id=1;
            $dato->address="zenteno";
            $dato->phone="545454";
            $dato->celular="973182744";
            $dato->email="juancagb.17@gmail.com";
            $dato->password=bcrypt('123123');
            $dato->estado="1";
            $dato->perfil_id=1;
            $dato->bodega_id=1;
            //$dato->admin=true;
            $dato->save();
      //  ]);
    }
}
