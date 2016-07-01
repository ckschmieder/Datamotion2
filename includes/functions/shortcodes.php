<?php
/**
 * DataMotion Shortcodes
 */

// Trim <br> and <p> tags from shortcodes
function dm_clean_shortcodes($content) {
	$ary = array(
		'<p>[' => '[',
		'</p>]' => ']',
		']<br />' => ']',
	);
	$content = strtr($content, $ary);
	return $content;
}
//add_filter('the_content', 'dm_clean_shortcodes');
remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 12);

// Collapsible Header Tag
function dm_collapsible_header_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'tag' => 'h2',
		'id' => '',
	), $atts));

	$id = $id ? ' id="' . esc_attr($id) . '"' : '';

	return "<$tag class=\"collapse-header\"$id><a href=\"#\" class=\"title\">" . $content . "</a><a href=\"#\" class=\"plus_minus\">-</a></$tag>";
}
add_shortcode('collapse_header', 'dm_collapsible_header_shortcode');

// Collapsible Content Tag
function dm_collapsible_content_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => '',
	), $atts));

	$id = $id ? ' id="' . esc_attr($id) . '"' : '';

	ob_start();
?>
	<div class="collapsible-content"<?php echo $id; ?>>
		<?php echo $content; ?>
	</div>
<?php

	$output = do_shortcode(ob_get_clean());
	return $output;
}
add_shortcode('collapse_content', 'dm_collapsible_content_shortcode');

// Sidebar navigation shortcode
function dm_sidebar_nav_shortcode($atts, $content = null) {

	if (!$content) return '';

	ob_start();
?>
	<div class="sidebar_tabs">
		<ul>
			<?php echo do_shortcode($content); ?>
		</ul>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('sidebar_nav', 'dm_sidebar_nav_shortcode');

// Sidebar nav item shortcode
function dm_sidebar_nav_item_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'url' => '',
	), $atts));

	if (!$content) return '';

	ob_start();
?>
	<li>
		<a href="<?php echo $url; ?>">
			<?php echo $content; ?>
		</a>
	</li>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('nav_item', 'dm_sidebar_nav_item_shortcode');

function dm_sidebar_info_box_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
	), $atts));

	if (!$content) return '';

	ob_start();
?>
	<div class="sidebar_info_box">
		<?php if ($title): ?>
			<h4><?php echo $title; ?></h4>
		<?php endif; ?>

		<?php echo wpautop(do_shortcode($content)); ?>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('info_box', 'dm_sidebar_info_box_shortcode');

// Product Brochure List based on the products associated with the current post
function dm_product_brochure_list_shortcode($atts, $content = null) {
	wp_reset_query();
	global $post;

	extract(shortcode_atts(array(
		'post_id' => ($post ? $post->ID : ''),
		'title' => 'View Product Brochures',
		'limit' => -1,
	), $atts));

	if (!$post_id) {
		return '';
	}

	$term_ids = dm_get_post_term_ids($post_id, 'products');

	if (empty($term_ids)) {
		return '';
	}

	$args = array(
		'post_status' => 'publish',
		'post_type' => 'product_brochures',
		'posts_per_page' => $limit,
		'tax_query' => array(
			array(
				'taxonomy' => 'products',
				'field' => 'id',
				'terms' => $term_ids,
			),
		),
	);

	$query = new WP_Query($args);

	if (!$query->have_posts()) {
		return '';
	}

	ob_start();
?>
	<div class="sidebar_secondary_links">
		<h4><?php echo $title; ?></h4>
		<ul>
			<?php while ($query->have_posts()): $query->the_post(); ?>
				<?php
				$pod = pods('product_brochures', $post->ID);
				$pdf = $pod->field('brochure_pdf');
				?>
				<li>
					<a href="<?php echo $pdf['guid']; ?>" target="_blank"><?php the_title(); ?></a>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('product_brochure_list', 'dm_product_brochure_list_shortcode');

// Whitepapers listing shortcode
function dm_whitepapers_shortcode($atts) {
	global $post;

	extract(shortcode_atts(array(
		'title' => 'View Whitepapers:',
		'post_id' => ($post ? $post->ID : ''),
		'limit' => 1
	), $atts));

	$product_ids = dm_get_post_term_ids($post_id, 'products');

	if (empty($product_ids)) {
		return '';
	}

	$args = array(
		'post_status'    => 'publish',
		'post_type'      => 'library_documents',
		'posts_per_page' => $limit,
		'tax_query'      => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'library_categories',
				'field'    => 'slug',
				'terms'    => array( 'white-papers' ),
			),
			array(
				'taxonomy' => 'products',
				'field'    => 'id',
				'terms'    => $product_ids,
			),
		),
	);

	$query = new WP_Query($args);

	if (!$query->have_posts()) {
		return '';
	}

	ob_start();
?>
	<div class="sidebar_secondary_links">
		<h4><?php echo $title; ?></h4>

		<ul>
			<?php while ($query->have_posts()): $query->the_post(); ?>
				<li>
					<a href="<?php echo get_permalink($post->ID); ?>">
						<?php the_title(); ?>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('whitepapers', 'dm_whitepapers_shortcode');

// Case Studies listing shortcode
function dm_case_studies_shortcode($atts, $content=null) {
	global $post;

	extract(shortcode_atts(array(
		'title' => 'View Case Studies:',
		'post_id' => $post->ID,
		'limit' => 1,
	), $atts));

	$solution_ids = dm_get_post_term_ids($post_id, 'solutions');

	$args = array(
		'post_status' => 'publish',
		'post_type' => 'library_documents',
		'posts_per_page' => $limit,
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'library_categories',
				'field' => 'slug',
				'terms' => array( 'case-studies' ),
			),
			array(
				'taxonomy' => 'solutions',
				'field' => 'id',
				'terms' => $solution_ids,
			),
		),
	);

	$query = new WP_Query($args);

	if (!$query->have_posts()) {
		return '';
	}

	ob_start();
?>
	<div class="sidebar_secondary_links">
		<h4><?php echo $title; ?></h4>

		<ul>
			<?php while ($query->have_posts()): $query->the_post(); ?>
				<li>
					<a href="<?php echo get_permalink($post->ID); ?>">
						<?php the_title(); ?>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('case_studies', 'dm_case_studies_shortcode');

// "In the News" Shortcode for page sidebars - Products
function dm_product_news_shortcode($atts, $content = null) {
	global $post;
	extract(shortcode_atts(array(
		'post_id' => ($post ? $post->ID : ''),
		'title' => "In the News",
		'limit' => 1,
	), $atts));

	if (!$post_id) {
		return '';
	}

	$term_ids = dm_get_post_term_ids($post_id, 'products');

	if (empty($term_ids)) return '';

	$args = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'posts_per_page' => $limit,
		'orderby' => 'date',
		'order' => 'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'products',
				'field' => 'id',
				'terms' => $term_ids,
			)
		),
	);
	$query = new WP_Query($args);

	if (!$query->have_posts()) return '';

	ob_start();
?>
	<div class="sidebar_news_excerpt">
		<?php while($query->have_posts()): $query->the_post(); ?>
			<p>
				<strong><?php echo $title; ?>:</strong>
				<?php the_title(); ?>
				<a href="<?php the_permalink(); ?>">READ MORE &raquo;</a>
			</p>
		<?php endwhile; ?>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('product_news', 'dm_product_news_shortcode');

// "In the News" Shortcode for page sidebars - Solutions
function dm_solution_news_shortcode($atts, $content = null) {
	global $post;
	extract(shortcode_atts(array(
		'post_id' => ($post ? $post->ID : ''),
		'title' => "In the News",
		'limit' => 1,
	), $atts));

	if (!$post_id) {
		return '';
	}

	$term_ids = dm_get_post_term_ids($post_id, 'solutions');

	if (empty($term_ids)) return '';

	$args = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'posts_per_page' => $limit,
		'orderby' => 'date',
		'order' => 'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'solutions',
				'field' => 'id',
				'terms' => $term_ids,
			)
		),
	);
	$query = new WP_Query($args);

	if (!$query->have_posts()) return '';

	ob_start();
?>
	<div class="sidebar_news_excerpt">
		<?php while($query->have_posts()): $query->the_post(); ?>
			<p>
				<strong><?php echo $title; ?>:</strong>
				<?php the_title(); ?>
				<a href="<?php the_permalink(); ?>">READ MORE &raquo;</a>
			</p>
		<?php endwhile; ?>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('solution_news', 'dm_solution_news_shortcode');

// Sidebar Testimonial Shortcode
function dm_testimonial_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'author' => '',
		'title' => 'What Our Clients Say',
	), $atts));

	if (!$content) return '';

	ob_start();
?>
	<div class="sidebar_testimonial">

			<h4>
				<div class="box"></div>
				<?php echo $title; ?>
			</h4>


		<blockquote>
			<?php echo $content; ?>
		</blockquote>

		<?php if ($author): ?>
			<cite>
				<?php echo $author; ?>
			</cite>
		<?php endif; ?>
	</div>
<?php

	$output = ob_get_clean();
	return $output;
}
add_shortcode('testimonial', 'dm_testimonial_shortcode');

// Sidebar Contact Information Shortcode
function dm_contact_info_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Contact Us',
	), $atts));

	$contact_info = get_transient('dm_contact_info');

	if ($contact_info === false) {
		$contact_info = array(
			'name'              => get_option('dm_company_name'),
			'address'           => get_option('dm_company_address'),
			'phone_1'           => get_option('dm_company_phone_1'),
			'phone_2'           => get_option('dm_company_phone_2'),
			'fax'               => get_option('dm_company_fax'),
			'map_link'          => get_option('dm_company_map_link'),
			'portland_address'  => get_option('dm_company_portland_address'),
			'portland_map_link' => get_option('dm_company_portland_map_link'),
		);
		set_transient('dm_company_info', $contact_info, 86400);
	}

	ob_start();
?>
	<div class="sidebar_contact_us">
		<h4><?php echo $title; ?></h4>
		<div class="office">
			<h5><?php echo $contact_info['name']; ?></h5>
			<address>
				<?php echo $contact_info['address']; ?>
			</address>
			<div class="phone field">
				<div class="label">Phone:</div>
				<div class="number"><?php echo $contact_info['phone_1']; ?></div>
				<div class="clearfix"></div>
				<div class="number"><?php echo $contact_info['phone_2']; ?></div>
				<div class="clearfix"></div>
				<div class="label">Fax:</div>
				<div class="number"><?php echo $contact_info['fax']; ?></div>
			</div>
			<div class="clearfix"></div>
			<a href="<?php echo $contact_info['map_link']; ?>" target="_blank">View Map</a>
		</div>
		<div class="office">
			<h5>Portland Office</h5>
			<address>
				<?php echo $contact_info['portland_address']; ?>
			</address>
			<a href="<?php echo $contact_info['portland_map_link']; ?>" target="_blank">View Map</a>
		</div>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('contact_info', 'dm_contact_info_shortcode');

// Custom Login Form
function dm_login_form_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'redirect' => site_url('/library/'),
		'remember' => true,
	), $atts));

	$args = array(
		'redirect' => $redirect,
		'remember' => $remember,
	);

	ob_start();
?>
	<?php if (is_user_logged_in()): ?>
		<p>
			You are already logged in.
			<br>
			<a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
		</p>
	<?php else: ?>
		<?php wp_login_form($args); ?>
	<?php endif; ?>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('login_form', 'dm_login_form_shortcode');

function dm_forgot_password_form_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'redirect' => $_SERVER['REQUEST_URI'],
	), $atts));

	ob_start();
?>
	<div id="forgot_password_form">
		<?php if ($_GET['reset']): ?>
			<p class="success">
				A message will be sent to your email address.
			</p>
		<?php else: ?>
			<p>
				Enter your username or email address to reset your password.
			</p>

			<form action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post'); ?>" method="post">
				<div class="username">
					<label for="user_login">Username or Email:</label>
					<input type="text" name="user_login" id="user_login">
				</div>
				<div class="login_fields">
					<?php do_action('login_form', 'resetpass'); ?>
					<input type="submit" name="user-submit" value="Reset my password">
					<input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>?reset=true">
					<input type="hidden" name="user-cookie" value="1">
				</div>
			</form>
		<?php endif; ?>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('forgot_password_form', 'dm_forgot_password_form_shortcode');

function dm_user_registration_form_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'redirect' => $_SERVER['REQUEST_URI'],
		'submit' => 'Submit',
	), $atts));

	ob_start();
?>

<?php if ($_GET['success'] == 'true'): ?>
	<div class="success">
		<p>
			Thanks for registering! You are now logged in.
		</p>
		<p>
			<a href="<?php echo site_url('/library'); ?>">View Library</a>
		</p>
	</div>
<?php else: ?>
	<div id="registration_form">
		<p>
			(<span class="required">*</span> required)
		</p>
		<form action="<?php echo site_url('/register-user'); ?>" method="post" data-validate-username="<?php echo site_url('/validate-username.json'); ?>" data-validate-email="<?php echo site_url('/validate-email.json'); ?>">

			<?php form_field('text', 'user_first_name', 'First Name', true); ?>
			<?php form_field('text', 'user_last_name', 'Last Name', true); ?>
			<?php form_field('text', 'user_email', 'Email', true); ?>
			<?php form_field('text', 'user_company', 'Company', true); ?>
			<?php form_field('text', 'user_login', 'Username', true); ?>
			<?php form_field('password', 'user_password', 'Password', true); ?>
			<?php form_field('password', 'user_password_confirmation', 'Password Confirmation', true); ?>

			<div class="submit_wrap">
				<input type="submit" value="<?php echo $submit; ?>">
				<?php wp_nonce_field('register'); ?>
			</div>
		</form>
	</div>
<?php endif; ?>

<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('user_registration_form', 'dm_user_registration_form_shortcode');

// List subpages (children of current page)
function dm_list_subpages_shortcode($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'page_id' => $post->ID,
	), $atts));

	$pages = get_pages(array(
		'hierarchical' => false,
		'parent' => $page_id,
		'post_type' => 'page',
	));

	if (!empty($pages)) {
		ob_start();
?>
<ul class="page-list">
	<?php foreach ($pages as $page): ?>
		<li>
			<a href="<?php echo get_permalink($page->ID); ?>"><?php echo $page->post_title; ?></a>
		</li>
	<?php endforeach; ?>
</ul>
<?php
	} else {
		$output = '';
	}

	return $output;
}
add_shortcode('list_subpages', 'dm_list_subpages_shortcode');

// Embed a Hubspot Form
function dm_hubspot_form_shortcode($atts) {
	extract(shortcode_atts(array(
		'portal_id' => '219987',
		'id' => '',
		'campaign_id' => '',
		'include_script' => true
	), $atts));

	ob_start();
?>
	<?php if ($include_script): ?>
		<script charset="utf-8" src="//js.hubspot.com/forms/current.js"></script>
	<?php endif; ?>
	<script>
		var formProps = {
			portalId: '<?php echo $portal_id; ?>',
			formId: '<?php echo $id; ?>'
		};
		<?php if (!empty($campaign_id)): ?>
		formProps.sfdcCampaignId = '<?php echo $campaign_id; ?>';
		<?php endif; ?>
		hbspt.forms.create(formProps);
	</script>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('hubspot_form', 'dm_hubspot_form_shortcode');

// Brightcove Video Embed Shortcode
function dm_brightcove_embed_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => 400,
		'height' => 220,
		'player_id' => '1083378382001',
		'player_key' => 'AQ~~,AAAA7SJlvPE~,hKj__M4BL26l6pXW6JlVCmbP5q8je1e_',
		'video_id' => ''
	), $atts));

	ob_start();
?>
	<div class="brightcove_video">
		<script src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
		<object id="myExperience<?php echo $video_id; ?>" class="BrightcoveExperience">
			<param name="bgcolor" value="#FFFFFF" />
			<param name="width" value="<?php echo $width; ?>" />
			<param name="height" value="<?php echo $height; ?>" />
			<param name="playerID" value="<?php echo $player_id; ?>" />
			<param name="playerKey" value="<?php echo $player_key; ?>" />
			<param name="isVid" value="true" />
			<param name="isUI" value="true" />
			<param name="dynamicStreaming" value="true" />
			<param name="@videoPlayer" value="<?php echo $video_id; ?>" />
		</object>
		<script>
			brightcove.createExperiences();
		</script>
	</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('brightcove_video', 'dm_brightcove_embed_shortcode');

// Subscription Form Shortcode
function dm_email_subscription_form_shortcode($atts) {
	extract(shortcode_atts(array(
		'title' => 'Subscribe to Our eNews'
	), $atts));

	ob_start();
?>
<div class="newsletter_form">
	<h3><?php echo $title; ?></h3>
	<form action="<?php echo site_url('/subscribe.json'); ?>" method="post">
		<div class="name_field field">
			<label for="newsletter_name">Name</label>
			<input type="text" id="newsletter_name">
		</div>
		<div class="email_field field">
			<label for="newsletter_email">Email</label>
			<input type="text" id="newsletter_email">
		</div>
		<input type="submit" id="submit" value="SUBMIT &raquo;">
	</form>
</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('subscribe_form', 'dm_email_subscription_form_shortcode');

// Free Trial Form
function dm_free_trial_form_shortcode($atts) {
	extract(shortcode_atts(array(
		'title' => '',
		'validate' => true,
	), $atts));

  $employee_options = array(
    '1-24',
    '25-99',
    '100-499',
    '500-999',
    '1000-4999',
    '5000-9999',
    '10,000-99,999',
    '100,000+',
  );

  $industry_options = array(
    'Associations',
    'Banking',
    'Chemicals',
    'Construction',
    'Consumer Products',
    'Credit Union',
    'Education',
    'Energy / Utilities',
    'Engineering',
    'Federal',
    'Financial Services',
    'Food & Beverage',
    'Government',
    'Health Insurance',
    'Higher Education',
    'Hospitals / Health Care',
    'Insurance',
    'IT Services',
    'Legal Services',
    'Leisure',
    'Logistics / Transportation',
    'Managed Service Providers',
    'Manufacturing',
    'Manufacturing - Durables',
    'Manufacturing - Non-Durables',
    'Media',
    'Medical Devices',
    'Minerals & Mining',
    'Non-Profit',
    'Oil & Gas',
    'Pharmaceuticals',
    'Process Outsourcing',
    'Professional Services',
    'Real Estate',
    'Restaurants',
    'Retail',
    'Services',
    'Shipping',
    'Telecommunications',
    'Third Party Administrator',
    'Wholesale & Distribution',
    'Other',
  );

	ob_start();
?>
<div class="free_trial_form">
	<form action="<?php echo site_url('/free-trial-submit.json'); ?>" method="post">
		<div class="field first_name">
			<label for="first_name">First Name <span class="reqired">*</span></label>
			<input type="text" name="first_name" id="first_name">
		</div>
		<div class="field last_name">
			<label for="last_name">Last Name <span class="reqired">*</span></label>
			<input type="text" name="last_name" id="last_name">
		</div>
		<div class="field email">
			<label for="email">Email <span class="reqired">*</span></label>
			<input type="email" name="email" id="email">
		</div>
		<div class="field company">
			<label for="company">Company <span class="reqired">*</span></label>
			<input type="text" name="company" id="company">
		</div>
		<div class="field phone">
			<label for="phone">Phone <span class="reqired">*</span></label>
			<input type="text" name="phone" id="phone">
		</div>
    <div class="field state">
      <label for="state">Mailing State/Province <span class="required">*</span></label>
      <input type="text" name="state" id="state">
    </div>
    <div class="field employees">
      <label for="employees">Number of Employees <span class="required">*</span></label>
      <select id="employees" name="employees">
        <option value="" disabled selected>-- Please Select --</option>
        <?php foreach ($employee_options as $opt): ?>
          <option value="<?php echo esc_attr($opt); ?>">
            <?php echo $opt; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="field industry">
      <label for="industry">Industry <span class="required">*</span></label>
      <select id="industry" name="industry">
        <option value="" disabled selected>-- Please Select --</option>
        <?php foreach ($industry_options as $opt): ?>
          <option value="<?php echo esc_attr($opt); ?>">
            <?php echo $opt; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
		<div class="field submit">
			<span class="spinner">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/ajax-loader.gif" alt="Loading Spinner">
			</span>
			<input type="submit" value="register for trial">
		</div>
	</form>
</div>
<?php
	$output = ob_get_clean();
	return $output;
}
add_shortcode('free_trial_form', 'dm_free_trial_form_shortcode');

?>
