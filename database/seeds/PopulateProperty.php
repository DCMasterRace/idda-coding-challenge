<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use League\Csv\Statement;

class PopulateProperty extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $csv = Reader::createFromPath(base_path().'/database/seeds/table1.csv', 'r');
        $csv->setHeaderOffset(0);

        /* $stmt = (new Statement()) */
        /*     ->offset(10) */
        /*     ->limit(25); */

        /* $records = $stmt->process($csv); */
        foreach ($csv as $record) {
            DB::table('properties')->insert([
                'id' => $record['Property Id'],
                'suburb' => $record['Suburb'],
                'state' => $record['State'],
                'country' => $record['Counrty'],
            ]);
        }

        $csv = Reader::createFromPath(base_path().'/database/seeds/table2.csv', 'r');
        $csv->setHeaderOffset(0);

        /* $stmt = (new Statement()) */
        /*     ->offset(10) */
        /*     ->limit(25); */

        /* $records = $stmt->process($csv); */
        foreach ($csv as $record) {
            DB::table('analytic_types')->insert([
                'id' => $record['id'],
                'name' => $record['name'],
                'units' => $record['units'],
                'is_numeric' => $record['is_numeric'],
                'num_decimal_places' => $record['num_decimal_places'],
            ]);
        }

        $csv = Reader::createFromPath(base_path().'/database/seeds/table3.csv', 'r');
        $csv->setHeaderOffset(0);

        /* $stmt = (new Statement()) */
        /*     ->offset(10) */
        /*     ->limit(25); */

        /* $records = $stmt->process($csv); */
        foreach ($csv as $record) {
            DB::table('property_analytics')->insert([
                'property_id' => $record['property_id'],
                'analytic_type_id' => $record['anaytic_type_id'],
                'value' => $record['value'],
            ]);
        }
    }
}
