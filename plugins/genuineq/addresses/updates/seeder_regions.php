<?php namespace Genuineq\Addresses\Updates;

use Seeder;
use Genuineq\Addresses\Models\Region;

class SeederRegions extends Seeder
{
    public function run()
    {
        Region::truncate();
        Region::create(["id" => 1, "slug" => "bucuresti-ilfov",  "name" => "Bucuresti - Ilfov"]);
        Region::create(["id" => 2, "slug" => "centru",           "name" => "Centru"]);
        Region::create(["id" => 3, "slug" => "nord-est",         "name" => "Nord-Est"]);
        Region::create(["id" => 4, "slug" => "nord-vest",        "name" => "Nord-Vest"]);
        Region::create(["id" => 5, "slug" => "sud-muntenia",     "name" => "Sud - Muntenia"]);
        Region::create(["id" => 6, "slug" => "sud-est",          "name" => "Sud-Est"]);
        Region::create(["id" => 7, "slug" => "sud-vest-oltenia", "name" => "Sud-Vest - Oltenia"]);
        Region::create(["id" => 8, "slug" => "vest",             "name" => "Vest"]);
        Region::create(["id" => 9, "slug" => "remote",           "name" => "Remote"]);
    }
}
