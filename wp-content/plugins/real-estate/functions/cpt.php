<?php
// Регистрация нового типа записи
function registerPostType() {
	$labels = [
		'name'               => 'Объекты недвижимости',
		'singular_name'      => 'Объект недвижимости',
		'add_new'            => 'Добавить новый',
		'add_new_item'       => 'Добавить новый объект недвижимости',
		'edit_item'          => 'Редактировать объект недвижимости',
		'new_item'           => 'Новый объект недвижимости',
		'all_items'          => 'Все объекты недвижимости',
		'view_item'          => 'Просмотр объекта недвижимости',
		'search_items'       => 'Искать объекты недвижимости',
		'not_found'          => 'Объекты недвижимости не найдены',
		'not_found_in_trash' => 'В корзине объекты недвижимости не найдены',
		'menu_name'          => 'Недвижимость'
	];
	register_post_type( 'estates', [
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => false,
		'publicly_queryable' => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor', 'custom-fields', 'page-attribute'),
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-admin-home',
		'show_in_rest' => true,
	] );
	//Добавляем свой шаблон в админку
	add_filter( 'theme_estates_templates', function ($post_templates, $theme, $post, $post_type){
		$post_templates['estate.php'] = 'Estate';
		return $post_templates;
	}, 10, 4 );
	flush_rewrite_rules();
}

add_action( 'init', 'registerPostType' );
//flush_rewrite_rules();

function registerTaxonomy() {
	$labels = [
		'name'                       => 'Районы',
		'singular_name'              => 'Район',
		'search_items'               => 'Искать районы',
		'popular_items'              => 'Популярные районы',
		'all_items'                  => 'Все районы',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Редактировать район',
		'update_item'                => 'Обновить район',
		'add_new_item'               => 'Добавить новый район',
		'new_item_name'              => 'Новое имя района',
		'separate_items_with_commas' => 'Разделяйте районы запятыми',
		'add_or_remove_items'        => 'Добавить или удалить районы',
		'choose_from_most_used'      => 'Выбрать из наиболее популярных районов',
		'not_found'                  => 'Районы не найдены',
		'menu_name'                  => 'Районы',
	];
	register_taxonomy( 'district', 'estates',[
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'district' ),
	]);
}
add_action( 'init', 'registerTaxonomy' );
//flush_rewrite_rules();
