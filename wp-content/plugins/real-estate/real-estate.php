<?php
/**
 * Plugin Name: Real Estate
 * Description: Описание плагина желательно не очень длинное (140 символов)
 * Plugin URI:  Ссылка на страницу плагина
 * Author URI:  Ссылка на автора
 * Author:      Имя автора
 * Version:     Версия плагина, например 1.0
 *
 * Text Domain: ID перевода, указывается в load_plugin_textdomain()
 * Domain Path: Путь до файла перевода.
 * Requires at least: 2.5
 * Requires PHP: 5.4
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Network:     Укажите "true" для возможности активировать плагин для сети Multisite.
 * Update URI: https://example.com/link_to_update
 */
require_once __DIR__.'/functions/cpt.php';
require_once __DIR__.'/functions/queries.php';
require_once __DIR__.'/functions/handlers.php';
//require_once plugin_dir_path(__FILE__).'classes/FilterWidget.php';
function realEstateActivation() {
	add_option( 'real_estate_activated', true ); // Устанавливаем опцию, указывающую, что плагин активирован
	add_option( 'real_estate_pattern_status', false ); // Устанавливаем опцию, указывающую, что плагин активирован
	add_option( 'real_estate_dev_version',  1); // Устанавливаем опцию, указывающую, что плагин активирован
	flush_rewrite_rules();
}
if(get_option('real_estate_pattern_status') === true){
	//Тыкаем тему носом в местоположение шаблона
	add_filter( 'template_include', function ($template){
		global $post;
		if(($post->post_type == "estates" AND is_single())){
			return RealEstate::getPluginDir().'templates/estate.php';
		}
		return $template;
	} );
//Добавляем свой шаблон для вывода записей!!!! нашего типа
	add_filter('theme_page_templates', function ($post_templates, $theme, $post, $post_type){
		$post_templates['estates.php'] = 'Estates';
		return $post_templates;
	}, 10, 4);
//Тыкаем тему носом в местоположение шаблона для страницы
	add_filter( 'template_include', function ($template){
		global $post;
		if(($post->post_type == "estates" AND is_archive())){
			return RealEstate::getPluginDir().'templates/estates.php';
		}
		return $template;
	} );
}
function realEstateSetup() {
	add_action( 'init', ['RealEstate', 'init'] );
	add_theme_support( 'widgets' ); // Включаем поддержку виджетов в теме
	require_once plugin_dir_path( __FILE__ ) . 'classes/FilterWidget.php';
	register_widget( 'FilterWidget' ); // Регистрируем виджет
}
add_action( 'after_setup_theme', 'realEstateSetup' );
register_activation_hook( __FILE__, 'realEstateActivation' );

function realEstateDeactivation(){

}
register_deactivation_hook( __FILE__, 'realEstateDeactivation' );

function realEstateUninstall(){
	//delete_option('my_option');
}
register_uninstall_hook( __FILE__, 'realEstateUninstall' );

class RealEstate {
	static function init(){
		add_shortcode( 're-estates',  function (){
			return getEstates();
		});

// результат:
// шоткод [footag foo="bar"] в тексте будет заменен на "foo = bar"
	}
	static function getPluginDir(){
		return plugin_dir_path(__FILE__);
	}
}