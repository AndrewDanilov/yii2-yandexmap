$(function () {
	ymaps.ready(function () {
		$.each(ymstore, function (id, params) {
			var myMap = new ymaps.Map(id, {
					center: params['center'],
					zoom: params['zoom']
				}, {
					searchControlProvider: 'yandex#search'
				});

			if (params['scroll'] === false) {
				myMap.behaviors.disable('scrollZoom');
			}

			params['points'].forEach(function(point) {
				myMap.geoObjects
					.add(new ymaps.Placemark([point.latitude, point.longitude], {
						balloonContent: '<b>' + point.title + '</b><br>' + point.text
					}, {
						preset: 'islands#icon',
						iconColor: point.color
					}));
			});
		});
	});
});