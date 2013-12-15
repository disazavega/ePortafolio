<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/concept.css' rel='stylesheet' />
<h2>Concept Materialization / Creation</h2>

<form class='cm-new-form'>
	<input type='hidden' name='action' value='create'>

	<label for='concept-name' >Name</label>
	<input type='text' id='concept-name' name="cm_name" value='' />

	<h3>Concept</h3>
	<div class='cm-edit-list-container'>
		{foreach $concepts_list as $item}
		<label><input type='radio' name='materialized_concept' value='{$item.id}' />{$item.name}</label>
		{/foreach}
	</div>

	<div class='cm-edit-bottom-buttons' >
	    <input type='reset' class='cancel-button' value='Cancel' />
	    <input type='submit' class='submit-button' value='Save' />
	</div>

</form>

<scripttoload>
$(document).ready(function () {
	$('.cm-new-form').bind('submit', function (e) {
		$.ajax({
			url: SERVER_BASE_URL + '/materialized_concept.php',
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
