
    </div><!-- /main body inner -->
    <!-- /wrapper -->
</div>
    
<!-- Footer -->
<footer id="footer" class="main-footer">
    <div class="inner">
        <p>&copy; <?php echo get_bloginfo( 'name' ); ?></p>
        <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'footer-menu',
                    'menu_class' => '',
                    'container' => 'nav',
                    'container_class' => 'footer-menu'
                )
            );
        ?>
    </div>
</footer>
<!-- /Footer -->
    
    <?php wp_footer(); ?>
    
</body>
</html>