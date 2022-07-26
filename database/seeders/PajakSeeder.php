<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Pajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Item::all();
        $nama = ['pph','pajak toko'];
        $rate = [5,10];

        for ($i=0; $i < count($nama); $i++) {

            foreach ($data as $key ) {
                $pajak = new Pajak();
                $pajak->nama = $nama[$i];
                $pajak->rate = $rate[$i];
                $pajak->item_id = $key->id;
                $pajak->save();
            }
        }
    }
}