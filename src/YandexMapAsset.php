<?php

namespace andrewdanilov\yandexmap;

use yii\web\AssetBundle;

class YandexMapAsset extends AssetBundle {
	public $sourcePath = '@andrewdanilov/yandexmap/web';
	public $js = [
		'//api-maps.yandex.ru/2.1/?lang=ru_RU',
		'js/ym.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];

	public $apikey;

	public function init()
	{
		if (!empty($this->apikey)) {
			$this->js[0] .= '&apikey=' . $this->apikey;
		}
		parent::init();
	}
}