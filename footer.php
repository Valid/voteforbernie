<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

  <div id="inner-footer" class="wrap cf">

    <p class="paid-for">Paid for by GloboCorp Pac</p>
    <p class="jk">(Just kidding, I made this for free!)</p>

    <nav role="navigation">
      <?php wp_nav_menu(array(
        'container' => false,
        'container_class' => 'footer-links cf',
        'menu_class' => 'footer-nav cf',
        'theme_location' => 'footer',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'depth' => 0
      )); ?>
    </nav>



    <p class="disclaimer">VoteForBernie.org was built and is maintained by a volunteer and is not affiliated with the <a href="https://berniesanders.com/" target="_blank" data-track="out,OfficialCampaign">official Bernie Sanders campaign</a>.</p>    <p class="disclaimer">The dates and information displayed on VoteForBernie.org are subject to change at any time. Though we strive to ensure the information is accurate, we make no guarantee that it is. If you notice something incorrect, <a href="/contact">let us know</a>.</p>

    <p class="source-org copyright">&copy; VoteForBernie.org</p>
    <?php // echo date('Y'); ?>
    <iframe src="http://www.bernrate.com/active" width="0" height="0" style="display:none;"></iframe>

  </div>

</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>
