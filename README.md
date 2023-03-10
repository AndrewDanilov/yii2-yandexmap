Yandex Map
===================
Widget loads yandex map and places marks on it provided with array or with handler url on json file.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-yandexmap "~1.0.0"
```

or add

```
"andrewdanilov/yii2-yandexmap": "~1.0.0"
```

to the `require` section of your `composer.json` file.


Usage
-----

```php
<?= \andrewdanilov\yandexmap\YandexMap::widget([
    'id'  => 'some-unique-dom-id', // optional, an ID applied to widget wrapper
    'apikey' => '', // optional, yandex map api key
    'center' => [
        'latitude' => '52.449837',
        'longitude' => '-1.930617',
    ], // or in short 'center' => ['52.449837', '-1.930617']
    'zoom' => 14, // optional, default 12
    'points' => [
        [
            'id' => 'point-1',
            'title' => 'Point 1 Caption',
            'text' => 'Point 1 Text (html allowed)',
            'color' => '#00ff00',
            'latitude' => '52.449837',
            'longitude' => '-1.930617',
        ],
        [
            'id' => 'point-2',
            'title' => 'Point 2 Caption',
            'text' => 'Point 2 Text (html allowed)',
            'color' => '#0000ff',
            'latitude' => '52.449845',
            'longitude' => '-1.930029',
        ],
    ],
    //'pointsUrl' => '/points.json', // url used to get an array of points instead of manual setting the 'points' param
    'scroll' => true, // optional, zoom map by scrolling, default false
    'wrapperTag' => 'div', // optional, html tag to wrap the map, default 'div'
    'wrapperOptions' => [ // optional, attributes passed to \yii\helpers\Html::tag() method for constructing map wrapper
        'class' => 'map-wrapper',
        'style' => 'width:100%;height:400px;',
    ],
    // Javascript function name to handle clicks on placemarks.
    // Callback function can accept just one param - point ID string.
    'jsPointsClickCallback' => 'myCallback',
]) ?>
```

Callback function handling clicks on placemarks example

```js
<script>
    function myCallback(point_id) {
		console.log(point_id)
    }
</script>
```

points.json example

```json
{
    "type": "FeatureCollection",
    "features": [
        {
            "type": "Feature",
            "id": "point-1",
            "geometry": {
                "type": "Point",
                "coordinates": [
                    52.449837,
                    -1.930617
                ]
            },
            "properties": {
                "hintContent": "some hint",
                "balloonContent": "some text"
            }
        },
        {
            "type": "Feature",
            "id": "point-2",
            "geometry": {
                "type": "Point",
                "coordinates": [
                    52.449845,
                    -1.930029
                ]
            },
            "properties": {
                "hintContent": "some other hint",
                "balloonContent": "some other text"
            }
        }
    ]
}
```

points.json generate example in php

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
            "coordinates" => [52.449845, -1.930029],
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
