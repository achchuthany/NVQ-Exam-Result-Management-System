<?php

use App\Nvq;
use Illuminate\Database\Seeder;

class NvqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nvq = new Nvq();
        $nvq->name = "NVQ Level 3";
        $nvq->save();

        $nvq = new Nvq();
        $nvq->name = "NVQ Level 4";
        $nvq->save();

        $nvq = new Nvq();
        $nvq->name = "NVQ Level 5";
        $nvq->save();
        $nvq = new Nvq();
        $nvq->name = "NVQ Level 6";
        $nvq->save();
        $nvq = new Nvq();
        $nvq->name = "NVQ Level 7";
        $nvq->save();
        $nvq = new Nvq();
        $nvq->name = "Non-NVQ Bridging";
        $nvq->save();
    }
}
