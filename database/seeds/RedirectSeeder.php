<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RedirectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('redirects')->insert([
            'country_id' => 1,
            'url' => 'https://idealtrends.com.br',
        ]);
    }
}
