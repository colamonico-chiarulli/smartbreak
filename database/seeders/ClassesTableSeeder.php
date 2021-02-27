<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /*
array(
  array("Anno"=>1,"Sez"=>"A","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>1,"Sez"=>"A","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>1,"Sez"=>"B","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>1,"Sez"=>"C","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>1,"Sez"=>"A","Corso"=>"MAT","sede"=>"Chiarulli"),
  array("Anno"=>1,"Sez"=>"A","Corso"=>"MiI","sede"=>"Chiarulli"),
  array("Anno"=>1,"Sez"=>"A","Corso"=>"TCM","sede"=>"Colamonico"),
  array("Anno"=>1,"Sez"=>"A","Corso"=>"TUR","sede"=>"Colamonico"),
  array("Anno"=>2,"Sez"=>"A","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>2,"Sez"=>"B","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>2,"Sez"=>"A","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>2,"Sez"=>"B","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>2,"Sez"=>"A","Corso"=>"MAT","sede"=>"Chiarulli"),
  array("Anno"=>2,"Sez"=>"B","Corso"=>"MAT","sede"=>"Chiarulli"),
  array("Anno"=>2,"Sez"=>"A","Corso"=>"MiI","sede"=>"Chiarulli"),
  array("Anno"=>2,"Sez"=>"A","Corso"=>"TCM","sede"=>"Chiarulli"),
  array("Anno"=>2,"Sez"=>"A","Corso"=>"TUR","sede"=>"Colamonico"),
  array("Anno"=>3,"Sez"=>"A","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>3,"Sez"=>"B","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>3,"Sez"=>"S","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>3,"Sez"=>"A","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>3,"Sez"=>"B","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>3,"Sez"=>"A","Corso"=>"MAT","sede"=>"Chiarulli"),
  array("Anno"=>3,"Sez"=>"B","Corso"=>"MAT","sede"=>"Chiarulli"),
  array("Anno"=>3,"Sez"=>"S","Corso"=>"MAT","sede"=>"Chiarulli"),
  array("Anno"=>3,"Sez"=>"A","Corso"=>"MiI","sede"=>"Chiarulli"),
  array("Anno"=>3,"Sez"=>"S","Corso"=>"PIA","sede"=>"Chiarulli"),
  array("Anno"=>3,"Sez"=>"A","Corso"=>"TBS","sede"=>"Chiarulli"),
  array("Anno"=>3,"Sez"=>"A","Corso"=>"TUR","sede"=>"Colamonico"),
  array("Anno"=>4,"Sez"=>"A","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>4,"Sez"=>"S","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>4,"Sez"=>"A","Corso"=>"AIS","sede"=>"Chiarulli"),
  array("Anno"=>4,"Sez"=>"A","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>4,"Sez"=>"B","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>4,"Sez"=>"S","Corso"=>"MAT","sede"=>"Chiarulli"),
  array("Anno"=>4,"Sez"=>"A","Corso"=>"MMT","sede"=>"Chiarulli"),
  array("Anno"=>4,"Sez"=>"S","Corso"=>"PIA","sede"=>"Chiarulli"),
  array("Anno"=>4,"Sez"=>"A","Corso"=>"PTS","sede"=>"Chiarulli"),
  array("Anno"=>4,"Sez"=>"B","Corso"=>"PTS","sede"=>"Chiarulli"),
  array("Anno"=>4,"Sez"=>"A","Corso"=>"RIM","sede"=>"Colamonico"),
  array("Anno"=>4,"Sez"=>"A","Corso"=>"TBS","sede"=>"Chiarulli"),
  array("Anno"=>4,"Sez"=>"A","Corso"=>"TUR","sede"=>"Colamonico"),
  array("Anno"=>5,"Sez"=>"A","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>5,"Sez"=>"B","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>5,"Sez"=>"S","Corso"=>"AFM","sede"=>"Colamonico"),
  array("Anno"=>5,"Sez"=>"A","Corso"=>"AIS","sede"=>"Chiarulli"),
  array("Anno"=>5,"Sez"=>"A","Corso"=>"INF","sede"=>"Colamonico"),
  array("Anno"=>5,"Sez"=>"S","Corso"=>"MAT","sede"=>"Colamonico"),
  array("Anno"=>5,"Sez"=>"A","Corso"=>"MMT","sede"=>"Chiarulli"),
  array("Anno"=>5,"Sez"=>"A","Corso"=>"PTS","sede"=>"Chiarulli"),
  array("Anno"=>5,"Sez"=>"A","Corso"=>"TBS","sede"=>"Chiarulli"),
  array("Anno"=>5,"Sez"=>"A","Corso"=>"TUR","sede"=>"Colamonico")
);

    */
    public function run()
    {
        SchoolClass::create([
            'year' => 1,
            'section' => 'A',
            'course' => 'INF',
            'site' => 'colamonico'
        ]);

        SchoolClass::create([
            'year' => 2,
            'section' => 'A',
            'course' => 'RIM',
            'site' => 'colamonico'
        ]);

        SchoolClass::create([
            'year' => 3,
            'section' => 'A',
            'course' => 'TUR',
            'site' => 'colamonico'
        ]);

        SchoolClass::create([
            'year' => 4,
            'section' => 'A',
            'course' => 'RIM',
            'site' => 'colamonico'
        ]);
    }
}
