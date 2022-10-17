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
	    ['Paris 3', 1, 1, 20181, 20221],
	    ['Paris 4', 2, 1, 20181, 20221],
	    ['Paris 7', 3, 1, 20181, 20221],
	    ['Paris 12', 4, 1, 20181, 20221],
	    ['Académie de Port Royal', 5, 0, 20181, 0],
	    ['CIPh', 6, 0, 20181, 0],
	    ['Sorbonne Nouvelle', 1, 1, 20222, 0],
	    ['Sorbonne Université', 1, 1, 20222, 0],
	    ['Paris Cité', 1, 1, 20222, 0],
	    ['UPEC', 1, 1, 20222, 0],
	];

	foreach ($partners as $p) {
	    $partner = new Partner();
	    $partner->name = $p[0];
	    $partner->order = $p[1];
	    $partner->date = $p[2];
	    $partner->start = $p[3];
	    $partner->end = $p[4] ?? 0;
	    $partner->save();
	}
    }
}
