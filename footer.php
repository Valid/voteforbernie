<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

  <div id="inner-footer" class="wrap cf">

    <p class="paid-for">Paid for by GloboCorp Pac</p>
    <p class="jk">(Just kidding, I made this for free!)</p>

    <nav role="navigation">
      <?php wp_nav_menu(array(
        'container' => false,
        'container_class' => 'footer-links cf',
        'menu_class' => 'nav footer-nav cf',
        'theme_location' => 'footer',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'depth' => 0
      )); ?>
    </nav>



    <p class="disclaimer">VoteForBernie.org was built and is maintained by a volunteer and is not affiliated with the <a href="#" data-track="out,OfficialCampaign">official Bernie Sanders campaign</a>.</p>

    <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></p>

  </div>

</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>
