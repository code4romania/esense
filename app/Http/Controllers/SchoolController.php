<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SchoolController
{
    use ValidatesRequests, DispatchesJobs;

    public function archive() {}
    public function dashboard() {}
    public function lesson() {}
    public function profileEdit() {}
    public function specialist() {}
    public function specialistAdd() {}
    public function specialistEdit() {}
    public function specialists() {}
    public function student() {}
    public function studentAdd() {}
    public function studentEdit() {}
    public function students() {}
}
