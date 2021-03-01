<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $classes = [
            ["year"=>1,"section"=>"A","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>1,"section"=>"A","course"=>"INF","site"=>"Colamonico"],
            ["year"=>1,"section"=>"B","course"=>"INF","site"=>"Colamonico"],
            ["year"=>1,"section"=>"C","course"=>"INF","site"=>"Colamonico"],
            ["year"=>1,"section"=>"A","course"=>"MAT","site"=>"Chiarulli"],
            ["year"=>1,"section"=>"A","course"=>"MiI","site"=>"Chiarulli"],
            ["year"=>1,"section"=>"A","course"=>"TCM","site"=>"Colamonico"],
            ["year"=>1,"section"=>"A","course"=>"TUR","site"=>"Colamonico"],
            ["year"=>2,"section"=>"A","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>2,"section"=>"B","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>2,"section"=>"A","course"=>"INF","site"=>"Colamonico"],
            ["year"=>2,"section"=>"B","course"=>"INF","site"=>"Colamonico"],
            ["year"=>2,"section"=>"A","course"=>"MAT","site"=>"Chiarulli"],
            ["year"=>2,"section"=>"B","course"=>"MAT","site"=>"Chiarulli"],
            ["year"=>2,"section"=>"A","course"=>"MiI","site"=>"Chiarulli"],
            ["year"=>2,"section"=>"A","course"=>"TCM","site"=>"Chiarulli"],
            ["year"=>2,"section"=>"A","course"=>"TUR","site"=>"Colamonico"],
            ["year"=>3,"section"=>"A","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>3,"section"=>"B","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>3,"section"=>"S","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>3,"section"=>"A","course"=>"INF","site"=>"Colamonico"],
            ["year"=>3,"section"=>"B","course"=>"INF","site"=>"Colamonico"],
            ["year"=>3,"section"=>"A","course"=>"MAT","site"=>"Chiarulli"],
            ["year"=>3,"section"=>"B","course"=>"MAT","site"=>"Chiarulli"],
            ["year"=>3,"section"=>"S","course"=>"MAT","site"=>"Chiarulli"],
            ["year"=>3,"section"=>"A","course"=>"MiI","site"=>"Chiarulli"],
            ["year"=>3,"section"=>"S","course"=>"PIA","site"=>"Chiarulli"],
            ["year"=>3,"section"=>"A","course"=>"TBS","site"=>"Chiarulli"],
            ["year"=>3,"section"=>"A","course"=>"TUR","site"=>"Colamonico"],
            ["year"=>4,"section"=>"A","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>4,"section"=>"S","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>4,"section"=>"A","course"=>"AIS","site"=>"Chiarulli"],
            ["year"=>4,"section"=>"A","course"=>"INF","site"=>"Colamonico"],
            ["year"=>4,"section"=>"B","course"=>"INF","site"=>"Colamonico"],
            ["year"=>4,"section"=>"S","course"=>"MAT","site"=>"Chiarulli"],
            ["year"=>4,"section"=>"A","course"=>"MMT","site"=>"Chiarulli"],
            ["year"=>4,"section"=>"S","course"=>"PIA","site"=>"Chiarulli"],
            ["year"=>4,"section"=>"A","course"=>"PTS","site"=>"Chiarulli"],
            ["year"=>4,"section"=>"B","course"=>"PTS","site"=>"Chiarulli"],
            ["year"=>4,"section"=>"A","course"=>"RIM","site"=>"Colamonico"],
            ["year"=>4,"section"=>"A","course"=>"TBS","site"=>"Chiarulli"],
            ["year"=>4,"section"=>"A","course"=>"TUR","site"=>"Colamonico"],
            ["year"=>5,"section"=>"A","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>5,"section"=>"B","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>5,"section"=>"S","course"=>"AFM","site"=>"Colamonico"],
            ["year"=>5,"section"=>"A","course"=>"AIS","site"=>"Chiarulli"],
            ["year"=>5,"section"=>"A","course"=>"INF","site"=>"Colamonico"],
            ["year"=>5,"section"=>"S","course"=>"MAT","site"=>"Colamonico"],
            ["year"=>5,"section"=>"A","course"=>"MMT","site"=>"Chiarulli"],
            ["year"=>5,"section"=>"A","course"=>"PTS","site"=>"Chiarulli"],
            ["year"=>5,"section"=>"A","course"=>"TBS","site"=>"Chiarulli"],
            ["year"=>5,"section"=>"A","course"=>"TUR","site"=>"Colamonico"]
        ];


        DB::table('classes')->insert($classes);
    }
}
