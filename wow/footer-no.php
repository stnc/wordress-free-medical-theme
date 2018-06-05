<?php
global $CHfw_rdx_options;

$copyrights    = isset( $CHfw_rdx_options['copyrights'] ) ? $CHfw_rdx_options['copyrights'] : '';
$trackingCode  = isset( $CHfw_rdx_options['trackingCode'] ) ? $CHfw_rdx_options['trackingCode'] : '';
$my_custom_css= isset( $CHfw_rdx_options['my_custom_css'] ) && !empty( $CHfw_rdx_options['my_custom_css'] ) ? '<style>'.$CHfw_rdx_options['my_custom_css']. '</style>' : '';
?>
<footer class="footer-container ch_fwgrid ">
	<div class="copyright-footer">
	      <div class="container">
		     <div class="row-fluid">
	         <div class="footer-static ">
            <?php echo $copyrights ?>
	         </div>
	   </div>
		</div>
	</div>
</footer>
<a href="#" class="scrollToTop" style="display: block;"><i class="fa fa-chevron-up"></i></a>
<div id="tempdom" style="display: none"></div>
<?php wp_footer(); ?>
<?php echo $trackingCode; ?>
<?php echo $my_custom_css; ?>
</div><!--end wrapper -->
</body>
</html>
