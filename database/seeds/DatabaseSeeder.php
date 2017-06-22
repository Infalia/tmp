<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        // Users
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => mb_convert_case(str_random(10), MB_CASE_LOWER, "UTF-8").'@example.com',
            'password' => bcrypt('secret'),
        ]);


        // Accessibility categories
        for($i=0; $i<4; $i++) {
            DB::table('accessblty_cats')->insert([
                'id' => ($i+1),
            ]);
        }


        // Accessibility categories translations
        for($i=0; $i<4; $i++) {
            DB::table('accessblty_cat_translations')->insert([
                'accessblty_cat_id' => ($i+1),
                'name' => mb_convert_case(str_random(10), MB_CASE_TITLE, "UTF-8"),
                'locale' => 'en',
            ]);
        }
        for($i=0; $i<4; $i++) {
            DB::table('accessblty_cat_translations')->insert([
                'accessblty_cat_id' => ($i+1),
                'name' => mb_convert_case(str_random(10), MB_CASE_TITLE, "UTF-8"),
                'locale' => 'el',
            ]);
        }


        // Accessibility options
        for($i=0; $i<4; $i++) {
            for($j=0; $j<4; $j++) {
                DB::table('accessblty_opts')->insert([
                    'accessblty_cat_id' => ($i+1),
                ]);
            }
        }


        // Accessibility options translations
        for($i=0; $i<16; $i++) {
            DB::table('accessblty_opt_translations')->insert([
                'accessblty_opt_id' => ($i+1),
                'name' => mb_convert_case(str_random(10), MB_CASE_TITLE, "UTF-8"),
                'locale' => 'en',
            ]);
        }
        for($i=0; $i<16; $i++) {
            DB::table('accessblty_opt_translations')->insert([
                'accessblty_opt_id' => ($i+1),
                'name' => mb_convert_case(str_random(10), MB_CASE_TITLE, "UTF-8"),
                'locale' => 'el',
            ]);
        }
        
        
        // Initiative types
        for($i=0; $i<4; $i++) {
            DB::table('initiative_types')->insert([
                'id' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

	$typesArr = ['Offer', 'Demand'];
	
        // Initiative types translations
        for($i=0; $i<2; $i++) {
            DB::table('initiative_type_translations')->insert([
                'initiative_type_id' => ($i+1),
                'name' => $typesArr[$i],
                'locale' => 'en',
            ]);
        }
    }
}
