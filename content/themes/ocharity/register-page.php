<?php

/**
 * Template name: Page d'inscription
 */
get_header();
global $wp_roles, $errormsg;


$errormsg = new WP_Error();

$method = $_REQUEST;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $password = $method['password'];
  $username = $method['username'];
  $email = $method['email'];


  $username = esc_sql($method['username']);
  if (strpos($username, ' ') !== false) {
    $errormsg->add('username', 'Attention il y a des espaces dans le nom d\'utilisateur');
  }
  if (empty($name)) {
    $errormsg->add('username', 'Veuillez renseigner un nom d\'utilisateur');
  } elseif (username_exists($name)) {
    $errormsg->add('username', 'Le nom d\'utilisateur existe déja');
  }

  $email = esc_sql($_REQUEST['email']);
  if (!is_email($email)) {
    $errormsg->add('email', 'Renseigner un email valide');
  } elseif (email_exists($email)) {
    $errormsg->add('email', 'Cet email existe déja');
  }

  $password = esc_sql($_REQUEST['password']);
  if (empty($password)) {
    $errormsg->add('password', 'Mot de passe obligatoire');
  }

  if (isset($method['password'])) {
    if ($errormsg->get_error_message()) {
      echo $errormsg->get_error_message();
    } else {


      $userId = wp_insert_user(
        [
          'user_login'  => $username,
          'user_pass' => $password,
          'user_email'  => $email,
          'role' => 'donator'
        ]
      );



      $url_redirect = home_url();

      echo "<script>location.href = '$url_redirect';</script>";
      exit;
    }
  }
}
?>

<?php if (!is_user_logged_in()) : ?>

  <div class="title">
    <h1 class="h1">Inscription</h1>
  </div>

  <main class="main">
    <!-- Formulaire de connexion -->
    <section class="section__tpl">
      <div class="section__tpl__block__login-page">
        <form id="register_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
          <div class="field">
            <label for="username">Nom d'utilisateur*:</label>
            <input type="text" name="username" id="username">
          </div>
          <div class="field">
            <label for="email">Votre Adresse email*:</label>
            <input type="text" name="email" id="email">
          </div>
          <div class="field">
            <label for="password">Mot de passe*:</label>
            <input type="password" name="password" id="password">
          </div>
          <div>
            <input type="submit" class="action-button" id="submit" name="submit" value="S'inscrire" />
          </div>
        </form>
      </div>
    </section>

  </main>

<?php elseif (is_user_logged_in()) : ?>
<?php


  $url_redirect = home_url();
  echo "<script>location.href = '$url_redirect';</script>";
  exit;


endif; ?>

<?php get_footer(); ?>