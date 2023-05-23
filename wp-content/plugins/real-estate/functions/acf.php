<?php
include_once( ABSPATH . 'wp-content/plugins/advanced-custom-fields/acf.php' );
function registerAcfFields() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group( array(
			'key' => 're',
			'title' => 'Поля объекта недвижимости',
			'fields' => array(
				array(
					'key' => 'field_1',
					'label' => 'Название дома',
					'name' => 'house_name',
					'type' => 'text',
				),
				array(
					'key' => 'field_2',
					'label' => 'Координаты местонахождения',
					'name' => 'location_coordinates',
					'type' => 'text',
				),
				array(
					'key' => 'field_3',
					'label' => 'Количество этажей',
					'name' => 'num_floors',
					'type' => 'number',
					'min' => 1,
					'max' => 20,
					'step' => 1,
				),
				array(
					'key' => 'field_4',
					'label' => 'Тип строения',
					'name' => 'building_type',
					'type' => 'radio',
					'choices' => array(
						'panel' => 'Панель',
						'brick' => 'Кирпич',
						'foam' => 'Пеноблок',
					),
					'layout' => 'horizontal',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'real_estate',
					),
				),
			),
		) );
		global $acf_field_group_fields;

		$acf_field_group_fields[] = 're';
	}
}
add_action( 'acf/init', 'registerAcfFields' );

//function includeAcfFieldsInPlugin($version) {
//	global $acf_field_group_fields;
//	var_dump($acf_field_group_fields);
//	$acf_field_group_fields[] = 're';
//}
//add_action('acf/include_field_types', 'includeAcfFieldsInPlugin');
