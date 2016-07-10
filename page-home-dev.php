<?php
/**
 * Template Name: DataMotion Home-Dev Template
 */
?>

<?php get_header(); ?>


  <section id="hero" class="home-section nav-section">
    <aside class="left hero">
      <h2 class="animated fadeIn"><span class="nobr">Protect your data - </span></br><span class="nobr">and your reputation</span></h2>
      <p class="desk animated fadeInDown">Send secure, compliant messages, email and files from anywhere, to anywhere.</p>
    </aside>
    <div class="section_menu_contain">
      <?php wp_nav_menu(array('container' => 'ul', 'menu_class' => 'desk-menu primary-menu', 'theme_location' => 'info-new')); ?>
    </div>
  </section>
  <div class="mobile hero">
    <p>Send secure, compliant messages, email and files from anywhere, to anywhere.</p>
  </div>
  
  <?php wp_nav_menu(array('menu_class' => 'mob-menu', 'container' => 'ul', 'theme_location' => 'info-new')); ?>
  
  <section id="video" class="home-section">
    <div class="animated fadeIn video-container">
      <div id="player"></div>
    </div>
    <aside class="right desk">
      <h2 class="animated fadeIn">Security & compliance</br>- it's required</h2>
      <p class="animated fadeInDown">Securing communications containing PHI and PII 
        <a class="tooltip tooltip-top" data-tooltip="Protected health info and personally indentifiable info">
          <span class="fa-stack">
            <i class="fa fa-circle-thin fa-stack-2x"></i>
            <i class="fa fa-info fa-stack-1x"></i>
          </span>
        </a> is not optional - it's a legal requirement.</p>

    </aside>
  </section>
  <div class="mobile video">
    <h2>Security & compliance - it's required</h2>
    <p>Securing communications containing PHI and PII is not optional - it's a legal requirement.</p>
  </div>

  <section id="logo-slider" class="home-section-slider">
      <div class="indent slider">
        <aside class="slider-text">
          <h2>A platform for success</h2>
              <p>See how others protect their data and streamline their workflows.</p>
        </aside>
        <div class="gallery gallery-responsive portfolio_slider">
          <div class="wow flipInX inner"  data-wow-duration=".8s" data-wow-delay=".2s">
            <a href="https://www.datamotion.com/datamotion-securemail-project-for-dell-sonicwall/">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/dell_blue_rgb-222-140.jpg" alt="dell">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="wow flipInX inner"  data-wow-duration=".8s" data-wow-delay=".4s">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/guardian1.jpg" alt="">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="wow flipInX inner"  data-wow-duration=".8s" data-wow-delay=".6s">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/sunlifefinancial.jpg" alt="sunlife financial">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="wow flipInX inner"  data-wow-duration=".8s" data-wow-delay=".8s">
            <a href="https://www.datamotion.com/hipaa-compliant-secure-information-exchange-for-salesforce/">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/salesforce_logo_detail_2.png" alt="salesforce">
              <p>View Case Study</p>
            </a>
          </div>
          <div class="wow flipInX inner"  data-wow-duration=".8s" data-wow-delay="1s">
            <a href="#">
              <img class="logo-slide img-responsive portfolio-item" src="https://www.datamotion.com/wp-content/uploads/2016/06/Rite_Aid_Pharmacy.jpg" alt="rite aid pharmacy">
              <p>View Case Study</p>
            </a>
          </div>
        </div>
      </div> <!-- end .indent -->
    </section>

  <section id="lock" class="home-section">
    <aside class="right">
      <h2 class="wow fadeIn" data-wow-delay=".2s" data-wow-duration="1.4s">Build in security</br>& compliance</h2>
      <p class="wow fadeInDown desk" data-wow-delay=".4s" data-wow-duration="1.2s">Power your communication workflows & apps using our complete set of standard connectors, SDKs & APIs.</p>
      <ul id="lock-menu" class="button-wrap lock desk-menu">
        <li class="new-button wow flipInX" data-wow-delay=".7s" data-wow-duration="1.5s"><a href="">IT Pro Solutions</a></li>
        <li class="new-button wow flipInX" data-wow-delay=".9s" data-wow-duration="1.5s"><a href="">App Developer Solutions</a></li>
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
      <h2 class="wow fadeIn">Security & compliance shouldn't slow you down</h2>
      <p class="wow fadeInDown desk">Streamline communications and accelerate positive outcomes while raising your security & compliance profile.</p>
    </aside>
  </section>

  <div class="mobile cross">
    <p>Streamline communications and accelerate positive outcomes while raising your security & compliance profile.</p>
    <?php wp_nav_menu(array('menu_class' => 'mob-menu', 'container' => 'ul', 'theme_location' => 'info-new')); ?>
  </div>

  <section id="social" class="cta-section home-section nav-section">
    <h3 class="wow fadeIn" data-wow-delay=".1s" data-wow-duration="1.2s">Stay up to date with us...</h3>
    <ul id="cta-menu" class="link-wrap cta">
      <li class="new-link wow flipInX" data-wow-delay=".5s" data-wow-duration="1.2s"><a href="https://www.datamotion.com/category/blog/">Blog Posts</a></li>
      <li class="new-link wow flipInX" data-wow-delay=".5s" data-wow-duration="1.2s"><a href="https://www.datamotion.com/category/news/">News</a></li>
      <li class="new-link wow flipInX" data-wow-delay=".5s" data-wow-duration="1.2s"><a href="https://www.datamotion.com/upcoming-events/">Events</a></li>
      <li class="new-link wow flipInX" data-wow-delay=".5s" data-wow-duration="1.2s"><a href="https://www.datamotion.com/contact-sales/">Contact Us</a></li>
      <li class="new-link wow flipInX" data-wow-delay=".5s" data-wow-duration="1.2s"><a href="http://info.datamotion.com/newslettersignup?__hssc=&__hstc=&__hsfp=2862001475&hsCtaTracking=41b5ee89-f9f8-4544-9b12-905983ec4c2d%7C160ec1a6-73c4-49a7-bef9-8f2a64c08ae1">eNewsletter</a></li>
    </ul>
    <!-- Put Social Icons HERE -->
  </section>



<?php get_footer('home'); ?>