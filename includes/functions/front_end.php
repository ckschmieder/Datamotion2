<?php
/**
 * Front End Theme Functions
 */

// Link Twitter usernames to their Twitter pages
function link_twitter_usernames($str) {
	$username_regex = '/@(\w+)/';

	if (preg_match($username_regex, $str)) {
		$links = preg_replace($username_regex, '<a href="https://twitter.com/$1" target="_blank">$0</a>', $str);
		return $links;
	}
	return $str;
}

// Link Twitter hashtags to a search page
function link_twitter_hashtags($str) {
	$hashtag_regex = '/#(\w+)/i';

	if (preg_match($hashtag_regex, $str)) {
		$links = preg_replace_callback($hashtag_regex, create_function('$matches', '
			$text = $matches[0];
			$query = urlencode($text);
			return \'<a href="http://twitter.com/search?q=\' . $query . \'" target="_blank" rel="nofollow">\' . $text . \'</a>\';
		'), $str);

		return $links;
	}
	return $str;
}

// Truncate a string
function truncate_string($string, $limit, $break='.', $pad='...') {
	// return with no change if string is shorter than limit
	if (strlen($string) <= $limit) return $string;

	// is $break present between $limit and the end of the string?
	if (false !== ($breakpoint = strpos($string, $break, $limit))) {
		if ($breakpoint < strlen($string) - 1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	}

	return $string;
}


// Registration form text field
function form_field($type, $name, $label, $required=false) {
	$classes = $required ? ' class="required"' : '';
	echo "<div class=\"$name field\">";
	echo "<label for=\"$name\"$classes>{$label}</label>";
	echo "<div class=\"input_contain\">";
	echo "\t<input type=\"$type\" name=\"$name\" id=\"$name\">";
	echo "</div>";
	echo "</div>";
}

function countries_field($name, $label, $required = false) {
	$classes = $required ? ' class="required"' : '';
	$countries = array(
		'United States',
		'Canada',
		'United Kingdom',
		'Albania',
		'Algeria',
		'American Samoa',
		'Andorra',
		'Angola',
		'Anguilla',
		'Antarctica',
		'Antigua and Barbuda',
		'Argentina',
		'Armenia',
		'Aruba',
		'Australia',
		'Austria',
		'Azerbaijan',
		'Bahamas',
		'Bahrain',
		'Bangladesh',
		'Barbados',
		'Belarus',
		'Belgium',
		'Belize',
		'Benin',
		'Bermuda',
		'Bhutan',
		'Bolivia',
		'Bosnia and Herzegovina',
		'Botswana',
		'Bouvet Island',
		'Brazil',
		'British Indian Ocean Territory',
		'British Virgin Islands',
		'Brunei',
		'Bulgaria',
		'Burkina Faso',
		'Burundi',
		'Cambodia',
		'Cameroon',
		'Cape Verde',
		'Cayman Islands',
		'Central African Republic',
		'Chad',
		'Chile',
		'China',
		'Christmas Island',
		'Cocos Islands',
		'Colombia',
		'Comoros',
		'Congo',
		'Cook Islands',
		'Costa Rica',
		'Croatia',
		'Cuba',
		'Cyprus',
		'Czech Republic',
		'Denmark',
		'Djibouti',
		'Dominica',
		'Dominican Republic',
		'East Timor',
		'Ecuador',
		'Egypt',
		'El Salvador',
		'Equatorial Guinea',
		'Eritrea',
		'Estonia',
		'Ethiopia',
		'Falkland Islands',
		'Faroe Islands',
		'Fiji',
		'Finland',
		'France',
		'French Guiana',
		'French Polynesia',
		'French Southern Territories',
		'Gabon',
		'Gambia',
		'Georgia',
		'Germany',
		'Ghana',
		'Gibraltar',
		'Greece',
		'Greenland',
		'Grenada',
		'Guadeloupe',
		'Guam',
		'Guatemala',
		'Guinea',
		'Guinea-Bissau',
		'Guyana',
		'Haiti',
		'Heard and McDonald Islands',
		'Honduras',
		'Hong Kong',
		'Hungary',
		'Iceland',
		'India',
		'Indonesia',
		'Iran',
		'Iraq',
		'Ireland',
		'Israel',
		'Italy',
		'Ivory Coast',
		'Jamaica',
		'Japan',
		'Jordan',
		'Kazakhstan',
		'Kenya',
		'Kiribati',
		'Korea, North',
		'Korea, South',
		'Kuwait',
		'Kyrgyzstan',
		'Laos',
		'Latvia',
		'Lebanon',
		'Lesotho',
		'Liberia',
		'Libya',
		'Liechtenstein',
		'Lithuania',
		'Luxembourg',
		'Macau',
		'Macedonia',
		'Madagascar',
		'Malawi',
		'Malaysia',
		'Maldives',
		'Mali',
		'Malta',
		'Marshall Islands',
		'Martinique',
		'Mauritania',
		'Mauritius',
		'Mayotte',
		'Mexico',
		'Micronesia',
		'Moldova',
		'Monaco',
		'Mongolia',
		'Montserrat',
		'Morocco',
		'Mozambique',
		'Myanmar',
		'Namibia',
		'Nauru',
		'Nepal',
		'Netherlands',
		'Netherlands Antilles',
		'New Caledonia',
		'New Zealand',
		'Nicaragua',
		'Niger',
		'Nigeria',
		'Niue',
		'Norfolk Island',
		'Northern Mariana Islands',
		'Norway',
		'Oman',
		'Pakistan',
		'Palau',
		'Panama',
		'Papua New Guinea',
		'Paraguay',
		'Peru',
		'Philippines',
		'Pitcairn Island',
		'Poland',
		'Portugal',
		'Puerto Rico',
		'Qatar',
		'Reunion',
		'Romania',
		'Russia',
		'Rwanda',
		'S. Georgia and S. Sandwich Isls.',
		'Saint Kitts &amp; Nevis',
		'Saint Lucia',
		'Saint Vincent and The Grenadines',
		'Samoa',
		'San Marino',
		'Sao Tome and Principe',
		'Saudi Arabia',
		'Senegal',
		'Seychelles',
		'Sierra Leone',
		'Singapore',
		'Slovakia',
		'Slovenia',
		'Somalia',
		'South Africa',
		'Spain',
		'Sri Lanka',
		'St. Helena',
		'St. Pierre and Miquelon',
		'Sudan',
		'Suriname',
		'Svalbard and Jan Mayen Islands',
		'Swaziland',
		'Sweden',
		'Switzerland',
		'Syria',
		'Taiwan',
		'Tajikistan',
		'Tanzania',
		'Thailand',
		'Togo',
		'Tokelau',
		'Tonga',
		'Trinidad and Tobago',
		'Tunisia',
		'Turkey',
		'Turkmenistan',
		'Turks and Caicos Islands',
		'Tuvalu',
		'Uganda',
		'Ukraine',
		'United Arab Emirates',
		'U.S. Minor Outlying Islands',
		'Uruguay',
		'Uzbekistan',
		'Vanuatu',
		'Vatican City',
		'Venezuela',
		'Vietnam',
		'Virgin Islands',
		'Wallis and Futuna Islands',
		'Western Sahara',
		'Yemen',
		'Yugoslavia (Former)',
		'Zaire',
		'Zambia',
		'Zimbabwe',
	);

	select_field($name, $label, $countries, $required);
}

function company_size_field($name, $label, $required = false) {
	$options = array(
		'1-24',
		'25-99',
		'100-499',
		'500-999',
		'1000-4999',
		'5000-9999',
		'10000+',
	);
	select_field($name, $label, $options, $required);
}

function industry_field($name, $label, $required = false) {
	$options = array(
		'Banking',
		'Business Process Outsourcer',
		'Computer Hardware/Software/Services',
		'Credit Union/CUSO',
		'Education',
		'Financial Services',
		'Government',
		'Healthcare/Pharmaceutical',
		'Insurance',
		'Manufacturing',
		'Retail',
		'TPA (Third Party Administrator)',
		'Transportation/Utilities',
		'Other',
	);
	select_field($name, $label, $options, $required);
}

function select_field($name, $label, $options, $required = false) {
	$classes = $required ? ' class="required"' : '';

	echo "<div class=\"$name field\">";
	echo "<label for=\"$name\"$classes>{$label}</label>";
	echo "<select name=\"$name\" id=\"$name\">";
	echo "<option value=\"\">Choose One</option>";

	foreach ($options as $option) {
		echo "<option value=\"$option\">$option</option>";
	}

	echo "</select>";
	echo "</div>";
}

// Comma separated list of categories
function dm_category_links($cats) {
	$links = array();

	foreach ($cats as $cat) {
		$url = get_category_link($cat->term_id);
		$links[] = "<a href=\"$url\">{$cat->name}</a>";
	}

	echo implode(', ', $links);
}

function format_file_size($kb, $precision=2) {
	$units = 'KB';
	$size = $kb;

	if ($kb > 1024) {
		$units = 'MB';
		$size = round($size / 1024, $precision);
	}

	return "{$size}{$units}";
}

// Get a list of authors, excluding the admin user. wp_list_authors doesn't do this correctly.
function dm_list_authors($exclude=array(1), $orderby='display_name', $hide_empty=true, $echo=true) {
	global $wpdb;

	$authors = get_users(array(
		'exclude' => $exclude,
		'orderby' => $orderby,
		'order' => 'ASC',
		'who' => 'authors',
	));
	$author_count = array();
	$post_cap = get_private_posts_cap_sql('post');
	$counts = (array)$wpdb->get_results("SELECT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type = 'post' AND $post_cap GROUP BY post_author");
	$output = '';

	foreach ($counts as $row) {
		$author_count[$row->post_author] = $row->count;
	}

	foreach ($authors as $author) {
		if (in_array($author->ID, $exclude)) {
			continue;
		}

		$posts = isset($author_count[$author->ID]) ? $author_count[$author->ID] : 0;

		if (!$posts && $hide_empty) {
			continue;
		}

		$output .= '<li>';
		$output .= '<a href="' . get_author_posts_url($author->ID, $author->user_nicename) . '" title="' . esc_attr(sprintf("Posts by %s", $author->display_name)) . '">' . $author->display_name . '</a>';
		$output .= '</li>';
	}

	if ($echo) {
		echo $output;
	} else {
		return $output;
	}
}
?>
