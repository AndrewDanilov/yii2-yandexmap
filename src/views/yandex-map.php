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
					title: '<?= addslashes($point['title']) ?>',
					text:  '<?= addslashes($point['text']) ?>',
					color: '<?= $point['color'] ?>',
					latitude:   '<?= $point['latitude'] ?>',
					longitude:   '<?= $point['longitude'] ?>'
				},
				<?php } ?>
			],
		<?php } ?>
		scroll: '<?= $scroll ?>',
		jsClickMapCallback: '<?= $jsClickMapCallback ?>',
	};

</script>