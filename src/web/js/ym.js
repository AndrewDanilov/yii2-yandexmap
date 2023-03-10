$(function () {
	ymaps.ready(function () {

		function createPlacemark(point) {
			var point_id = point.id || 0;
			var balloonContents = [];
			if (Array.isArray(point) && point.length === 2) {
				point = {
					latitude: point[0],
					longitude: point[1]
				}
			}
			if (point.title) {
				balloonContents.push('<b>' + point.title + '</b>');
			}
			if (point.text) {
				balloonContents.push(point.text);
			}
			if (balloonContents.length) {
				balloonContents = balloonContents.join('<br>');
			} else {
				balloonContents = false;
			}
			return new ymaps.Placemark([point.latitude, point.longitude], {
				id: point_id,
				balloonContent: balloonContents
			}, {
				preset: 'islands#icon',
				iconColor: point.color,
				draggable: false
			})
		}

		$.each(ymstore, function (id, params) {
			function onObjectEvent(e) {
				if (params['jsPointsClickCallback'] && typeof window[params['jsPointsClickCallback']] !== 'undefined') {
					var point_id = e.get('objectId') || e.get('target').properties.get('id');
					window[params['jsPointsClickCallback']](point_id);
				}
			}

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

				objectManager.objects.events.add(['click'], onObjectEvent);

			} else {

				params['points'].forEach(function (point) {
					var placemark = createPlacemark(point);
					placemark.events.add(['click'], onObjectEvent);
					myMap.geoObjects.add(placemark);
				});

			}
		});
	});
});