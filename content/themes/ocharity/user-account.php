<?php

/**
 * Template name: User account
 */

get_header();
?>


<?php
global $wpdb;
global $post;
global $current_user;

$donation_amt_table = $wpdb->prefix . 'donator';     // table wp_donator
$posts_table = $wpdb->prefix . 'posts'; // table wp_posts
$users_table = $wpdb->prefix . 'users'; // table wp_users
$user_id = get_current_user_id();

// ID du custom post type en cours
$page_id = $post->ID;
//Récupère les données de la table wp_donator
$get_donation_list = $wpdb->get_results("
SELECT firstname, lastname, amount, collecte_id, created_at
FROM $donation_amt_table
WHERE donor_id = $user_id
ORDER BY created_at DESC");
//$get_user_list = $wpdb->get_results("SELECT * FROM $users_table");
$get_user_list = $wpdb->get_results("SELECT user_email FROM $users_table WHERE ID = user_email");

?>
<script>
    $(document).ready(function() {
        $('#table_id').DataTable(({
            "order": [ 0, 'desc' ],
            "oLanguage": {
                "sSearch": "Recherche:",
                "oPaginate": {
                    "sPrevious": "Page précédente",
                    "sNext": "Page suivante",
                    "sLast": "Dernière page"
                },
                "sInfo": "",
                "sInfoEmpty": "",
                "sLengthMenu": "",
                "sInfoFiltered": "",
                "sEmptyTable": "Il n' ya aucune entrée",
                "sZeroRecords": "Pas de données à afficher"
            }
        }));
    });
</script>

<?php if (is_user_logged_in()) : ?>
    <main class="main">
        <div class="section__container">
            <h1>Bonjour <?= $current_user->user_nicename ?> - Liste de vos dons</h1>

            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>Date du don</th>
                        <th>Nom de la collecte</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($get_donation_list as $get_donation_member) :
                        $originalDate = $get_donation_member->created_at;
                        $displayDate = date("d-m-Y", strtotime($originalDate));
                        $postName = get_the_title($get_donation_member->collecte_id);

                    ?>
                        <tr>
                            <td><?php echo esc_attr($displayDate); ?></td>
                            <td><?php echo esc_attr($postName); ?></td>
                            <td><?php echo esc_attr($get_donation_member->amount); ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
<?php else :

    $url_redirect = rtrim(get_site_url(), '/wp');
    echo "<script>location.href = '$url_redirect';</script>";
    exit;

endif;
?>

<?php
get_footer();
