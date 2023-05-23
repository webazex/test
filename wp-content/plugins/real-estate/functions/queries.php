<?php
//get estates
function getEstates(array $args = []){
	$args = [
		'post_type' => 'estates',
		'posts_per_page' => 3,
		'paged' => 1
	];
	if(!empty($args) and is_array($args)){
		//add args
	}
	$query = new WP_Query($args);
	if(!empty($query->posts)){
		$html = '';
		$html .= '<div class="estates">';
		$html .= '<div class="estates__grid">';
		$maxPages  = ceil($query->found_posts / 3);
			foreach ( $query->posts as $estateObj ):
				$html .= '<div class="grid__estate" id="'.$estateObj->ID.'">';
				$metadata = get_field('re', $estateObj->ID);
				$name = $metadata['house_title'];
				$coordinates = $metadata['coordinates'];
				$level = $metadata['stages_count'];
				switch ($metadata['type_build']){
					case "p":
						$type = "Панель";
						break;
					case "k":
						$type = "Кирпич";
						break;
					case "pn":
						$type = "Пеноблок";
						break;
				}
				$html .= '<div class="estate">';
				$html .= '<h3>'.$estateObj->post_title.'</h3>';
				$html .= '<div class="estate__properties">';
				//name
				$html .= '<div class="properties__name">';
				$html .="<span>Название обьекта:</span><span>$name</span>";
				$html .= '</div>';
				//type
				$html .= '<div class="properties__type">';
				$html .="<span>Тип:</span><span>$type</span>";
				$html .= '</div>';
				//coordinates
				$html .= '<div class="properties__type">';
				$html .="<span>Координаты:</span><span>$coordinates</span>";
				$html .= '</div>';
				//level
				$html .= '<div class="properties__type">';
				$html .="<span>Этажность:</span><span>$level</span>";
				$html .= '</div>';
				$html .= '</div>';
			endforeach;
		$html .= '</div>';
		$html .= '<div class="estates__pagination">';
			for ($i = 1; $i <= intval($maxPages); $i++){
				if($i == 1){
					$html .= '<a href="" class="pagination__link first-paginate-link">'.$i.'</a>';
				}elseif ($i == $maxPages){
					$html .= '<a href="" class="pagination__link last-paginate-link">'.$i.'</a>';
				}else{
					$html .= '<a href="" class="pagination__link">'.$i.'</a>';
				}
			}
		$html .= '</div>';
		$html .= '</div>';
	}
	return $html;
}