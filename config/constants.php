<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    // Main Roles
    'roles' => [
        0 => "Super Admin",
        1 => "Admin",
        2 => "Jobseeker",
        3 => "Medical Center",
        4 => "Doctor",
        5 => "Nurse",
        6 => "Practice Owner",
        7 => "Recruiter",
        8 => "Clinic",
        9 => "Nature Health Care",
        10 => "Ayurveda Therapy Center",
        11 => "Acupressure Health Care",
        12 => "Homeopathic",
        13 => "Other"
    ],

    // Common Roles
    'commonroles' => [
        2 => "Jobseeker",
        3 => "Medical Center",
        4 => "Doctor",
        5 => "Nurse",
        6 => "Practice Owner",
        7 => "Recruiter",
        8 => "Clinic",
        9 => "Nature Health Care",
        10 => "Ayurveda Therapy Center",
        11 => "Acupressure Health Care",
        12 => "Homeopathic",
        13 => "Other"
    ],

    // Main Roles
    'roles2' => [
        "Super Admin" => 0,
        "Admin" => 1,
        "Jobseeker" => 2,
        "Medical Center" => 3,
        "Doctor" => 4,
        "Nurse" => 5,
        "Practice Owner" => 6,
        "Recruiter" => 7,
        "Clinic" => 8,
        "Nature Health Care" => 9,
        "Ayurveda Therapy Center" => 10,
        "Acupressure Health Care" => 11,
        "Homeopathic" => 12,
        "Other" => 13
    ],

    // Buy / Sell Type
    'bstype' => [
        1 => "Buy",
        2 => "Sell",
    ],

    // Property Type
    'property_type' => [
        1 => "Medical Center",
        2 => "Other",
    ],

    // Promotional Flag Type
    'promotional_flag' => [
        1 => "New",
        2 => "Sale",
        3 => "Offer",
    ],

];
