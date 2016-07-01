
	<div class="clearfix"></div>
	<footer>
    <div class="footer_flex_wrap">
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
  		</div><!-- end .member_images -->

      <div class="footer_text_wrap">
        <div class="footer_contact_info">
          <p>DataMotion, INc., 200 Park Ave, Suite 302, Florham Park, NJ 07932<br>(800) 672-7233 or (973) 455-1245</p>
        </div>

      	<div class="footer_info_links">
      		<?php
      		wp_nav_menu(array(
      			'theme_location' => 'footer-links',
      			'container' => false,
      		));
      		?>
      	</div>
      </div><!-- end .footer_text_wrap -->
    </div><!-- end .footer_flex_wrap -->
  </footer>

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
