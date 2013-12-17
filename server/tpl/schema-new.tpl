<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/concept.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/schema.css' rel='stylesheet' />
<h2>Schemas / Creation</h2>

<form class='schema-new-form'>
	<input type='hidden' name='action' value='create'>
	<input type='hidden' name='form_id' value='1'><!-- TODO: INject the actual form id? -->

	<div class='schema-form-top-aligned-fields'>
		<label for='schema_name_input'>Name</label>		<input id='schema_name_input' type='text' name='schema_name' />
		<label for='schema_author_input'>Author</label>	<input id='schema_author_input' type='text' name='schema_author' />
		<label for='schema_date_input'>Date</label>		<input id='schema_date_input' type='text' name='schema_date' />
	</div>

</form>

<scripttoload>



</scripttoload>