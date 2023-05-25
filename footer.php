<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package NirTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'NirTheme_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

<div class="footer"><div class="section"><div class="panel meet-agent">
            Meet with a real estate agent today
            <span>
                Call
                <a href="tel:18337091946" class="link"><i class="icon-phone-o"></i> <span>1-833-709-1946</span></a></span></div></div> <div class="section footlinks"><div class="gs-fixed"><div class="panel"><ul><li class="_h-text"><a href="javascript:;" class="_h-text">About</a></li><li class=""><a href="https://www.ojohome.ca/about/" title="About OJO Home">About OJO Home</a></li><li class=""><a href="https://www.ojohome.ca/sitemap/" title="Sitemap">Sitemap</a></li><li class=""><a href="https://www.ojohome.ca/schools/" title="Schools">Schools</a></li><li class=""><a href="https://www.ojohome.ca/about/terms-of-use/" title="Terms of Use">Terms of Use</a></li><li class=""><a href="https://www.ojohome.ca/about/privacy-policy/" title="Privacy Policy">Privacy Policy</a></li></ul><ul><li class=""><a href="javascript:;" class="_h-text">Homes</a></li><li class=""><a title="Homes for Sale Near Me">Homes for Sale Near Me</a></li><li class=""><a title="Open Houses Near Me">Open Houses Near Me</a></li><li class=""><a href="https://www.ojohome.ca/sold/" title="Homes Recently Sold Near Me">Homes Recently Sold Near Me</a></li><li class=""><a href="https://blog.ojohome.ca/" title="Home Journey How-to's">Home Journey How-to's</a></li></ul> <ul><li><a href="javascript:;" class="_h-text">OJO Home Brokerage</a></li> <li><a href="https://www.ojohome.ca/brokerage/" title="Brokerage Office">Brokerage Office</a></li> <li><a href="https://www.ojohome.ca/brokerage/#applynow" title="Apply">Apply</a></li> <li class="social-links"><a href="https://www.facebook.com/OJOCanada" target="_blank" rel="me" aria-label="facebook"><i class="icon-facebook"></i></a><a href="https://www.instagram.com/ojohomecanada/" target="_blank" rel="me" aria-label="instagram"><i class="icon-instagram"></i></a><a href="https://twitter.com/ojolabs" target="_blank" rel="me" aria-label="twitter"><i class="icon-twitter"></i></a><a href="https://www.pinterest.ca/ojocanada/" target="_blank" rel="me" aria-label="pinterest"><i class="icon-pinterest"></i></a></li></ul> <ul class="contact"><li><a class="link"><i class="icon-envelope"></i> <span title="Drop a message">Drop a message</span></a></li> <li><a href="tel:18337091946" class="link"><i class="icon-phone-o"></i> <span>1-833-709-1946</span></a></li> <li><a href="https://ojohome.zendesk.com/hc/en-us?utm_source=footer&amp;utm_medium=link" target="_blank" class="link"><i class="icon-live-connect"></i> <span title="Help Center">Help Center</span></a></li> <li><a href="javascript:;" class="btn primary small">Join</a></li> <li><div>Receive guidance on homebuying, selling, and financing, direct to your inbox.</div></li></ul> <!----></div></div></div> <div class="gs-fixed"><div class="section f10 text-secondary mvt-disclaimer"><div class="panel"><div class="paragraph">
            All references to OJO and OJO Home refer to OJO Home Canada Ltd. 3080 Yonge Street, Suite 6060, Toronto, Ontario M4N 3N1 (647) 694-6756. OJO Canada is an RBC Company.
        </div> <div><a href="https://www.ojohome.ca/about/terms-of-use/" class="link">Terms of use</a>  
            <a href="https://www.ojohome.ca/about/privacy-policy/" class="link">Privacy Policy</a>  
            <a href="https://www.rbc.com/legal/" class="link">Legal</a>  
            <a href="https://www.rbc.com/privacysecurity/ca/index.html" class="link">Privacy &amp; Security</a>  
            <a href="https://www.rbc.com/accessibility/" class="link">Accessibility</a>  
            </div> <div class="paragraph"><i class="f8 icon-doc-file"></i> <span class="address-info">Please use the following address to send referral payments</span> <br>
            Lockbox: OJOHOME CANADA LTD PO BOX 9479, STN A, TORONTO, ON M5W 4E1 Lockbox Number: T09479C
        </div> <!----> <!----> <!----> <div class="paragraph">
            IDX information is provided exclusively for consumers’ personal, non-commercial use and that it may not be used for any purpose other than to identify prospective properties consumers may be interested in purchasing. Information deemed reliable but not guaranteed to be accurate. Listing information updated daily.
            Copyright OJOHome Canada LTD © 2023.
        </div> <!----> <div class="paragraph">
            The trademarks REALTOR®, REALTORS®, and the REALTOR® logo are controlled by The Canadian Real Estate Association (CREA) and identify real estate professionals who are members of CREA. The trademarks, Multiple Listing Service® and the associated logos are owned by CREA and identify the quality of services provided by real estate professionals who are members of CREA. Used under license.
        </div> <div class="paragraph">
            OJO Home is committed to ensuring accessibility for individuals with disabilities. We are continuously working to improve the accessibility of our web experience for everyone. We welcome feedback and accommodation requests, please submit them  <a class="link">here</a></div></div></div></div> <!----></div>

				</footer><!-- #colophon -->

			</div><!-- col -->

		</div><!-- .row -->

	</div><!-- .container(-fluid) -->

</div><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

