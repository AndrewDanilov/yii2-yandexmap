$(function () {
	ymaps.ready(function () {

		function createPlacemark(point, draggable) {
			var balloonContents = [];
			if (Array.isArray(point) && point.length === 2) {
				point = {
					latitude: point[0],
					longitude: point[1],
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
				balloonContent: balloonContents,
			}, {
				preset: 'islands#icon',
				iconColor: point.color,
				draggable: draggable || false,
			})
		}

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

				if (params['jsClickMapCallback'] && typeof window[params['jsClickMapCallback']] !== 'undefined') {

					var myPlacemark;

					// defining address by coords and running callback function with them
					function runCallback(coords) {
						ymaps.geocode(coords).then(function (res) {
							var firstGeoObject = res.geoObjects.get(0);
							// полный адрес
							var fullAddress = firstGeoObject.getAddressLine();
							// город
							var locality = firstGeoObject.getLocalities().join(', ');
							// позиция начала названия улицы в полном адресе
							var pos = fullAddress.indexOf(locality) + locality.length + 2;
							var address = fullAddress.substr(pos);
							window[params['jsClickMapCallback']](id, coords, address);
						});
					}

					// adding point to map, if it set
					if (typeof params['points'][0] !== 'undefined') {
						myPlacemark = createPlacemark(params['points'][0], true);
						myMap.geoObjects.add(myPlacemark);
					}

					// add click event
					myMap.events.add('click', function (e) {
						var coords = e.get('coords');

						// if mark is already set - just move it
						if (myPlacemark) {
							myPlacemark.geometry.setCoordinates(coords);
						}
						// otherwise - create it
						else {
							myPlacemark = createPlacemark(coords, true);
							myMap.geoObjects.add(myPlacemark);
							// add end drag event, to get final coords
							myPlacemark.events.add('dragend', function () {
								runCallback(myPlacemark.geometry.getCoordinates());
							});
						}

						runCallback(coords);
					});

				} else {

					params['points'].forEach(function (point) {
						myMap.geoObjects.add(createPlacemark(point));
					});

				}

			}
		});
	});
});