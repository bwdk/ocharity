<?php

/**
 * Template name: Receipt
 */

get_header();
?>



<?php
global $wpdb;
global $post;

$donation_amt_table = $wpdb->prefix . 'donator'; // table wp_donator
$posts_table = $wpdb->prefix . 'posts'; // table wp_posts
$users_table = $wpdb->prefix . 'users'; // table wp_users
$user_id = get_current_user_id();


// Get datas from wp_donator
$get_donation_list = $wpdb->get_results("
SELECT firstname, lastname, amount, collecte_id, created_at
FROM $donation_amt_table
WHERE donor_id = $user_id
ORDER BY DATE(created_at) DESC
LIMIT 1");

?>
<!-- Init and Manage translation for Datatable -->
<script>
    $(document).ready(function() {
        $('#table_id').DataTable(({
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
                "sEmptyTable": "Il n'ya aucune entrée",
                "sZeroRecords": "Pas de données à afficher"
            }
        }));
    });
</script>

<?php

// If user logged in and url param equal 'donate_validated' 
// then return user receipt else redirect to home page
$taxo = get_query_var('statut');

if (is_user_logged_in() && has_term('donate_validated', 'statut')) : ?>

    <main class="main">

        <div class="section__container">
            <h2>Votre reçu</h2>
            <div class="section__container__success">
                <p>Merci ! Nous avons bien reçu votre don</p>
            </div>

            <table class="table receipt__table">
                <?php foreach ($get_donation_list as $get_donation_member) :
                    $originalDate = $get_donation_member->created_at;
                    $displayDate = date("d-m-Y", strtotime($originalDate));
                    $postName = get_the_title($get_donation_member->collecte_id);

                ?>
                    <thead class="receipt__table__head">
                        <th>
                        <td>Reçu donation</td>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Nom de la collecte</th>
                            <td><?php echo esc_attr($postName); ?></td>
                        </tr>
                        <tr>
                            <th>Date du don</th>
                            <td><?php echo esc_attr($displayDate); ?></td>
                        </tr>
                        <tr>
                            <th>Montant</th>
                            <td><?php echo esc_attr($get_donation_member->amount); ?>€</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
    </main>

<?php else : ?>

    <!-- $url_redirect = rtrim(get_site_url(), '/wp');
    echo "<script>location.href = '$url_redirect';</script>";
    exit; -->

    <main class="main">

<div class="section__container">
    <h2>Votre reçu</h2>
    <div class="section__container__success">
        <p>Merci ! Nous avons bien reçu votre don</p>
    </div>


    <table class="table receipt__table">
        <?php foreach ($get_donation_list as $get_donation_member) :
            $originalDate = $get_donation_member->created_at;
            $displayDate = date("d-m-Y", strtotime($originalDate));
            $postName = get_the_title($get_donation_member->collecte_id);

            dump($originalDate);
        ?>
            <thead class="receipt__table__head">
                <th>
                <td>Reçu donation</td>
                </th>
            </thead>
            <tbody>
                <tr>
                    <th>Nom de la collecte</th>
                    <td><?php echo esc_attr($postName); ?></td>
                </tr>
                <tr>
                    <th>Date du don</th>
                    <td><?php echo esc_attr($displayDate); ?></td>
                </tr>
                <tr>
                    <th>Montant</th>
                    <td><?php echo esc_attr($get_donation_member->amount); ?>€</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
</div>
</main>

    <?php
endif;
?>


<?php
get_footer();
