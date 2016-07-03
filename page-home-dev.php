<?php
/**
 * Template Name: DataMotion Home-Dev Template
 */
?>

<?php get_header(); ?>

<div id="main">
  <section id="hero" class="home-section nav-section">
    <aside class="left hero">
      <h2>Protect your data -</br>and your reputation</h2>
      <p class="desk">Send secure, compliant messages, email and files anywhere, to anywhere.</p>
    </aside>
    <div class="section_menu_contain">
      <?php wp_nav_menu(array('container' => 'ul', 'menu_class' => 'desk-menu primary-menu', 'theme_location' => 'info-new')); ?>
    </div>
  </section>
  <div class="mobile hero">
    <p>Send secure, compliant messages, email and files anywhere, to anywhere.</p>
  </div>
  
  <?php wp_nav_menu(array('menu_class' => 'mob-menu', 'container' => 'ul', 'theme_location' => 'info-new')); ?>
  
  <section id="logos" class="home-section-slider">
  <div class="logo-slider-wrap">  
    <?php
      if (is_page()) {
        global $post;
        $page        = pods('page', $post->ID);
        $hide_slider = (bool)$page->field('hide_footer_slider');
      } else {
        $hide_slider = false;
      }

      if (!$hide_slider):
        $logos = pods('partner_logos', array(
          'where'   => 't.published = 1',
          'orderby' => 't.order_number ASC',
          'limit'   => 12,
        ));

        if ($logos->total()):
      ?>
          
            <div class="three_column customer_slider_container">
              <h2>A platform for success</h2>
              <p>See how others protect their data and streamline their workflows.</p>
              <div id="customer_slider">
                <ul class="slides">
                  <?php while ($logos->fetch()): ?>
                    <li>
                      <?php
                      $img = $logos->field('logo');
                      $retina_img = $logos->field('hi_res_logo');
                      $link_url = $logos->field('link_url');
                      $data_attr = $retina_img ? ' data-retina-src="' . $retina_img['guid'] . '"' : '';
                      ?>
                      <?php if ($link_url): ?>
                        <a href="<?php echo $link_url; ?>" target="_blank">
                      <?php endif; ?>
                      <img src="<?php echo $img['guid']; ?>" width="222" alt="<?php echo $logos->field('name'); ?>"<?php echo $data_attr; ?>>
                      <?php if ($link_url): ?>
                        </a>
                      <?php endif; ?>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </div>
            </div>
          
        <?php endif; ?>
      <?php endif; ?>

  </div>
  
  </section>
  <section id="video" class="home-section">
    <div class="video-container">
      <div id="player"></div>
    </div>
    <aside class="right desk">
      <h2>Security & compliance</br>- it's required</h2>
      <p>Securing communications containing PHI and PII <a href="" data-toggle="tooltip" data-placement="right" title="Test tooltip">i</a> is not optional - it's a legal requirement.</p>
    </aside>
  </section>
  <div class="mobile video">
    <h2>Security & compliance - it's required</h2>
    <p>Securing communications containing PHI and PII <a href="" data-toggle="tooltip" data-placement="right" title="Test tooltip">i</a> is not optional - it's a legal requirement.</p>
  </div>
  <section id="lock" class="home-section">
    <aside class="right">
      <h2>Build in security</br>& compliance</h2>
      <p class="desk">Power your communication work flows & apps using our complete set of standard connectors, SDKs & APIs.</p>
      <ul id="lock-menu" class="button-wrap lock desk-menu">
        <li class="new-button"><a href="">IT Pro Solutions</a></li>
        <li class="new-button"><a href="">App Developer Solutions</a></li>
      </ul>
    </aside>
    
  </section>
  <div class="mobile lock">
    <p>Power your communication work flows & apps using our complete set of standard connectors, SDKs & APIs.</p>
  </div>
  <ul class="button-wrap lock mob-menu">
      <li class="new-button"><a href="">IT Pro Solutions</a></li>
      <li class="new-button"><a href="">App Developer Solutions</a></li>
  </ul>
  <section id="cross" class="home-section nav-section">
    <aside class="left">
      <h2>Security & compliance shouldn't slow you down</h2>
      <p class="desk">Streamline communications and accelerate positive outcomes while raising your security & compliance profile.</p>
    </aside>
    <div class="section_menu_contain">
      <?php wp_nav_menu(array('container' => 'ul', 'menu_class' => 'desk-menu primary-menu', 'theme_location' => 'info-new')); ?>
    </div>
  </section>
  <div class="mobile cross">
    <p>Streamline communications and accelerate positive outcomes while raising your security & compliance profile.</p>
  </div>
  <section id="social" class="cta-section home-section nav-section">
    <h3>Stay up to date with us...</h3>
    <ul id="cta-menu" class="link-wrap cta">
      <li class="new-link"><a href="https://www.datamotion.com/category/blog/">Blog Posts</a></li>
      <li class="new-link"><a href="https://www.datamotion.com/category/news/">News</a></li>
      <li class="new-link"><a href="https://www.datamotion.com/category/news/">Events</a></li>
      <li class="new-link"><a href="https://www.datamotion.com/about-us/contact-us/">Contact Us</a></li>
      <li class="new-link"><a href="#">Email Sign-up</a></li>
    </ul>
    <!-- Put Social Icons HERE -->
  </section>
</div><!-- END #main -->



<?php get_footer('home'); ?>