<?php

namespace andrewdanilov\yandexmap;

use yii\web\AssetBundle;

class YandexMapAsset extends AssetBundle {
	public $sourcePath = '@vendor/andrewdanilov/yii2-yandexmap/src/web';
	public $js = [
		'//api-maps.yandex.ru/2.1/?lang=ru_RU',
		'js/ym.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];
}