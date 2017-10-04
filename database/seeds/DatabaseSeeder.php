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





        // Accessibility categories
        $accessibilityCategories = array(0 => array('id' => 1, 'name' => 'Website colours'),
                                         1 => array('id' => 2, 'name' => 'Font size'),
                                         2 => array('id' => 3, 'name' => 'Accessibility optimization'));

        for($i=0; $i<count($accessibilityCategories); $i++) {
            DB::table('accessblty_cats')->insert([
                'id' => $accessibilityCategories[$i]['id'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Accessibility categories translations
        for($i=0; $i<count($accessibilityCategories); $i++) {
            DB::table('accessblty_cat_translations')->insert([
                'id' => ($i+1),
                'accessblty_cat_id' => $accessibilityCategories[$i]['id'],
                'name' => $accessibilityCategories[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Accessibility options
        $accessibilityOptions = array(0 => array('id' => 1, 'cat_id' => 1, 'name' => 'Coloured version (normal)'),
                                      1 => array('id' => 2, 'cat_id' => 1, 'name' => 'High Contrast'),
                                      2 => array('id' => 3, 'cat_id' => 1, 'name' => 'Shades of grey'),
                                      3 => array('id' => 4, 'cat_id' => 1, 'name' => 'Neutral colors'),
                                      4 => array('id' => 5, 'cat_id' => 2, 'name' => 'Normal font size'),
                                      5 => array('id' => 6, 'cat_id' => 2, 'name' => 'Small font size'),
                                      6 => array('id' => 7, 'cat_id' => 2, 'name' => 'Large font size'),
                                      7 => array('id' => 8, 'cat_id' => 2, 'name' => 'Very large font size'),
                                      8 => array('id' => 9, 'cat_id' => 3, 'name' => 'No accessibility optimization'),
                                      9 => array('id' => 10, 'cat_id' => 3, 'name' => 'Blind users (using a screen reader)'),
                                      10 => array('id' => 11, 'cat_id' => 3, 'name' => 'For users with glaucoma'));

        for($i=0; $i<count($accessibilityOptions); $i++) {
            DB::table('accessblty_opts')->insert([
                'id' => $accessibilityOptions[$i]['id'],
                'accessblty_cat_id' => $accessibilityOptions[$i]['cat_id'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Accessibility options translations
        for($i=0; $i<count($accessibilityOptions); $i++) {
            DB::table('accessblty_opt_translations')->insert([
                'id' => ($i+1),
                'accessblty_opt_id' => $accessibilityOptions[$i]['id'],
                'name' => $accessibilityOptions[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        

        // Initiative types
        $initiativeTypes = array(0 => array('id' => 1, 'name' => 'Offers'),
                                 1 => array('id' => 2, 'name' => 'Demands'));

        for($i=0; $i<count($initiativeTypes); $i++) {
            DB::table('initiative_types')->insert([
                'id' => $initiativeTypes[$i]['id'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

	    // Initiative types translations
        for($i=0; $i<count($initiativeTypes); $i++) {
            DB::table('initiative_type_translations')->insert([
                'initiative_type_id' => $initiativeTypes[$i]['id'],
                'name' => $initiativeTypes[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Social networks
        $socialNetworksArr = ['Facebook', 'Twitter', 'Google', 'LinkedIn'];
	
        for($i=0; $i<count($socialNetworksArr); $i++) {
            DB::table('social_networks')->insert([
                'title' => $socialNetworksArr[$i],
                'class_name' => mb_convert_case($socialNetworksArr[$i].'-item', MB_CASE_LOWER, "UTF-8"),
                'priority' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Genders
        for($i=0; $i<2; $i++) {
            DB::table('genders')->insert([
                'id' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

	    // Genders translations
        $gendersArr = ['Male', 'Female'];
	
        for($i=0; $i<count($gendersArr); $i++) {
            DB::table('gender_translations')->insert([
                'gender_id' => ($i+1),
                'name' => $gendersArr[$i],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Languages file
        $languagesFileContents = file_get_contents(resource_path() . '/assets/files/languages.json');
        $languages = json_decode($languagesFileContents, true);

        foreach($languages as $key=>$value) {
            DB::table('languages')->insert([
                'iso_code' => $key,
                'title' => $value,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Cities file
        $citiesFileContents = file_get_contents(resource_path() . '/assets/files/cities.json');
        $cities = json_decode($citiesFileContents, true);
        
        // Cities
        for($i=0; $i<count($cities); $i++) {
            DB::table('cities')->insert([
                'id' => ($i+1),
                'continent_code' => $cities[$i]['continent_code'],
                'country_iso' => $cities[$i]['country_iso'],
                'subdivision_iso' => $cities[$i]['subdivision_iso'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Cities translations
        for($i=0; $i<count($cities); $i++) {
            DB::table('city_translations')->insert([
                'city_id' => ($i+1),
                'continent_name' => $cities[$i]['continent_name'],
                'country_name' => $cities[$i]['country_name'],
                'subdivision_name' => $cities[$i]['subdivision_name'],
                'name' => $cities[$i]['city_name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }


        // Universities file
        $universitiesFileContents = file_get_contents(resource_path() . '/assets/files/universities.json');
        $universities = json_decode($universitiesFileContents, true);
        
        // Universities
        for($i=0; $i<count($universities); $i++) {
            DB::table('universities')->insert([
                'id' => ($i+1),
                'country_iso' => $universities[$i]['country_iso'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        // Universities translations
        for($i=0; $i<count($universities); $i++) {
            DB::table('university_translations')->insert([
                'university_id' => ($i+1),
                'name' => $universities[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Interests file
        $interestsFileContents = file_get_contents(resource_path() . '/assets/files/interests.json');
        $interests = json_decode($interestsFileContents, true);
        
        // Interests
        for($i=0; $i<count($interests); $i++) {
            DB::table('interests')->insert([
                'id' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Interests translations
        for($i=0; $i<count($interests); $i++) {
            DB::table('interest_translations')->insert([
                'interest_id' => ($i+1),
                'name' => $interests[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Positions file
        $positionsFileContents = file_get_contents(resource_path() . '/assets/files/positions.json');
        $positions = json_decode($positionsFileContents, true);
        
        // Positions
        for($i=0; $i<count($positions); $i++) {
            DB::table('positions')->insert([
                'id' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        // Positions translations
        for($i=0; $i<count($positions); $i++) {
            DB::table('position_translations')->insert([
                'position_id' => ($i+1),
                'name' => $positions[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Studies file
        $studiesFileContents = file_get_contents(resource_path() . '/assets/files/studies.json');
        $studies = json_decode($studiesFileContents, true);
        
        // Studies
        for($i=0; $i<count($studies); $i++) {
            DB::table('studies')->insert([
                'id' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Studies translations
        for($i=0; $i<count($studies); $i++) {
            DB::table('study_translations')->insert([
                'study_id' => ($i+1),
                'name' => $studies[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }



        // Skills file
        $skillsFileContents = file_get_contents(resource_path() . '/assets/files/skills.json');
        $skills = json_decode($skillsFileContents, true);
        
        // Skills
        for($i=0; $i<count($skills); $i++) {
            DB::table('skills')->insert([
                'id' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        // Skills translations
        for($i=0; $i<count($skills); $i++) {
            DB::table('skill_translations')->insert([
                'skill_id' => ($i+1),
                'name' => $skills[$i]['name'],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
