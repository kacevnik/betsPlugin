<?php
/**
 * Created by PhpStorm.
 * Date:        23.08.2018
 * Time:        13:49
 * Plugin Name: BetsPlugin
 * Author URI:  http://github.com/kacevnik
 * Author:      Dvitriy Kovalev
 * Version:     1.0
 *
 */

global $wp_version;
$min_version_wp = '4.7';

if(version_compare($wp_version, $min_version_wp, '<')){
    function com_version_wp($var){
        if($var){
            ?>
            <div class="notice notice-error">
                <p>Внимание минимальная версия Wordpress для плагина BetsPlugin - <b><?=$var?></b>! Обновите WordPress!</p>
            </div>
            <?php
        }
    }
    add_action('admin_notices', 'com_version_wp');
    do_action('admin_notices', $min_version_wp);
}else{
    add_action('init', 'create_taxonomy_type_bets');
    function create_taxonomy_type_bets(){
        register_taxonomy('type_bets', array('post_bets'), array(
            'label'                 => 'type bet',
            'labels'                => array(
                'name' => _x( 'Типы Ставок', 'types bets' ),
                'singular_name' => _x( 'Тип Ставки', 'type bet' ),
                'search_items' =>  __( 'Искать тип ставки', 'Serch type bet' ),
                'all_items' => __( 'Все типы ставок', 'All types bet' ),
                'parent_item' => __( 'Родительский тип ставки', 'Parent type bet' ),
                'parent_item_colon' => __( 'Родительский тип ставки:', 'Parent type bet:' ),
                'edit_item' => __( 'Редактировать тип ставки', 'Edit type bet' ),
                'update_item' => __( 'Обновить тип ставки', 'Update type bet' ),
                'add_new_item' => __( 'Добавить тип ставки', 'Add type bet' ),
                'new_item_name' => __( 'Новый тип ставки', 'New type bet' ),
                'menu_name' => __( 'Типы ставок', 'Types bets' ),
            ),
            'description'           => '',
            'public'                => true,
            'publicly_queryable'    => null,
            'show_in_nav_menus'     => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_tagcloud'         => true,
            'show_in_rest'          => null,
            'rest_base'             => null,
            'hierarchical'          => true,
            'update_count_callback' => '',
            'rewrite'               => true,
            'capabilities'          => array(),
            'meta_box_cb'           => null,
            'show_admin_column'     => false,
            '_builtin'              => false,
            'show_in_quick_edit'    => null
        ) );
    }

    add_action('init', 'create_taxonomy_status_bets');
    function create_taxonomy_status_bets(){
        register_taxonomy('status_bets', array('post_bets'), array(
            'label'                 => 'status bet',
            'labels'                => array(
                'name' => _x( 'Статусы ставок', 'status bets' ),
                'singular_name' => _x( 'Статус ставки', 'single status bet' ),
                'search_items' =>  __( 'Искать статус ставки', 'serch status bet' ),
                'all_items' => __( 'Все статусы ставок', 'All status bet' ),
                'parent_item' => __( 'Родительский статус ставки', 'Parent status bet' ),
                'parent_item_colon' => __( 'Родительский статус ставки:' ),
                'edit_item' => __( 'Редактировать статус ставки', 'Edit status bet' ),
                'update_item' => __( 'Обновить статус ставки' , 'Update status bet'),
                'add_new_item' => __( 'Добавить статус ставки', 'Add status bet' ),
                'new_item_name' => __( 'Новый статус ставки', 'New status bet' ),
                'menu_name' => __( 'Статусы ставок', 'Status bets' ),
            ),
            'description'           => '',
            'public'                => true,
            'publicly_queryable'    => null,
            'show_in_nav_menus'     => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_tagcloud'         => true,
            'show_in_rest'          => null,
            'rest_base'             => null,
            'hierarchical'          => true,
            'update_count_callback' => '',
            'rewrite'               => true,
            'capabilities'          => array(),
            'meta_box_cb'           => null,
            'show_admin_column'     => false,
            '_builtin'              => false,
            'show_in_quick_edit'    => null
        ) );
    }



    add_action( 'init', 'register_post_bets' );
    function register_post_bets(){
        register_post_type('bets', array(
            'label'  => 'post_bets',
            'labels' => array(
                'name'               => _x( 'Ставки', 'bets' ),
                'singular_name'      => _x( 'Ставка', 'bet' ),
                'add_new'            => _x( 'Добавить ставку', 'Add bet' ),
                'add_new_item'       => _x( 'Добавление ставки', 'Adding bet' ),
                'edit_item'          => _x( 'Редактирование ставки', 'Update bet' ),
                'new_item'           => _x( 'Новая ставка', 'New bet' ),
                'view_item'          => _x( 'Смотреть ставку', 'View bet' ),
                'search_items'       => _x( 'Искать ставку', 'Serch bet' ),
                'not_found'          => _x( 'Не найдено ставок', 'Not found bet' ),
                'not_found_in_trash' => _x( 'Не найдено в корзине ставок', 'Not found bet on archive' ),
                'parent_item_colon'  => '',
                'menu_name'          => _x( 'Ставки', 'Bets' ),
            ),
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => null,
            'exclude_from_search' => null,
            'show_ui'             => null,
            'show_in_menu'        => null,
            'show_in_admin_bar'   => null,
            'show_in_nav_menus'   => null,
            'show_in_rest'        => null,
            'rest_base'           => null,
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-carrot',
            'hierarchical'        => false,
            'supports'            => array('title','editor'),
            'taxonomies'          => array('type_bets', 'status_bets'),
            'has_archive'         => false,
            'rewrite'             => true,
            'query_var'           => true,
        ) );
    }

    add_action('init', 'add_custom_term');

    function add_custom_term(){
        global $wpdb;
        $custom_array_terms = ['0' => array('name' => 'ординар', 'slug'  => 'ordinar', 'taxonomy'   => 'type_bets'),
            '1' => array('name' => 'экспресс', 'slug' => 'exspress', 'taxonomy'  => 'type_bets'),
            '2' => array('name' => 'выигрыш', 'slug'  => 'win_bet', 'taxonomy'   => 'status_bets'),
            '3' => array('name' => 'проигрыш', 'slug' => 'lose_bet', 'taxonomy'  => 'status_bets'),
            '4' => array('name' => 'возврат', 'slug'  => 'back_bet', 'taxonomy'  => 'status_bets'),
            '5' => array('name' => 'активная', 'slug' => 'activ_bet', 'taxonomy' => 'status_bets')
        ];
        foreach ($custom_array_terms as $custom_array_terms_item){
            $terms = term_exists($custom_array_terms_item['slug'], $custom_array_terms_item['taxonomy']);

            if(!count($terms)){
                $insert_term = wp_insert_term($custom_array_terms_item['name'], $custom_array_terms_item['taxonomy'],
                    array(
                        'description' => '',
                        'slug'        => $custom_array_terms_item['slug']
                    )
                );
            }
        }
    }

    register_activation_hook(__FILE__, 'add_custom_rolls');

    function add_custom_rolls(){
        $add_capper = add_role( 'capper', 'Каппер',
            array(
                'read'         => true,
                'publish_posts' => true,
                'edit_posts' => true
            )
        );

        $add_moderator = add_role( 'moderator', 'Модератор',
            array(
                'read'         => true,
                'edit_others_posts' =>true,
                'publish_posts' => true,
                'edit_posts' => true,
                'edit_private_posts' => true
            )
        );

    }

    register_deactivation_hook( __FILE__, 'remove_roll' );
    function remove_roll(){
        remove_role( 'capper' );
        remove_role( 'moderator' );
    }
}
