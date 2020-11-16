<?php

/* @var $this \yii\web\View */
/* @var $wrapper string */
/* @var $id string */
/* @var $center array */
/* @var $points array */
/* @var $pointsUrl string */
/* @var $zoom int */
/* @var $scroll boolean */
/* @var $jsClickMapCallback string */

use andrewdanilov\yandexmap\Strings;

?>

<?= $wrapper ?>

<script type="text/javascript">

	if (typeof ymstore == 'undefined') {
		var ymstore = {};
	}
	ymstore['<?= $id ?>'] = {
		center: ['<?= $center['latitude'] ?>','<?= $center['longitude'] ?>'],
		zoom: '<?= $zoom ?>',
		<?php if ($pointsUrl) { ?>
		pointsUrl: '<?= $pointsUrl ?>',
		<?php } else { ?>
		points: [
			<?php foreach ($points as $point) { ?>
			{
				title: '<?= Strings::cleanScriptStr($point['title']) ?>',
				text:  '<?= Strings::cleanScriptText($point['text']) ?>',
				color: '<?= Strings::cleanScriptStr($point['color']) ?>',
				latitude:   '<?= Strings::cleanScriptStr($point['latitude']) ?>',
				longitude:   '<?= Strings::cleanScriptStr($point['longitude']) ?>'
			},
			<?php } ?>
		],
		<?php } ?>
		scroll: <?= $scroll ? 'true' : 'false' ?>,
		jsClickMapCallback: '<?= Strings::cleanScriptStr($jsClickMapCallback) ?>',
	};

</script>