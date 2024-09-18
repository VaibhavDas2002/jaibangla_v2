<?php
return [
    'gender' => [
        'Male' => 'Male',
        'Female' => 'Female',
        'Other' => 'Other',
    ],
    'caste' => [
        'SC' => 'SC',
        'ST' => 'ST',
        'General' => 'General',
    ],
    'category_purohit' => [
        'SC' => 'SC',
        'ST' => 'ST',
        'OTHERS' => 'OTHERS'
    ],
    'caste_lb' => [
        'SC' => 'SC',
        'ST' => 'ST',
        'OBC' => 'OBC',
        'General' => 'General'
    ],
    'purohit_phase' => [
        'Phase-I' => 'Phase-I',
        'Phase-II' => 'Phase-II',
        'Phase-III' => 'Phase-III'
    ],
    'temple_type' => [
        'Temple Purohit' => 'Temple Purohit',
        'Tribal Religious Place Purohit' => 'Tribal Religious Place Purohit',
        'Community Purohit' => 'Community Purohit',
    ],
    'user_level' => [
        'State' => 'State',
        'District' => 'District',
        'Block' => 'Block',
        'Subdiv' => 'Sub Division',
        'Municipality' => 'Municipality',
        'Gram Panchayet' => 'Gram Panchayet',
    ],
    'disablity_type' => [
        'Orthopedically Handicapped' => 'Orthopedically Handicapped',
        'Visually Handicapped' => 'Visually Handicapped',
        'Mental illness' => 'Mental illness',
        'Mental Retardation' => 'Mental Retardation',
        'Mutiple Disablities' => 'Mutiple Disablities',
        'Leprosy Cured' => 'Leprosy Cured',
        'Nervous Disorder' => 'Nervous Disorder',
        'Others' => 'Others'
    ],
    'document_group' => [
        '1' => 'Date of Birth Identification',
        '2' => 'Caste Identification',
        '3' => 'Document Group for Manabik',
        '4' => 'Date of Birth Identification for OAP',
        '5' => 'Date of Birth Identification for WP'
    ],
    'marital_status' => [
        'Unmarried' => 'Unmarried',
        'Married' => 'Married',
        'Seperated' => 'Seperated',
        'Widow' => 'Widow',
        'Widower' => 'Widower',
    ],
    'ration_cat' => [
        'AAY' => 'AAY',
        'OHH' => 'OHH',
        'RKSY 1' => 'RKSY 1',
        'RKSY 2' => 'RKSY 2',
        'SPHH' => 'SPHH',
        'PHH' => 'PHH',
        'GEN' => 'GEN',
    ],
    'rural_urban' => [
        '2' => 'Rural',
        '1' => 'Urban',
    ],
    'rural_urban_ward' => [
        '3' => 'Urban-Ward',
        '2' => 'Rural',
        '1' => 'Urban',
        
    ],
    'pension_body' => [
        'Central Govt' => 'Central Govt',
        'State Govt' => 'State Govt',
        'Local Administration' => 'Local Administration',
        'Govt. Aided Organization' => 'Govt. Aided Organization',
    ],
    'social_pension_cat' => [
        'NSAP Old Age' => 'NSAP Old Age',
        'NSAP Widow Pension' => 'NSAP Widow Pension',
        'NSAP Disability Pension' => 'NSAP Disability Pension',
        'Old Age Pension' => 'Old Age Pension',
        'Widow Pension' => 'Widow Pension',
        'Disability Pension' => 'Disability Pension',
        'Lok Prasar Prakalpa' => 'Lok Prasar Prakalpa',
        'Fisherman\'s Old Age Pension' => 'Fisherman\'s Old Age Pension',
        'Farmers Old Age Pension' => 'Farmers Old Age Pension',
        'Artisan/Weaver Old Age Pension' => 'Artisan/Weaver Old Age Pension',
    ],
    'fin_year' => [
        '2020-2021' => '2020-2021',
        '2021-2022' => '2021-2022',
        '2022-2023' => '2022-2023',
	    '2023-2024' => '2023-2024'
    ],
    'monthlist' => [
        'April' => 'APRIL',
        'May' => 'MAY',
        'June' => 'JUNE',
        'July' => 'JULY',
        'August' => 'AUGUST',
        'September' => 'SEPTEMBER',
        'October' => 'OCTOBER',
        'November' => 'NOVEMBER',
        'December' => 'DECEMBER',
        'January' => 'JANUARY',
        'February' => 'FEBRUARY',
        'March' => 'MARCH',
    ],
    'month_list' => [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ],
    'monthval' => [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ],
    'category' => [
        'ALL' => 'ALL',
        'GENERAL' => 'GENERAL',
        'SC' => 'SC',
        'ST' => 'ST',
    ],
    'lot_size' => [
        // '10' => '10',
        // '20' => '20',
        // '50' => '50',
        // '100' => '100',
        // '500' => '500',
        // '1000' => '1000',
        // '5000' => '5000',
        '10000' => '10000',
    ],
    'schemecodeStatic' => [
        'purohitmonthly' => array("scheme_code" => '17', "name" => 'Monthly Financial Assistance', 'slug' => 'monthly', 'maintable' => 'PensionPurohitMonthlyICAD', 'doctable' => 'BenDocsPurohitMonthlyICAD', 'docarctable' => 'BenDocsArcPurohitMonthlyICAD'),
        'purohithousing' => array("scheme_code" => '18', "name" => 'Both Monthly Pension and One time Housing Scheme', 'slug' => 'housing', 'maintable' => 'PensionPurohitHousingICAD', 'doctable' => 'BenDocsPurohitHousingICAD', 'docarctable' => 'BenDocsArcPurohitHousingICAD'),
    ],
    'user_audit_trail_code' => [
        'Update' => 1,
        'Delete' => 2
    ],
    'errormsg' => [
        'roolback' => 'Error Occur .. Please try later..',
        'frmjsonnexists' => 'Error Occur .. Please try later..',
        'notValid' => 'is Not Valid',
        'notFound' => 'Not Found',
        'notauthorized' => 'You are not Authorized',
        'applicationidnotfound' => 'Application Id not Found',
        'applicationalreadyverified' => 'Application already verified.. you cannot edit it.',
        'sessiontimeOut' => 'Something wrong..may be session timeout. please logout and then login again',
        'exceedcapacity' => 'Scheme Data has been exceeded to the Capacity',
    ],
    'scheme_code_map' => [
        '1' => array("scheme_id" => '1', "model_name" => 'PensionSt', "scheme_name" => 'Jai Johar(for ST)'),
        '2' => array("scheme_id" => '2', "model_name" => 'PensionManabikWCD', "scheme_name" => 'Manabik for WCD'),
        '3' => array("scheme_id" => '3', "model_name" => 'PensionSc', "scheme_name" => 'Toposili Bandhu(for SC)'),
        // '4' => array("scheme_id"=>'4',"model_name"=>'Prachesta',"scheme_name"=>''),
        '5' => array("scheme_id" => '5', "model_name" => 'PensionFisherman', "scheme_name" => 'Old Age Pension for Fishermen'),
        '6' => array("scheme_id" => '6', "model_name" => 'PensionMSME', "scheme_name" => 'MSME Pension'),
        '7' => array("scheme_id" => '7', "model_name" => 'PensionTextile', "scheme_name" => 'Textile Pension'),
        '19' => array("scheme_id" => '19', "model_name" => 'PensionOAPST', "scheme_name" => 'Legacy Old Age Pension for ST'),
        '10' => array("scheme_id" => '10', "model_name" => 'PensionOAPWCD', "scheme_name" => 'Old Age Pension WCD'),
        '11' => array("scheme_id" => '11', "model_name" => 'PensionWPWCD', "scheme_name" => 'Widow Pension WCD'),
        '17' => array("scheme_id" => '17', "model_name" => 'PensionPurohitMonthlyICAD', "scheme_name" => 'Purohits Monthly Financial Assistance'),
        '13' => array("scheme_id" => '13', "model_name" => 'PensionOAPFarmer', "scheme_name" => 'Farmer Old Age Pension'),
	'8' => array("scheme_id" => '8', "model_name" => 'PensionLPPRetainer', "scheme_name" => 'LPP Retainer'),
        '9' => array("scheme_id" => '9', "model_name" => 'PensionLPPPensioner', "scheme_name" => 'LPP Pensioner'),
    ],
    'schemeurl' => [
        1 => 'st',
        2 => 'manabik',
        3 => 'sc',
        8 => 'lppret',
        9 => 'lpppen',
        10 => 'oap',
        11 => 'wp',
        17 => 'purohits',
	13=> 'oapfarmer',
    ],
    'identification_type' => [
        'A' => 'Aadhar',
        'E' => 'Epic',
        'K' => 'KhadyaSathi',
        'S' => 'SwasthyaSathi'
    ],
    'ds_rejection_cause' => [
        'Personal Details Incomplete' => 'Personal Details Incomplete',
        'Personal Identification Number(S) Details Incomplete' => 'Personal Identification Number(S) Details Incomplete',
        'Contact Details Incomplete' => 'Contact Details Incomplete',
        'Bank Account Details Incomplete' => 'Bank Account Details Incomplete',
        'Enclosure List Details Incomplete' => 'Enclosure List Details Incomplete'
    ],
    'state_login_next_level_role_id' => [
        'entry' => 5001,
        'verified' => 5002,
        'approved' => 0
    ],
    'entry_allowded' => [
        '10' => array(312, 0),
        '11' => array(312, 0),
    ],
    'duplicate_bank_info_check' => [ 2,10,11,3,8,9,17,1,19 ],
    'bank_mob_aadhar_update_check' => [2, 10, 11, 3, 1, 19],
    'age_cohort_list' => [
        10 => [
            '<60' => 'Less than 60 years',
            '90-99' => 'Between 90 to 99 years',
            '>=100' => 'Above 100 years'
        ]
        ],
 'withoutAadhaarreason' => [
            'Blind, IRIS cannot be captured' => 'Blind, IRIS cannot be captured',
            'Does not have any/all fingers in hand, fingerprint cannot be captured' => 'Does not have any/all fingers in hand, fingerprint cannot be captured',
            'Bed ridden, AADHAR cannot be generated' => 'Bed ridden, AADHAR cannot be generated',
            'Others' => 'Others'
 ],
 'lb60server' => 'http://172.25.154.28:80',
];
