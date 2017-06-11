<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('buildDayDropdown'))
{
    function buildDayDropdown($name='',$value='')
    {
        $days = range(1, 31);
		$day_list[''] = 'Day';
        foreach($days as $day)
        {
            $day_list[$day] = $day;
        } 		
        return form_dropdown($name, $day_list, $value);
    }
}	

if ( !function_exists('buildYearDropdown'))
{
	function buildYearDropdown($name='',$value='')
    {        
        $years = range(1922, date("Y"));
		$year_list[''] = 'Year';
        foreach($years as $year)
        {
            $year_list[$year] = $year;
        }    
        
        return form_dropdown($name, $year_list, $value);
    }
}

if (!function_exists('buildMonthDropdown'))
{
    function buildMonthDropdown($name='',$value='')
    {
        $month=array(
			''	=>'Month',
            '01'=>'January',
            '02'=>'February',
            '03'=>'March',
            '04'=>'April',
            '05'=>'May',
            '06'=>'June',
            '07'=>'July',
            '08'=>'August',
            '09'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December');
        return form_dropdown($name, $month, $value);
    }
}

if (!function_exists('buildCountryDropdown'))
{
    function buildCountryDropdown($name='',$value='')
    {
        $country=array(
			''	=>'-- select --',
			"PH"=>"Philippines",
			"GB"=>"United Kingdom",
			"US"=>"United States",			
			"AF"=>"Afghanistan",
			"AL"=>"Albania",
			"DZ"=>"Algeria",
			"AD"=>"Andorra",
			"AO"=>"Angola",
			"AI"=>"Anguilla",
			"AQ"=>"Antarctica",
			"AG"=>"Antigua and Barbuda",
			"AR"=>"Argentina",
			"AM"=>"Armenia",
			"AW"=>"Aruba",
			"AU"=>"Australia",
			"AT"=>"Austria",
			"AZ"=>"Azerbaijan",
			"BS"=>"Bahamas",
			"BH"=>"Bahrain",
			"BD"=>"Bangladesh",
			"BB"=>"Barbados",
			"BY"=>"Belarus",
			"BE"=>"Belgium",
			"BZ"=>"Belize",
			"BJ"=>"Benin",
			"BM"=>"Bermuda",
			"BT"=>"Bhutan",
			"BO"=>"Bolivia",
			"BA"=>"Bosnia and Herzegovina",
			"BW"=>"Botswana",
			"BR"=>"Brazil",
			"IO"=>"British Indian Ocean",
			"BN"=>"Brunei",
			"BG"=>"Bulgaria",
			"BF"=>"Burkina Faso",
			"BI"=>"Burundi",
			"KH"=>"Cambodia",
			"CM"=>"Cameroon",
			"CA"=>"Canada",
			"CV"=>"Cape Verde",
			"KY"=>"Cayman Islands",
			"CF"=>"Central African Republic",
			"TD"=>"Chad",
			"CL"=>"Chile",
			"CN"=>"China",
			"CX"=>"Christmas Island",
			"CC"=>"Cocos (Keeling) Islands",
			"CO"=>"Colombia",
			"KM"=>"Comoros",
			"CD"=>"Congo, Democratic Republic of the",
			"CG"=>"Congo, Republic of the",
			"CK"=>"Cook Islands",
			"CR"=>"Costa Rica",
			"HR"=>"Croatia",
			"CY"=>"Cyprus",
			"CZ"=>"Czech Republic",
			"DK"=>"Denmark",
			"DJ"=>"Djibouti",
			"DM"=>"Dominica",
			"DO"=>"Dominican Republic",
			"TL"=>"East Timor",
			"EC"=>"Ecuador",
			"EG"=>"Egypt",
			"SV"=>"El Salvador",
			"GQ"=>"Equatorial Guinea",
			"ER"=>"Eritrea",
			"EE"=>"Estonia",
			"ET"=>"Ethiopia",
			"FK"=>"Falkland Islands (Malvinas)",
			"FO"=>"Faroe Islands",
			"FJ"=>"Fiji",
			"FI"=>"Finland",
			"FR"=>"France",
			"GF"=>"French Guiana",
			"PF"=>"French Polynesia",
			"GA"=>"Gabon",
			"GM"=>"Gambia",
			"GE"=>"Georgia",
			"DE"=>"Germany",
			"GH"=>"Ghana",
			"GI"=>"Gibraltar",
			"GR"=>"Greece",
			"GL"=>"Greenland",
			"GD"=>"Grenada",
			"GP"=>"Guadeloupe",
			"GT"=>"Guatemala",
			"GN"=>"Guinea",
			"GW"=>"Guinea-Bissau",
			"GY"=>"Guyana",
			"HT"=>"Haiti",
			"HN"=>"Honduras",
			"HK"=>"Hong Kong",
			"HU"=>"Hungary",
			"IS"=>"Iceland",
			"IN"=>"India",
			"ID"=>"Indonesia",
			"IE"=>"Ireland",
			"IL"=>"Israel",
			"IT"=>"Italy",
			"CI"=>"Ivory Coast",
			"JM"=>"Jamaica",
			"JP"=>"Japan",
			"JO"=>"Jordan",
			"KZ"=>"Kazakhstan",
			"KE"=>"Kenya",
			"KI"=>"Kiribati",
			"KR"=>"Korea, South",
			"KW"=>"Kuwait",
			"KG"=>"Kyrgyzstan",
			"LA"=>"Laos",
			"LV"=>"Latvia",
			"LB"=>"Lebanon",
			"LS"=>"Lesotho",
			"LI"=>"Liechtenstein",
			"LT"=>"Lithuania",
			"LU"=>"Luxembourg",
			"MO"=>"Macau",
			"MK"=>"Macedonia, Republic of",
			"MG"=>"Madagascar",
			"MW"=>"Malawi",
			"MY"=>"Malaysia",
			"MV"=>"Maldives",
			"ML"=>"Mali",
			"MT"=>"Malta",
			"MH"=>"Marshall Islands",
			"MQ"=>"Martinique",
			"MR"=>"Mauritania",
			"MU"=>"Mauritius",
			"YT"=>"Mayotte",
			"MX"=>"Mexico",
			"FM"=>"Micronesia",
			"MD"=>"Moldova",
			"MC"=>"Monaco",
			"MN"=>"Mongolia",
			"ME"=>"Montenegro",
			"MS"=>"Montserrat",
			"MA"=>"Morocco",
			"MZ"=>"Mozambique",
			"NA"=>"Namibia",
			"NR"=>"Nauru",
			"NP"=>"Nepal",
			"NL"=>"Netherlands",
			"AN"=>"Netherlands Antilles",
			"NC"=>"New Caledonia",
			"NZ"=>"New Zealand",
			"NI"=>"Nicaragua",
			"NE"=>"Niger",
			"NG"=>"Nigeria",
			"NU"=>"Niue",
			"NF"=>"Norfolk Island",
			"NO"=>"Norway",
			"OM"=>"Oman",
			"PK"=>"Pakistan",
			"PS"=>"Palestinian Territory",
			"PA"=>"Panama",
			"PG"=>"Papua New Guinea",
			"PY"=>"Paraguay",
			"PE"=>"Peru",
			"PN"=>"Pitcairn Island",
			"PL"=>"Poland",
			"PT"=>"Portugal",
			"QA"=>"Qatar",
			"RE"=>"R&eacute;union",
			"RO"=>"Romania",
			"RU"=>"Russia",
			"RW"=>"Rwanda",
			"SH"=>"Saint Helena",
			"KN"=>"Saint Kitts and Nevis",
			"LC"=>"Saint Lucia",
			"PM"=>"Saint Pierre and Miquelon",
			"VC"=>"Saint Vincent and the Grenadines",
			"WS"=>"Samoa",
			"SM"=>"San Marino",
			"ST"=>"S&atilde;o Tome and Principe",
			"SA"=>"Saudi Arabia",
			"SN"=>"Senegal",
			"RS"=>"Serbia",
			"CS"=>"Serbia and Montenegro",
			"SC"=>"Seychelles",
			"SL"=>"Sierra Leon",
			"SG"=>"Singapore",
			"SK"=>"Slovakia",
			"SI"=>"Slovenia",
			"SB"=>"Solomon Islands",
			"SO"=>"Somalia",
			"ZA"=>"South Africa",
			"GS"=>"South Georgia and the South Sandwich Islands",
			"ES"=>"Spain",
			"LK"=>"Sri Lanka",
			"SR"=>"Suriname",
			"SJ"=>"Svalbard and Jan Mayen",
			"SZ"=>"Swaziland",
			"SE"=>"Sweden",
			"CH"=>"Switzerland",
			"TW"=>"Taiwan",
			"TJ"=>"Tajikistan",
			"TZ"=>"Tanzania",
			"TH"=>"Thailand",
			"TG"=>"Togo",
			"TK"=>"Tokelau",
			"TO"=>"Tonga",
			"TT"=>"Trinidad and Tobago",
			"TN"=>"Tunisia",
			"TR"=>"Turkey",
			"TM"=>"Turkmenistan",
			"TC"=>"Turks and Caicos Islands",
			"TV"=>"Tuvalu",
			"UG"=>"Uganda",
			"UA"=>"Ukraine",
			"AE"=>"United Arab Emirates",
			"UM"=>"United States Minor Outlying Islands",
			"UY"=>"Uruguay",
			"UZ"=>"Uzbekistan",
			"VU"=>"Vanuatu",
			"VA"=>"Vatican City",
			"VE"=>"Venezuela",
			"VN"=>"Vietnam",
			"VG"=>"Virgin Islands, British",
			"WF"=>"Wallis and Futuna",
			"EH"=>"Western Sahara",
			"YE"=>"Yemen",
			"ZM"=>"Zambia",
			"ZW"=>"Zimbabwe");
		return form_dropdown($name, $country, $value);
    }
}

if (!function_exists('buildHourDropdown'))
{
    function buildHourDropdown()
    {
        $hours = range(1, 24);
        foreach($hours as $hour)
        {
            $hour_list[$hour] = $hour;
        } 		
		return $hour_list;
    }
}

if (!function_exists('buildMinuteDropdown'))
{
    function buildMinuteDropdown()
    {
        $minutes=array(
            '00'=>'00',
            '05'=>'05',
            '10'=>'10',
            '15'=>'15',
            '20'=>'20',
            '25'=>'25',
            '30'=>'30',
            '35'=>'35',
            '40'=>'40',
            '45'=>'45',
            '50'=>'50',
            '55'=>'55');
        return $minutes;
    }
}