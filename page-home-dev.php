<?php
/**
 * Template Name: DataMotion Home-Dev Template
 */
?>

<?php get_header(); ?>


  <section id="hero" class="home-section nav-section">
    <aside class="left hero">
      <h2>Protect your data -</br>and your reputation</h2>
      <p class="desk">Send secure, compliant messages, email and files from anywhere, to anywhere.</p>
    </aside>
    <div class="section_menu_contain">
      <?php wp_nav_menu(array('container' => 'ul', 'menu_class' => 'desk-menu primary-menu', 'theme_location' => 'info-new')); ?>
    </div>
  </section>
  <div class="mobile hero">
    <p>Send secure, compliant messages, email and files anywhere, to anywhere.</p>
  </div>
  
  <?php wp_nav_menu(array('menu_class' => 'mob-menu', 'container' => 'ul', 'theme_location' => 'info-new')); ?>
  
  <section id="video" class="home-section">
    <div class="video-container">
      <div id="player"></div>
    </div>
    <aside class="right desk">
      <h2>Security & compliance</br>- it's required</h2>
      <p>Securing communications containing PHI and PII <a href="" data-toggle="tooltip" data-placement="right" title="Test tooltip">i</a> is not optional - it's a legal requirement.</p>
    </aside>
  </section>

  <section id="logo-slider" class="home-section-slider">
      <div class="indent slider">
        <aside class="slider-text">
          <h2>A platform for success</h2>
              <p>See how others protect their data and streamline their workflows.</p>
        </aside>
        <div class="gallery gallery-responsive portfolio_slider">
          <div class="inner">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/dell_blue_rgb-222-140.jpg" alt="dell">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="inner">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/guardian1.jpg" alt="">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="inner">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/MS-Gold-Application-Partner-Boost_222x140b.png" alt="microsoft partner">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="inner">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/sunlifefinancial.jpg" alt="sunlife financial">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="inner">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/salesforce_logo_detail_2.png" alt="salesforce">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="inner">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/Rite_Aid_Pharmacy.jpg" alt="rite aid pharmacy">
              <p>View Case Study</p>
            </a>
          </div>
        </div>
      </div> <!-- end .indent -->
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
      <li class="new-link"><a href="#">eNewsletter</a></li>
    </ul>
    <!-- Put Social Icons HERE -->
  </section>



<?php get_footer('home'); ?>