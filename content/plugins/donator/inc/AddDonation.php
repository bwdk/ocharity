<?php

namespace DonateNamespace;

use WP_Error;

class Add_Donation
{

    public function __construct()
    {

        add_action('init', [$this, 'add_new_donation']);
    }

    public function add_new_donation()
    {

        global $errormsg;
        global $wpdb;
        global $post;

        $errormsg = new WP_Error();

        $method = $_REQUEST;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $lastname = $method['lastname'];
            $firstname = $method['firstname'];
            $amount = $method['amount'];


            if (is_user_logged_in()) {
                if (empty($amount)) {
                    $errormsg->add('amount', 'Le champ montant est obligatoire');
                }
            }

            if (!is_user_logged_in()) {

                $password = $method['password'];
                $email = $method['email'];

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
            }

            if (isset($method['amount'])) {
                if ($errormsg->get_error_message()) {
                    echo $errormsg->get_error_message();
                } else {


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
                        'donor_id' => $user_id
                    ];

                    $wpdb->insert($table_name, $donator_data);

                    get_template_part('/collecte-encours');
                }
            }
        }
    }



    public function activation()
    {
        $this->add_new_donation();

        flush_rewrite_rules();
    }

    public function deactivation()
    {
        flush_rewrite_rules();
    }
}
