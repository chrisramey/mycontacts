<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="./">MyContacts</a>
		<ul class="nav">
		<?php foreach($pages as $file => $text): ?>
			<li><a href="./?p=<?php echo $file ?>"><?php echo $text ?></a></li>
		<?php endforeach ?>
		</ul>
	</div>
</div>