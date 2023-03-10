<?php

namespace andrewdanilov\yandexmap;

use yii\base\Widget;
use yii\helpers\Html;

class YandexMap extends Widget
{
	public $apikey; // optional
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

	// Javascript function name to handle clicks on map.
	// Works only with single point in 'points' array,
	// other points are ignored. Function can accept 3 params:
	// map ID string, coords string in format 'lon, lat' and
	// address string. Passed values represent map clicked point.
	public $jsPointsClickCallback = '';

	public function run()
	{
        $view = $this->getView();
        if (!empty($this->apikey)) {
            $view->getAssetManager()->bundles[YandexMapAsset::class] = [
                'apikey' => $this->apikey,
            ];
        }
        YandexMapAsset::register($view);

		$this->wrapperOptions['id'] = $this->id;
		$wrapper = Html::tag($this->wrapperTag, null, $this->wrapperOptions);

		if (!isset($this->center['latitude']) || !isset($this->center['longitude'])) {
			if (!is_array($this->center) || count($this->center) !== 2) {
				$this->center = [
					'latitude' => 0,
					'longitude' => 0,
				];
			} else {
				$this->center = [
					'latitude' => $this->center[0],
					'longitude' => $this->center[1],
				];
			}
		}

		return $this->render('yandex-map', [
			'wrapper' => $wrapper,
			'id' => $this->id,
			'center' => $this->center,
			'zoom' => $this->zoom,
			'points' => $this->points,
			'pointsUrl' => $this->pointsUrl,
			'scroll' => $this->scroll,
			'jsPointsClickCallback' => $this->jsPointsClickCallback,
		]);
	}
}