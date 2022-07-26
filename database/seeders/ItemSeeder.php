<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = (Object) ['shampoo','pembersih lantai', 'deterjen', 'baju batik', 'kaos casual', 'kaos singlet', 'baju bayi', 'celana jeans'];

        foreach ($data as $rs ) {
            $item = new Item();
            $item->nama = $rs;
            $item->save();
        }


    }
}