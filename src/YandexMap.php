<?php

namespace andrewdanilov\yandexmap;

use yii\base\Widget;
use yii\helpers\Html;

class YandexMap extends Widget
{
	// center coordinates
	// $center = [
	//     'latitude' => '52.449837',
	//	   'longitude' => '-1.930617',
	// ]
	public $center = [];
	public $zoom = 12;
	// points with coordinates and some description
	// $points = [
	//     [
	//         'title' => 'Point 1 Caption',
	//         'text' => 'Point 1 Text (html allowed)',
	//         'color' => '#00ff00',
	//         'latitude' => '52.449837',
	//         'longitude' => '-1.930617',
	//     ],
	//     [
	//         'title' => 'Point 2 Caption',
	//         'text' => 'Point 2 Text (html allowed)',
	//         'color' => '#0000ff',
	//         'latitude' => '52.449845',
	//         'longitude' => '-1.930629',
	//     ],
	// ];
	public $points = [];
	public $pointsUrl; // url to generate array of points instead of manual setting in 'points' param
	public $scroll = false;

	public $wrapperTag = 'div';
	public $wrapperOptions = [];

	public function run()
	{
		$view = $this->getView();
		YandexMapAsset::register($view);

		$this->wrapperOptions['id'] = $this->id;
		$wrapper = Html::tag($this->wrapperTag, null, $this->wrapperOptions);

		return $this->render('yandex-map', [
			'wrapper' => $wrapper,
			'id' => $this->id,
			'center' => $this->center,
			'zoom' => $this->zoom,
			'points' => $this->points,
			'pointsUrl' => $this->pointsUrl,
			'scroll' => $this->scroll,
		]);
	}
}