<?php
global $CHfw_rdx_options;
$copyrights = isset($CHfw_rdx_options['copyrights']) ? $CHfw_rdx_options['copyrights'] : '';
$trackingCode = isset($CHfw_rdx_options['trackingCode']) ? $CHfw_rdx_options['trackingCode'] : '';
$my_custom_css = isset($CHfw_rdx_options['my_custom_css']) && !empty($CHfw_rdx_options['my_custom_css']) ? '<style>' . $CHfw_rdx_options['my_custom_css'] . '</style>' : '';
?>
<footer id="footer" class="footer-container ch_fwgrid ">
    <div class="footer-center">
        <div class="container">
            <div class="row-fluid">
                <div class="footer-static  grid-sc-xs-1 grid-sc-sm-1 grid-sc-m-2 grid-sc-l-4">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-footer">
        <div class="container">
            <div class="footer-static row-fluid">
                <?php echo $copyrights ?>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="scrollToTop"><i class="fa fa-chevron-up"></i></a>
<div id="tempdom" ></div>
<?php wp_footer(); ?>
<?php echo $trackingCode; ?>
<?php echo $my_custom_css; ?>
</div><!--end wrapper -->
</body>
</html>