<?php

namespace andrewdanilov\yandexmap;

use yii\base\Widget;

class YandexMap extends Widget
{
	// координаты центра
	// $center = [
	//     'latitude' => '52.449837',
	//	   'longitude' => '-1.930617',
	// ]
	public $center = [];
	public $zoom = 12;
	// точки с координатами и описанием
	// $points = [
	//     'title' => 'Point Caption',
	//     'text' => 'Point Text (html allowed)',
	//     'color' => '#00ff00',
	//     'latitude' => '52.449837',
	//     'longitude' => '-1.930617',
	// ];
	public $points = []; // точки с координатами и описанием
	public $scroll = false;

	public function run()
	{
		$view = $this->getView();
		YandexMapAsset::register($view);

		return $this->render('yandex-map', [
			'id' => $this->id,
			'center' => $this->center,
			'zoom' => $this->zoom,
			'scroll' => $this->scroll,
			'points' => $this->points,
		]);
	}
}