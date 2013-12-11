<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/concept.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/alignment.css' rel='stylesheet' />
<h2>Alignment / Creation</h2>

<form class='alignment-new-form'>
	<input type='hidden' name='action' value='create'>
	<input type='hidden' name='cm_id' value='{$cm.id}'>

	<label for='alignment-name' >Name</label>
	<input type='text' id='alignment-name' name="alignment_name" value='' />

	<div class='two-edit-list-container' >
		<h3>Attribute</h3>
		<div class='alignment-edit-list-container'>
			{foreach $attributes_list as $item}
			<label><input type='radio' name='attribute_id' value='{$item.id}' />{$item.name}</label>
			{/foreach}
		</div>

		<h3>Field</h3>
		<div class='alignment-edit-list-container'>
			{foreach $fields_list as $item}
			<label><input type='radio' name='field_id' value='{$item.id}' />{$item.name}</label>
			{/foreach}
		</div>
	</div>

	<div class='alignment-edit-bottom-buttons' >
	    <input type='reset' class='cancel-button' value='Cancel' />
	    <input type='submit' class='submit-button' value='Save' />
	</div>

</form>

<scripttoload>
$(document).ready(function () {
	$('.alignment-new-form').bind('submit', function (e) {
		$.ajax({
			url: SERVER_BASE_URL + '/alignment.php',
			type: "POST",
			data: $(this).serialize(),
			success: function (data, txtStatus, jqXHR) {
				if (data === 'OK') {
					load_url('/home.php', null)
				} else {
					/* TODO: Error handling? */
					alert("Error, server responded: " + data)
				}
			},
			error: function (jqXHR, txtStatus, error) {
				console.log(jqXHR)
				console.log(txtStatus)
				console.log(error)
			}
		})
		e.preventDefault()
	})
});
</scripttoload>
