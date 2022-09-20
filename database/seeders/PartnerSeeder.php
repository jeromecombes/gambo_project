<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$partners = [
	    ['Paris 3', 1, 1],
	    ['Paris 4', 2, 1],
	    ['Paris 7', 3, 1],
	    ['Paris 12', 4, 1],
	    ['CIPh', 5, 0],
	];

	foreach ($partners as $p) {
	    $partner = new Partner();
	    $partner->name = $p[0];
	    $partner->order = $p[1];
	    $partner->date = $p[2];
	    $partner->start = '20181';
	    $partner->end = 0;
	    $partner->save();
	}
    }
}
