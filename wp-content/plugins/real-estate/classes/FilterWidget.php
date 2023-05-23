<?php


class FilterWidget extends WP_Widget {
	public function __construct() {
		parent::__construct( 'refw', 'Фильтр для недвижимости', [
			'description' => "Виджет для вывода фильтра недвижимости"
		]);
	}
	public function widget( $args, $instance ) {
		// Вывод HTML-кода виджета
		echo $args['before_widget'];
		echo '<h3>Фильтрация недвижимости</h3>';
		$this->renderFilter();
		echo $args['after_widget'];
	}
	// Метод вывода формы настройки виджета в админке
	public function form( $instance ) {
		// Форма настроек виджета
		echo 'Настройки виджета';
		echo '<p>Этот виджет не имеет настроек, он выводит фильтр</p>';
	}
	//render form
	public function renderFilter(){
		echo '<div class="filter-widget">';
		echo '<div class="filter-widget__filter">';
		echo '<form id="reFilter" class="filter__form">';
		echo '<div class="form__grid-fields">';
		//реализовать вывод полей фильтра
		$this->renderTitleRow();
		$this->renderCoordinatesRow();
		$this->renderStagesRow();
		$this->renderBuildTypesRow();
		echo '</div>';
		echo '</form>';
		echo '</div>';//close filter
		echo '<div class="filter-widget__result" id="reFilterResult">';
		echo '</div>';//close result
		echo '</div>';//close container
	}
	//render form fields
	public function renderTitleRow(){
		echo '<label for="htitle">';
		echo '<span class="row-text">Поиск по имени</span>';
		echo '<input type="text" name="h_title" id="htitle">';
		echo '</label>';
	}
	public function renderCoordinatesRow(){
		echo '<label for="coordinates">';
		echo '<span class="row-text">Поиск по координатам</span>';
		echo '<p class="row-desc">Координаты вводить через точку</p>';
		echo '<input type="text" name="coordinates" id="coordinates">';
		echo '</label>';
	}
	public function renderStagesRow(){
		echo '<div class="stages">';
		echo '<p class="row-text">Поиск по этажности</p>';
		echo '<div class="stages__grid-stages">';
		$this->renderStageItems();
		echo '</div>'; //close grid
		echo '</div>'; //close stages
	}
	public function renderStageItems(){
		for ($i = 1; $i<=20; $i++):
			echo '<label for="'.$i.'">';
			echo '<input type="checkbox" name="stages[]" value="'.$i.'">';
			echo '</label>';
		endfor;
	}
	public function renderBuildTypesRow(){
		echo '<label for="buildTypes">';
		echo '<span class="row-text">Поиск по типу строений</span>';
		echo '<select name="build_types" id="buildTypes">';
		echo '<option default value="0">Выберите тип строения</option>';
		echo '<option value="p">Панель</option>';
		echo '<option value="k">Кирпич</option>';
		echo '<option value="pn">Пеноблок</option>';
		echo '</label>';
	}
}