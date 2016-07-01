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
    <div class="row">
      <div class="three_column customer_slider_container">
        <h3>Featured Customers and Partners</h3>
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
    </div>
  <?php endif; ?>
<?php endif; ?>

	<div class="clearfix"></div>
	<footer class="row">
		<div class="member_images">
			<div class="direct_trust">
				<span>Member of</span>
				<div class="clearfix"></div>
				<a href="http://www.directtrust.org/"><div class="direct_trust_image"></div></a>
			</div>
      <div class="ehnac">
        <a href="https://www.ehnac.org/accreditation-full/" target="_blank">
            <div class="ehnac_image"></div>
        </a>
      </div>
		</div>


	</footer>
	<div class="footer_info_links">
		<?php
		wp_nav_menu(array(
			'theme_location' => 'footer-links',
			'container' => false,
		));
		?>
	</div>

</div> <!-- end of container -->

<?php wp_footer(); ?>

<script type="text/javascript" language="javascript">llactid=11438</script>
<script type="text/javascript" language="javascript" src="http://t4.trackalyzer.com/trackalyze.js"></script>

<!-- ClickTale Bottom part -->
<script type='text/javascript'>
document.write(unescape("%3Cscript%20src='"+
(document.location.protocol=='https:'?
"https://cdnssl.clicktale.net/www07/ptc/3c236ba9-bf5d-4060-a3c5-2913bb61b7c9.js":
"http://cdn.clicktale.net/www07/ptc/3c236ba9-bf5d-4060-a3c5-2913bb61b7c9.js")+"'%20type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- ClickTale end of Bottom part -->
<script type="text/javascript">
    adroll_adv_id = "5ALWKWZI7FERFBGPJS2QCC";
    adroll_pix_id = "34P7QQ2BW5FN3FT2XWOFXL";
    /* OPTIONAL: provide email to improve user identification */
    /* adroll_email = "username@example.com"; */
    (function () {
        var _onload = function(){
            if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
            if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
                document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
        };
        if (window.addEventListener) {window.addEventListener('load', _onload, false);}
        else {window.attachEvent('onload', _onload)}
    }());
</script>
</body>
</html>
