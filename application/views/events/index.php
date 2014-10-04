<?php foreach ($events as $event) : ?>
	<?php $this->load->view('templates/event', array('event' => $event)); ?>
<?php endforeach; ?>