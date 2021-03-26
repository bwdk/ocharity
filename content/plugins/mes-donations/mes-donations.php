<?php
/*
Plugin Name: Mes Donations
Description: Plugin qui récupère la liste des donations avec leurs montant et les noms des donateurs
Author: oCharity
Version: 1.0.0
*/

// Sécurisation du plugin
if (!defined('WPINC')) {
    die();
}
add_action('admin_menu', 'donation_plugin_setup_menu');

function donation_plugin_setup_menu()
{
    add_menu_page('Liste des donations', 'Donations', 'manage_options', 'donations_list', 'donations_init', 'dashicons-share-alt', 6);
}

function donations_init()
{

    global $wpdb;
    // Table wp_donator
    $donation_amt_table = $wpdb->prefix . 'donator';
    // Table wp_posts
    $posts_table = $wpdb->prefix . 'posts';
    // Table wp_users
    $users_table = $wpdb->prefix . 'users';
    // Variable globale - The post object for the current post.
    global $post;
    // ID du custom post type en cours

    // Récupère les données de la table wp_donator
    $get_donation_list = $wpdb->get_results("SELECT * 
        FROM $donation_amt_table 
        ORDER BY id DESC");

    // Calcule le montant récolté aujourd'hui
    $currentDay = $wpdb->get_var("SELECT SUM(amount)
        FROM $donation_amt_table
        WHERE DATE (created_at) =DATE(NOW())");

    // Calcule le montant récolté les 7 derniers jours
    $lastWeek = $wpdb->get_var("SELECT SUM(amount)
        FROM $donation_amt_table
        WHERE DATE (created_at) >= now() - interval 7 day");

    // Calcule le montant récolté les 30 derniers jours
    $lastMonth = $wpdb->get_var("SELECT SUM(amount)
        FROM $donation_amt_table
        WHERE DATE (created_at) >= now() - interval 30 day");

    // Calcule le montant all time
    $allTime = $wpdb->get_var("SELECT SUM(amount)
        FROM $donation_amt_table");

    // Notation française
    $sumOverCurrentDay = number_format($currentDay, 2, ',', ' ');
    $sumOverLastWeek = number_format($lastWeek, 2, ',', ' ');
    $sumOverLastMonth = number_format($lastMonth, 2, ',', ' ');
    $sumAllTime = number_format($allTime, 2, ',', ' ');
?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo plugin_dir_url(__FILE__); ?>tablesorter/js/popper.min.js"></script>
    <script src="<?php echo plugin_dir_url(__FILE__); ?>tablesorter/js/jquery-latest.min.js"></script>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>/tablesorter/css/bootstrap-v4.min.css">
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>/tablesorter/css/theme.bootstrap_4.css">
    <script src="<?php echo plugin_dir_url(__FILE__); ?>tablesorter/js/jquery.tablesorter.js"></script>
    <script src="<?php echo plugin_dir_url(__FILE__); ?>tablesorter/js/jquery.tablesorter.widgets.js"></script>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>tablesorter/addons/pager/jquery.tablesorter.pager.css">
    <script src="<?php echo plugin_dir_url(__FILE__); ?>tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>assets/css/style.css">
    <script src="<?php echo plugin_dir_url(__FILE__); ?>assets/js/script.js"></script>

    <div class="wrapper">

        <h2>Liste des donations</h2>
        <!--Dropdown button pour afficher le montant récolté aujourd'hui, les 7 derniers jours ou les 30 derniers jours-->
        <div class="d-flex justify-content-start">

            <div class="dropdown">

                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Promesses de dons collectés
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" id="day" href="">Aujourd'hui</a>
                    <a class="dropdown-item" id="week" href="">Les 7 derniers jours</a>
                    <a class="dropdown-item" id="month" href="">Les 30 derniers jours</a>
                    <a class="dropdown-item" id="allt" href="">Total</a>
                </div>

            </div>
            <!--Affichage du montant-->
            <div class="display">
                <!--Aujourd'hui-->
                <div class="displayDay">
                    <?php if ($sumOverCurrentDay === null) {
                        echo 0;
                    } else {
                        echo "Aujourd'hui : " . esc_attr($sumOverCurrentDay) . "&euro;";
                    }
                    ?>
                </div>
                <!--Les 7 derniers jours-->
                <div class="displayWeek">
                    <?php echo "7 jours :<br> " . esc_attr($sumOverLastWeek) . "&euro;"; ?>
                </div>
                <!--Les 30 derniers jours-->
                <div class="displayMonth">
                    <?php echo "30 jours :<br> " . esc_attr($sumOverLastMonth) . "&euro;"; ?>
                </div>
                <!--Les 30 derniers jours-->
                <div class="displayAll">
                    <?php
                    echo "Total : " . esc_attr($sumAllTime) . "&euro;";
                    ?>
                </div>

            </div>
        </div>

        <script type="text/javascript">
            $('#week').click(function() {
                $('.displayDay').hide();
                $('.displayWeek').show();
                $('.displayMonth').hide();
                $('.displayAll').hide();
                // return false;
                event.preventDefault();
            })
            $('#day').click(function() {
                $('.displayDay').show();
                $('.displayWeek').hide();
                $('.displayMonth').hide();
                $('.displayAll').hide();
                // return false;
                event.preventDefault();
            })
            $('#month').click(function() {
                $('.displayDay').hide();
                $('.displayWeek').hide();
                $('.displayMonth').show();
                $('.displayAll').hide();
                event.preventDefault();
                // return false;
            })
            $('#allt').click(function() {
                $('.displayDay').hide();
                $('.displayWeek').hide();
                $('.displayMonth').hide();
                $('.displayAll').show();
                event.preventDefault();
                //return false;
            })
        </script>

        <!--Bouton réinitialisation des filtres du tableau-->
        <div class="d-flex flex-row-reverse">
            <div class="bootstrap_buttons d-flex flex-row-reverse">
                <button type="button" class="reset btn btn-info" data-column="0" data-filter="">Réinitialiser les filtres</button>
            </div>
        </div>
        <br>

        <!--Entête du tableau-->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Date du don</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Nom de la collecte</th>
                    <th>Montant du don (€)</th>
                </tr>
            </thead>
            <tbody>
                <!--Boucle sur la liste des donations se trouvant dans la table wp_donator, récupération en SQL des infos que l'on veut afficher dans le tableau-->
                <?php foreach ($get_donation_list as $get_donation_member) { ?>
                    <tr>
                        <?php
                        // Récupère la date avec l'heure
                        $originalDate = $get_donation_member->created_at;
                        // Change la date au format européean + enlève l'heure
                        $displayDate = date("d-m-Y", strtotime($originalDate));
                        // Récupère le nom de la collecte via son ID (Table wp_posts)
                        $postName = get_the_title($get_donation_member->collecte_id);
                        // Récupère l'email du donateur via son ID (Table wp_users)
                        $EmailName = get_user_by('id', ($get_donation_member->donor_id));
                        $donatorId = $get_donation_member->ID;
                        ?>
                        <td><?php echo esc_attr($donatorId);  ?></td>
                        <td><?php echo esc_attr($displayDate); ?></td>
                        <td><?php echo esc_attr($get_donation_member->firstname); ?></td>
                        <td><?php echo esc_attr($get_donation_member->lastname); ?></td>
                        <td><?php echo esc_attr($EmailName->user_email);  ?></td>
                        <td><?php echo esc_attr($postName);  ?></td>
                        <td><?php echo esc_attr($get_donation_member->amount);  ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="ts-pager">
                        <!--Pagination du tableau-->
                        <div class="form-inline">
                            <div class="btn-group btn-group-sm mx-1" role="group">
                                <button type="button" class="btn btn-secondary first" title="first">&#8676;</button>
                                <button type="button" class="btn btn-secondary prev" title="previous">&larr;</button>
                            </div>
                            <span class="pagedisplay"></span>
                            <div class="btn-group btn-group-sm mx-1" role="group">
                                <button type="button" class="btn btn-secondary next" title="next">&rarr;</button>
                                <button type="button" class="btn btn-secondary last" title="last">&#8677;</button>
                            </div>
                            <!--Nombre de lignes par page-->
                            <select class="form-control-sm custom-select px-1 pagesize" title="Select page size">
                                <option selected="selected" value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="all">All Rows</option>
                            </select>
                            <select class="form-control-sm custom-select px-4 mx-1 pagenum" title="Select page number"></select>
                        </div>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
<?php
}
