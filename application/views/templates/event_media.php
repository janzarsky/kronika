<div class="event__media">
	<ul class="rslides">
		<?php foreach ($media as $m): ?>
			<?php if ($m['type'] == 0): ?>
			<li><img src="<?php echo media_image($m['id']); ?>" alt="" /></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</div>