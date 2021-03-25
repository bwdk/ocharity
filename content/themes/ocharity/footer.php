</main>
<footer class="footer">

  <div class="footer__topfooter">

      <div class="flex-item flex-item-1">
        <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/public/images/ocharity-logo.png" height="50%" width="50%" alt="logo"></a>
      </div>

      <div class="flex-item flex-item-2">
        <?php if (get_theme_mod('ocharity_footer_address')) : ?>
          <p class="address"><?php echo nl2br(get_theme_mod('ocharity_footer_address')); ?></p>
        <?php endif; ?>
      </div>

      <div class="flex-item flex-item-3">

        <ul>

          <?php if (get_theme_mod('ocharity_footer_num')) : ?>
            <li>
              <a href="<?php echo get_theme_mod('ocharity_footer_num'); ?>">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span> &nbsp; <?php echo get_theme_mod('ocharity_footer_num'); ?></span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (get_theme_mod('ocharity_footer_email')) : ?>
            <li>
              <a href="mailto:<?php echo get_theme_mod('ocharity_footer_email'); ?>">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span> &nbsp; <?php echo get_theme_mod('ocharity_footer_email'); ?></span>
              </a>
            </li>
          <?php endif; ?>

        </ul>

      </div>

      <div class="flex-item flex-item-4">
        <?php
          wp_nav_menu([
            'theme_location' => 'footer-menu',
            'container' => 'div',
            'container_class' => 'footer__topfooter-summary',
            'items_wrap' => '<ul class="footer__list">%3$s</ul>'
          ]);
        ?>
      </div>

  </div>

  <div class="footer__subfooter">

    <ul>
      <li>2020 - O'Charity</li>
    </ul>

    <div class="footer__subfooter-right">
      <ul>
        <li>
          <a href="#">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-instagram" aria-hidden="true"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-youtube" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</footer>

</div>

<?php wp_footer(); ?>
</body>

</html>