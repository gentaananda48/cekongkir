<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Daftar Provinsi dari RajaOngkir
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinceRow){
            Province::create([
                'province_id' => $provinceRow['province_id'],
                'title' => $provinceRow['province'],
            ]);
        

        // Daftar Kota dari Provinsi tersebut
        $daftarKota = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
        foreach ($daftarKota as $cityRow)
            City::create([
                'province_id' => $provinceRow['province_id'],
                'city_id' => $cityRow['city_id'],
                'title' => $cityRow['city_name'],
            ]);
        }

    }
}
