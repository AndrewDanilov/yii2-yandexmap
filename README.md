Yandex Map
===================
Widget loads yandex map and places marks on it provided with array or with handler url on json file.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-yandexmap "dev-master"
```

or add

```
"andrewdanilov/yii2-yandexmap": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

```php
<?= \andrewdanilov\yandexmap\YandexMap::widget([
	'id'  => 'some-unique-dom-id', // optional
	'center' => [
		'latitude' => '52.449837',
		'longitude' => '-1.930617',
	],
	'zoom' => 14, // default 12
	'points' => [
		[
			'title' => 'Point 1 Caption',
			'text' => 'Point 1 Text (html allowed)',
			'color' => '#00ff00',
			'latitude' => '52.449837',
			'longitude' => '-1.930617',
		],
		[
			'title' => 'Point 2 Caption',
			'text' => 'Point 2 Text (html allowed)',
			'color' => '#0000ff',
			'latitude' => '52.449845',
			'longitude' => '-1.930629',
		],
	],
	//'pointsUrl' => '/points.json', // url to generate array of points instead of manual setting in 'points' param
	'scroll' => true, // default false
	'wrapperTag' => 'span', // default 'div'
	'wrapperOptions' => [ // options passed to \yii\helpers\Html::tag() method for constructing map wrapper
		'class' => 'map-wrapper',
		'style' => 'width:50%;'
	],
]) ?>
```

points.json generate example
```php
<?php
$items = [
	[
		"type" => "Feature",
		"id" => 'point-1',
		"geometry" => [
			"type" => "Point",
			"coordinates" => [52.449837, -1.930617],
		],
		"properties" => [
			"hintContent" => 'some hint',
			"balloonContent" => 'some text',
		],
	],
	[
		"type" => "Feature",
		"id" => 'point-2',
		"geometry" => [
			"type" => "Point",
			"coordinates" => [52.449845, -1.930629],
		],
		"properties" => [
			"hintContent" => 'some other hint',
			"balloonContent" => 'some other text',
		],
	],
];
$collection = [
	"type" => "FeatureCollection",
	"features" => $items,
];
echo json_encode($collection);
```