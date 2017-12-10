<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('countries')->truncate();
        Schema::enableForeignKeyConstraints();

        $json = file_get_contents('resources/assets/js/countries.json', true);

        $countries = [];
        $this->command->getOutput()->writeln("<fg=black;bg=green> Charging Countries ... </>");
        $this->command->getOutput()->progressStart(count(json_decode($json, true)));
        foreach (json_decode($json, true) as $country) {
            $countries[] = ['id'=>$country['id'], 'name'=>$country['name'], 'sortname'=>$country['sortname']];
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();

        $this->command->getOutput()->writeln("<fg=black;bg=green> Inserting Countries Chunks ... </>");
        $this->command->getOutput()->progressStart(count(array_chunk($countries, 50)));
        foreach (array_chunk($countries, 50) as $inserts) {
            DB::table('countries')->insert($inserts);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}