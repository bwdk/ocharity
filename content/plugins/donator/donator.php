<?php
/*
Plugin Name: Donator
Description: Table custom donator
Author: oCharity
Version: 1.0
*/
namespace DonateNamespace;


if (!defined('WPINC')) {
    die;
}

	
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// Inclusion des classes
require MY_PLUGIN_PATH . 'inc/Donator.php';
//require plugin_dir_path(__FILE__) . 'inc/adddonation.php';



// Création table custom
$donator = new Donator();

register_activation_hook(__FILE__, [$donator, 'donator_activate']);
register_deactivation_hook(__FILE__, [$donator, 'donator_deactivate']);


// Enregistrement Don
// $addCollecte = new Add_Donation();

// register_activation_hook(__FILE__, [$addCollecte, 'activation']);
// register_deactivation_hook(__FILE__, [$addCollecte, 'deactivation']);

