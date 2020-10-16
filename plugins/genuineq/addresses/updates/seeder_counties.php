<?php namespace Genuineq\Addresses\Updates;

use Seeder;
use Genuineq\Addresses\Models\County;

class SeederCounties extends Seeder
{
    public function run()
    {
        County::truncate();
        County::create(["id" => 1,  "region_id" => 2, "slug" => "alba",            "name" => "Alba"]);
        County::create(["id" => 2,  "region_id" => 8, "slug" => "arad",            "name" => "Arad"]);
        County::create(["id" => 3,  "region_id" => 5, "slug" => "arges",           "name" => "Arges"]);
        County::create(["id" => 4,  "region_id" => 3, "slug" => "bacau",           "name" => "Bacau"]);
        County::create(["id" => 5,  "region_id" => 4, "slug" => "bihor",           "name" => "Bihor"]);
        County::create(["id" => 6,  "region_id" => 4, "slug" => "bistrita-nasaud", "name" => "Bistrita-Nasaud"]);
        County::create(["id" => 7,  "region_id" => 3, "slug" => "botosani",        "name" => "Botosani"]);
        County::create(["id" => 8,  "region_id" => 6, "slug" => "braila",          "name" => "Braila"]);
        County::create(["id" => 9,  "region_id" => 2, "slug" => "brasov",          "name" => "Brasov"]);
        County::create(["id" => 10, "region_id" => 1, "slug" => "bucuresti",       "name" => "Bucuresti"]);
        County::create(["id" => 11, "region_id" => 6, "slug" => "buzau",           "name" => "Buzau"]);
        County::create(["id" => 12, "region_id" => 5, "slug" => "calarasi",        "name" => "Calarasi"]);
        County::create(["id" => 13, "region_id" => 8, "slug" => "caras-severin",   "name" => "Caras-Severin"]);
        County::create(["id" => 14, "region_id" => 4, "slug" => "cluj",            "name" => "Cluj"]);
        County::create(["id" => 15, "region_id" => 6, "slug" => "constanta",       "name" => "Constanta"]);
        County::create(["id" => 16, "region_id" => 2, "slug" => "covasna",         "name" => "Covasna"]);
        County::create(["id" => 17, "region_id" => 5, "slug" => "dambovita",       "name" => "Dambovita"]);
        County::create(["id" => 18, "region_id" => 7, "slug" => "dolj",            "name" => "Dolj"]);
        County::create(["id" => 19, "region_id" => 6, "slug" => "galati",          "name" => "Galati"]);
        County::create(["id" => 20, "region_id" => 5, "slug" => "giurgiu",         "name" => "Giurgiu"]);
        County::create(["id" => 21, "region_id" => 7, "slug" => "gorj",            "name" => "Gorj"]);
        County::create(["id" => 22, "region_id" => 2, "slug" => "harghita",        "name" => "Harghita"]);
        County::create(["id" => 23, "region_id" => 8, "slug" => "hunedoara",       "name" => "Hunedoara"]);
        County::create(["id" => 24, "region_id" => 5, "slug" => "ialomita",        "name" => "Ialomita"]);
        County::create(["id" => 25, "region_id" => 3, "slug" => "iasi",            "name" => "Iasi"]);
        County::create(["id" => 26, "region_id" => 1, "slug" => "ilfov",           "name" => "Ilfov"]);
        County::create(["id" => 27, "region_id" => 4, "slug" => "maramures",       "name" => "Maramures"]);
        County::create(["id" => 28, "region_id" => 7, "slug" => "mehedinti",       "name" => "Mehedinti"]);
        County::create(["id" => 29, "region_id" => 2, "slug" => "mures",           "name" => "Mures"]);
        County::create(["id" => 30, "region_id" => 3, "slug" => "neamt",           "name" => "Neamt"]);
        County::create(["id" => 31, "region_id" => 7, "slug" => "olt",             "name" => "Olt"]);
        County::create(["id" => 32, "region_id" => 5, "slug" => "prahova",         "name" => "Prahova"]);
        County::create(["id" => 33, "region_id" => 4, "slug" => "salaj",           "name" => "Salaj"]);
        County::create(["id" => 34, "region_id" => 4, "slug" => "satu Mare",       "name" => "Satu Mare"]);
        County::create(["id" => 35, "region_id" => 2, "slug" => "sibiu",           "name" => "Sibiu"]);
        County::create(["id" => 36, "region_id" => 3, "slug" => "suceava",         "name" => "Suceava"]);
        County::create(["id" => 37, "region_id" => 5, "slug" => "teleorman",       "name" => "Teleorman"]);
        County::create(["id" => 38, "region_id" => 8, "slug" => "timis",           "name" => "Timis"]);
        County::create(["id" => 39, "region_id" => 6, "slug" => "tulcea",          "name" => "Tulcea"]);
        County::create(["id" => 40, "region_id" => 7, "slug" => "valcea",          "name" => "Valcea"]);
        County::create(["id" => 41, "region_id" => 3, "slug" => "vaslui",          "name" => "Vaslui"]);
        County::create(["id" => 42, "region_id" => 6, "slug" => "vrancea",         "name" => "Vrancea"]);
        County::create(["id" => 43, "region_id" => 9, "slug" => "remote",          "name" => "Remote"]);
    }
}
