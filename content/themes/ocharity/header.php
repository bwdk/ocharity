<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?php bloginfo('name'); ?> </title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="shortcut icon" href="../images/favicon-ocharity.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <?php
  wp_head();
  ?>
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <nav class="header__topbar">
        <div class="header__topbar-left">
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
        <div class="header__topbar-right">



          <div class="search">
            <form role="search" action="<?php echo home_url('/'); ?>" class="search__form" method="get" id="searchform">
              <label for="" class="search__form__label">
                <i class="fa fa-search" aria-hidden="true"></i>
              </label>
              <input type="text" name="s" class="search__form__field" placeholder="Rechercher">
              <input type="hidden" name="post_type" value="" />
            </form>
          </div>
          <p class="login">
            <?php if (is_user_logged_in()) {
              global $current_user;
              echo '<a href="' . home_url() . '/projet-ocharity/user-account/"> Hello ' . $current_user->user_nicename . ' </a> | ';
              include('logout.php');
            } else { ?>
              <a href="<?= home_url() ?>/connexion">Se connecter | </a>
              <a href="<?= home_url() ?>/inscription">S'inscrire</a>
            <?php } ?>
          </p>
        </div>

      </nav>

      <nav class="top__menu">
        <a class="header__subbar-logo" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/public/images/logo-ocharity.png" alt="logo"></a>
        <?php
        wp_nav_menu([
          'theme_location' => 'main-menu',
          'menu_class' => 'top__menu',
        ]);
        ?>
        <a class="cta action-button" href="<?php echo get_permalink(get_page_by_path('actions-en-cours')); ?>">Faire un don</a>
        <p class="menu action-button cta">Menu</p>
      </nav>

    </header>
    <div class="overlay">
      <a class="close">&times;</a>
      <div class="overlay__content">
        <?php if (is_user_logged_in()) {
          global $current_user;
          echo '<a href="' . home_url() . '/projet-ocharity/user-account/"> Hello ' . $current_user->user_nicename . ' </a> ';
        } else { ?>
          <a href="<?= home_url() ?>/connexion">Se connecter</a>
          <a href="<?= home_url() ?>/inscription">S'inscrire</a>
        <?php } ?>
        <?php
        wp_nav_menu([
          'theme_location' => 'menu-mobile',
          'menu_class' => 'top__menu',
        ]);
        ?>
      </div>
    </div>
    <main class="main">