<?php
use srlab\classes\Form;
$TEMPLATE = new Form;
?>
<form action="<?php the_permalink(); ?>" method="POST" class="form--6">
	<?php $TEMPLATE->sr_contact_form(); ?>
	<div class="form-wrap form_full jsc">
		<input type="submit" value="Submit" class="btn pri--btn b--hero">
	</div>
</form>