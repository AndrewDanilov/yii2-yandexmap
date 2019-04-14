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

			if (params['pointsUrl']) {

				var objectManager = new ymaps.ObjectManager();
				myMap.geoObjects.add(objectManager);

				var param = $('meta[name=csrf-param]').attr("content");
				var token = $('meta[name=csrf-token]').attr("content");
				var csrf_data = {};
				if (param && token) {
					csrf_data[param] = token;
				}
				$.ajax({
					url: params['pointsUrl'],
					type: 'post',
					dataType: 'json',
					data: csrf_data
				}).done(function(data) {
					if (data !== null) {
						objectManager.add(data);
					}
				});

			} else {

				params['points'].forEach(function(point) {
					myMap.geoObjects
						.add(new ymaps.Placemark([point.latitude, point.longitude], {
							balloonContent: '<b>' + point.title + '</b><br>' + point.text
						}, {
							preset: 'islands#icon',
							iconColor: point.color
						}));
				});

			}
		});
	});
});