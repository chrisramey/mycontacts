<h2>New Contact</h2>
<form class="form-horizontal" action="actions/add_contact.php" method="post">
	<div class="control-group">
		<label class="control-label" for="first_name">Name</label>
		<div class="controls">
			<?php echo input('contact_firstname','first name') ?> 
			<?php echo input('contact_lastname','last name') ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_email">Email</label>
		<div class="controls">
			<?php echo input('contact_email','you@example.com') ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_phone1">Phone</label>
		<div class="controls">
			( <?php echo input('contact_phone1','999',null,'phone span1') ?> ) 
			<?php echo input('contact_phone2','888',null,'phone span1') ?>-
			<?php echo input('contact_phone3','7777',null,'phone span2') ?>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-success"><i class="icon-plus-sign icon-white"></i> Add Contact</button>
		<button type="button" class="btn">Cancel</button>
	</div>
</form>