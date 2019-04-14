Yandex Map
===================
Yandex map widget places map with mark on any page of your site.

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
]) ?>
```

points.json example
```json
//todo
```