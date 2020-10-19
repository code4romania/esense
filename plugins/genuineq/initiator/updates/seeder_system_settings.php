<?php namespace genuineq\initiator\Updates;

use Db;
use Seeder;

class SeederSystemSettings extends Seeder
{
    public function run()
    {
        /** Populate the system_settings table. */
        DB::table('system_settings')->delete();
        Db::table('system_settings')->insert(['id' => 1, 'item' => 'backend_brand_settings',      'value' => '{"app_name":"e-Sense","app_tagline":"e-Sense","primary_color":"#0E4870","secondary_color":"#FAB954","accent_color":"#363636","menu_mode":"inline","custom_css":""}']);
        Db::table('system_settings')->insert(['id' => 2, 'item' => 'rainlab_builder_settings',    'value' => '{"author_name":"genuineq","author_namespace":"Genuineq"}']);
        Db::table('system_settings')->insert(['id' => 3, 'item' => 'ginopane_awesomeiconslist',   'value' => '{"fontawesome_link":"https:\/\/use.fontawesome.com\/releases\/v5.12.0\/css\/all.css","fontawesome_link_attributes":[{"attribute":"crossorigin","value":"anonymous"}]}']);
        Db::table('system_settings')->insert(['id' => 4, 'item' => 'ginopane_awesomesociallinks', 'value' => '{"links":[{"icon":"fab fa-linkedin","name":"linkedin","link":"https:\/\/www.linkedin.com\/company\/sense-international-romania-\/"},{"icon":"fab fa-facebook-square","name":"facebook","link":"https:\/\/www.facebook.com\/SenseInternationalRomania"},{"icon":"fab fa-youtube","name":"youtube","link":"https:\/\/www.youtube.com\/channel\/UCYc80bBn7fnlipvbAmWpizQ"}]}']);
        Db::table('system_settings')->insert(['id' => 5, 'item' => 'system_log_settings',         'value' => '{"log_events":"1","log_requests":"1","log_theme":"1"}']);
        Db::table('system_settings')->insert(['id' => 6, 'item' => 'user_settings',               'value' => '{"require_activation":"1","activate_mode":"admin","use_throttle":"0","block_persistence":"0","allow_registration":"1","login_attribute":"email","remember_login":"ask","use_register_throttle":"0"}']);
    }
}
