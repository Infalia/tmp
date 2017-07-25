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
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        // Accessibility categories
        for($i=0; $i<4; $i++) {
            DB::table('accessblty_cats')->insert([
                'id' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }


        // Accessibility categories translations
        for($i=0; $i<4; $i++) {
            DB::table('accessblty_cat_translations')->insert([
                'accessblty_cat_id' => ($i+1),
                'name' => mb_convert_case(str_random(10), MB_CASE_TITLE, "UTF-8"),
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        for($i=0; $i<4; $i++) {
            DB::table('accessblty_cat_translations')->insert([
                'accessblty_cat_id' => ($i+1),
                'name' => mb_convert_case(str_random(10), MB_CASE_TITLE, "UTF-8"),
                'locale' => 'el',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }


        // Accessibility options
        for($i=0; $i<4; $i++) {
            for($j=0; $j<4; $j++) {
                DB::table('accessblty_opts')->insert([
                    'accessblty_cat_id' => ($i+1),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        // Accessibility options translations
        for($i=0; $i<16; $i++) {
            DB::table('accessblty_opt_translations')->insert([
                'accessblty_opt_id' => ($i+1),
                'name' => mb_convert_case(str_random(10), MB_CASE_TITLE, "UTF-8"),
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        for($i=0; $i<16; $i++) {
            DB::table('accessblty_opt_translations')->insert([
                'accessblty_opt_id' => ($i+1),
                'name' => mb_convert_case(str_random(10), MB_CASE_TITLE, "UTF-8"),
                'locale' => 'el',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        
        // Initiative types
        for($i=0; $i<2; $i++) {
            DB::table('initiative_types')->insert([
                'id' => ($i+1),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

	    // Initiative types translations
        $typesArr = ['Offer', 'Demand'];
	
        for($i=0; $i<count($typesArr); $i++) {
            DB::table('initiative_type_translations')->insert([
                'initiative_type_id' => ($i+1),
                'name' => $typesArr[$i],
                'locale' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }


        // Social networks
        $socialNetworksArr = ['Facebook', 'Twitter', 'Google+', 'LinkedIn'];
	
        for($i=0; $i<count($socialNetworksArr); $i++) {
            DB::table('social_networks')->insert([
                'title' => $socialNetworksArr[$i],
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


        // Languages
        $languages = array(
            'en' => 'English' , 
            'aa' => 'Afar' , 
            'ab' => 'Abkhazian' , 
            'af' => 'Afrikaans' , 
            'am' => 'Amharic' , 
            'ar' => 'Arabic' , 
            'as' => 'Assamese' , 
            'ay' => 'Aymara' , 
            'az' => 'Azerbaijani' , 
            'ba' => 'Bashkir' , 
            'be' => 'Byelorussian' , 
            'bg' => 'Bulgarian' , 
            'bh' => 'Bihari' , 
            'bi' => 'Bislama' , 
            'bn' => 'Bengali/Bangla' , 
            'bo' => 'Tibetan' , 
            'br' => 'Breton' , 
            'ca' => 'Catalan' , 
            'co' => 'Corsican' , 
            'cs' => 'Czech' , 
            'cy' => 'Welsh' , 
            'da' => 'Danish' , 
            'de' => 'German' , 
            'dz' => 'Bhutani' , 
            'el' => 'Greek' , 
            'eo' => 'Esperanto' , 
            'es' => 'Spanish' , 
            'et' => 'Estonian' , 
            'eu' => 'Basque' , 
            'fa' => 'Persian' , 
            'fi' => 'Finnish' , 
            'fj' => 'Fiji' , 
            'fo' => 'Faeroese' , 
            'fr' => 'French' , 
            'fy' => 'Frisian' , 
            'ga' => 'Irish' , 
            'gd' => 'Scots/Gaelic' , 
            'gl' => 'Galician' , 
            'gn' => 'Guarani' , 
            'gu' => 'Gujarati' , 
            'ha' => 'Hausa' , 
            'hi' => 'Hindi' , 
            'hr' => 'Croatian' , 
            'hu' => 'Hungarian' , 
            'hy' => 'Armenian' , 
            'ia' => 'Interlingua' , 
            'ie' => 'Interlingue' , 
            'ik' => 'Inupiak' , 
            'in' => 'Indonesian' , 
            'is' => 'Icelandic' , 
            'it' => 'Italian' , 
            'iw' => 'Hebrew' , 
            'ja' => 'Japanese' , 
            'ji' => 'Yiddish' , 
            'jw' => 'Javanese' , 
            'ka' => 'Georgian' , 
            'kk' => 'Kazakh' , 
            'kl' => 'Greenlandic' , 
            'km' => 'Cambodian' , 
            'kn' => 'Kannada' , 
            'ko' => 'Korean' , 
            'ks' => 'Kashmiri' , 
            'ku' => 'Kurdish' , 
            'ky' => 'Kirghiz' , 
            'la' => 'Latin' , 
            'ln' => 'Lingala' , 
            'lo' => 'Laothian' , 
            'lt' => 'Lithuanian' , 
            'lv' => 'Latvian/Lettish' , 
            'mg' => 'Malagasy' , 
            'mi' => 'Maori' , 
            'mk' => 'Macedonian' , 
            'ml' => 'Malayalam' , 
            'mn' => 'Mongolian' , 
            'mo' => 'Moldavian' , 
            'mr' => 'Marathi' , 
            'ms' => 'Malay' , 
            'mt' => 'Maltese' , 
            'my' => 'Burmese' , 
            'na' => 'Nauru' , 
            'ne' => 'Nepali' , 
            'nl' => 'Dutch' , 
            'no' => 'Norwegian' , 
            'oc' => 'Occitan' , 
            'om' => '(Afan)/Oromoor/Oriya' , 
            'pa' => 'Punjabi' , 
            'pl' => 'Polish' , 
            'ps' => 'Pashto/Pushto' , 
            'pt' => 'Portuguese' , 
            'qu' => 'Quechua' , 
            'rm' => 'Rhaeto-Romance' , 
            'rn' => 'Kirundi' , 
            'ro' => 'Romanian' , 
            'ru' => 'Russian' , 
            'rw' => 'Kinyarwanda' , 
            'sa' => 'Sanskrit' , 
            'sd' => 'Sindhi' , 
            'sg' => 'Sangro' , 
            'sh' => 'Serbo-Croatian' , 
            'si' => 'Singhalese' , 
            'sk' => 'Slovak' , 
            'sl' => 'Slovenian' , 
            'sm' => 'Samoan' , 
            'sn' => 'Shona' , 
            'so' => 'Somali' , 
            'sq' => 'Albanian' , 
            'sr' => 'Serbian' , 
            'ss' => 'Siswati' , 
            'st' => 'Sesotho' , 
            'su' => 'Sundanese' , 
            'sv' => 'Swedish' , 
            'sw' => 'Swahili' , 
            'ta' => 'Tamil' , 
            'te' => 'Tegulu' , 
            'tg' => 'Tajik' , 
            'th' => 'Thai' , 
            'ti' => 'Tigrinya' , 
            'tk' => 'Turkmen' , 
            'tl' => 'Tagalog' , 
            'tn' => 'Setswana' , 
            'to' => 'Tonga' , 
            'tr' => 'Turkish' , 
            'ts' => 'Tsonga' , 
            'tt' => 'Tatar' , 
            'tw' => 'Twi' , 
            'uk' => 'Ukrainian' , 
            'ur' => 'Urdu' , 
            'uz' => 'Uzbek' , 
            'vi' => 'Vietnamese' , 
            'vo' => 'Volapuk' , 
            'wo' => 'Wolof' , 
            'xh' => 'Xhosa' , 
            'yo' => 'Yoruba', 
            'zh' => 'Chinese',
            'zu' => 'Zulu',
        );

        foreach($languages as $key=>$value) {
            DB::table('languages')->insert([
                'iso_code' => $key,
                'title' => $value,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
