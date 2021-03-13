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
        DB::table('sites')->insert([
            ['name' => 'Colamonico'],
            ['name' => 'Chiarulli']
        ]);

        $classes = [
            ["year"=>1,"section"=>"A","course"=>"AFM","site_id"=> 1],
            ["year"=>1,"section"=>"A","course"=>"INF","site_id"=> 1],
            ["year"=>1,"section"=>"B","course"=>"INF","site_id"=> 1],
            ["year"=>1,"section"=>"C","course"=>"INF","site_id"=> 1],
            ["year"=>1,"section"=>"A","course"=>"MAT","site_id"=> 1],
            ["year"=>1,"section"=>"A","course"=>"MiI","site_id"=> 1],
            ["year"=>1,"section"=>"A","course"=>"TCM","site_id"=> 1],
            ["year"=>1,"section"=>"A","course"=>"TUR","site_id"=> 1],
            ["year"=>2,"section"=>"A","course"=>"AFM","site_id"=> 1],
            ["year"=>2,"section"=>"B","course"=>"AFM","site_id"=> 1],
            ["year"=>2,"section"=>"A","course"=>"INF","site_id"=> 1],
            ["year"=>2,"section"=>"B","course"=>"INF","site_id"=> 1],
            ["year"=>2,"section"=>"A","course"=>"MAT","site_id"=> 1],
            ["year"=>2,"section"=>"B","course"=>"MAT","site_id"=> 1],
            ["year"=>2,"section"=>"A","course"=>"MiI","site_id"=> 1],
            ["year"=>2,"section"=>"A","course"=>"TCM","site_id"=> 1],
            ["year"=>2,"section"=>"A","course"=>"TUR","site_id"=> 1],
            ["year"=>3,"section"=>"A","course"=>"AFM","site_id"=> 1],
            ["year"=>3,"section"=>"B","course"=>"AFM","site_id"=> 1],
            ["year"=>3,"section"=>"S","course"=>"AFM","site_id"=> 1],
            ["year"=>3,"section"=>"A","course"=>"INF","site_id"=> 2],
            ["year"=>3,"section"=>"B","course"=>"INF","site_id"=> 2],
            ["year"=>3,"section"=>"A","course"=>"MAT","site_id"=> 2],
            ["year"=>3,"section"=>"B","course"=>"MAT","site_id"=> 2],
            ["year"=>3,"section"=>"S","course"=>"MAT","site_id"=> 2],
            ["year"=>3,"section"=>"A","course"=>"MiI","site_id"=> 2],
            ["year"=>3,"section"=>"S","course"=>"PIA","site_id"=> 2],
            ["year"=>3,"section"=>"A","course"=>"TBS","site_id"=> 2],
            ["year"=>3,"section"=>"A","course"=>"TUR","site_id"=> 2],
            ["year"=>4,"section"=>"A","course"=>"AFM","site_id"=> 2],
            ["year"=>4,"section"=>"S","course"=>"AFM","site_id"=> 2],
            ["year"=>4,"section"=>"A","course"=>"AIS","site_id"=> 2],
            ["year"=>4,"section"=>"A","course"=>"INF","site_id"=> 2],
            ["year"=>4,"section"=>"B","course"=>"INF","site_id"=> 2],
            ["year"=>4,"section"=>"S","course"=>"MAT","site_id"=> 2],
            ["year"=>4,"section"=>"A","course"=>"MMT","site_id"=> 2],
            ["year"=>4,"section"=>"S","course"=>"PIA","site_id"=> 2],
            ["year"=>4,"section"=>"A","course"=>"PTS","site_id"=> 2],
            ["year"=>4,"section"=>"B","course"=>"PTS","site_id"=> 2],
            ["year"=>4,"section"=>"A","course"=>"RIM","site_id"=> 2],
            ["year"=>4,"section"=>"A","course"=>"TBS","site_id"=> 2],
            ["year"=>4,"section"=>"A","course"=>"TUR","site_id"=> 2],
            ["year"=>5,"section"=>"A","course"=>"AFM","site_id"=> 2],
            ["year"=>5,"section"=>"B","course"=>"AFM","site_id"=> 2],
            ["year"=>5,"section"=>"S","course"=>"AFM","site_id"=> 2],
            ["year"=>5,"section"=>"A","course"=>"AIS","site_id"=> 2],
            ["year"=>5,"section"=>"A","course"=>"INF","site_id"=> 2],
            ["year"=>5,"section"=>"S","course"=>"MAT","site_id"=> 2],
            ["year"=>5,"section"=>"A","course"=>"MMT","site_id"=> 2],
            ["year"=>5,"section"=>"A","course"=>"PTS","site_id"=> 2],
            ["year"=>5,"section"=>"A","course"=>"TBS","site_id"=> 2],
            ["year"=>5,"section"=>"A","course"=>"TUR","site_id"=> 2]
        ];


        DB::table('classes')->insert($classes);
    }
}
