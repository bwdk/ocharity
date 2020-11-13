<?php


global $errormsg;
global $current_user;

$errormsg = new WP_Error();

$method = $_REQUEST;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  // If user is logged in
  if (is_user_logged_in()) {

    $lastname = $method['lastname'];
    $firstname = $method['firstname'];
    $amount = $method['amount'];


    if (empty($amount)) {
      $errormsg->add('amount', '<div class="message__fail">Le champ montant est obligatoire</div>');
    }
  }


  // If "amount" is sended, then post the form and redirect to validation page
  if (isset($method['amount'])) {
    if ($errormsg->get_error_message()) {
      echo $errormsg->get_error_message();
    } else {
      global $wpdb;
      global $post;

      $page_id = $post->ID;
      $user_id = get_current_user_id();

      $firstname = sanitize_text_field($_POST['firstname']);
      $lastname = sanitize_text_field($_POST['lastname']);
      $amount = sanitize_text_field($_POST['amount']);

      $table_name = $wpdb->prefix . "donator";
      $donator_data = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'amount' => $amount,
        'collecte_id' => $page_id,
        'donor_id' => $user_id,

      ];

      $insert = $wpdb->insert($table_name, $donator_data);

      $urlParam = 'donate_validated';
      $url_redirect = esc_url(add_query_arg('statut',  $urlParam, get_permalink()));
      echo "<script>location.href = '$url_redirect';</script>";
      exit;
    }
  }
}



$statut = get_query_var('statut');
$page_state = get_query_var('page_state');

$args = [
  'statut' => $statut,
  'page_state' => $page_state,
];
$queryDonate = new WP_Query($args);

if (($queryDonate->query_vars['statut']) !== '') : ?>
  <div class="section__container__success">
    <p>Merci ! Nous avons bien reçu votre promesse de don</p>
  </div>
<?php
elseif (($queryDonate->query_vars['page_state']) == 'welcome') : ?>
  <div class="message__welcome">
      <p>Bienvenue <?= $current_user->user_nicename ?> ! Effectuez votre promesse de don</p>
  </div>
<?php
endif; ?>


<p class="raising__form__text">Renseignez vos informations</p>

<form action="" class="raising__form" method="post">
  <div class="field">
    <label for="lastname">Nom</label>
    <input type="text" placeholder="" name="lastname">
  </div>
  <div class="field">
    <label for="firstname">Prénom</label>
    <input type="text" placeholder="" name="firstname">
  </div>

  <div class="field">
    <label for="amount">Don Libre (€)</label>
    <input type="text" placeholder="" name="amount">
  </div>
  <button type="submit" class="action-button">Envoyer
  </button>
</form>