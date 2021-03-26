<?php

namespace DonateNamespace;

class Donator
{

    public function __construct()
    {
        add_action('init', [$this, 'register_ct']);
    }

    public function register_ct()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $tableNamePosts = $wpdb->prefix . "posts";
        $tableNameUsers = $wpdb->prefix . "users";
        $tableName = $wpdb->prefix . "donator";
        $sql = "
            CREATE TABLE IF NOT EXISTS $tableName (
            ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            firstname varchar(255) NOT NULL,
            lastname varchar(255) NOT NULL,
            amount int(11) NOT NULL,
            collecte_id bigint(20) UNSIGNED,
            donor_id bigint(20) UNSIGNED,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY  (collecte_id) REFERENCES $tableNamePosts(ID),
            FOREIGN KEY  (donor_id) REFERENCES $tableNameUsers(ID),
            KEY donor (ID) USING BTREE,
            PRIMARY KEY  (ID)
            ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        //dbDelta($sql);

        $wpdb->query($sql);

        //  update_option("version", $version);
        //    }
    }

    /**
     * Activate plugin
     * @return void
     */
    public function donator_activate()
    {
        $this->register_ct();
        flush_rewrite_rules();
    }
    /**
     * Deactivate plugin
     * @return void
     */
    public function donator_deactivate()
    {
        flush_rewrite_rules();
    }
}
