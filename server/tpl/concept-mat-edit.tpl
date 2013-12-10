<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/concept.css' rel='stylesheet' />
<h2>Concept Materialization / Edition</h2>

<form>

<label for='concept-name' >Name</label>
<input type='text' id='concept-name' value='{$cm.name}' />

<h3>Concept</h3>
<div class='cm-edit-list-container'>
    <label><input type='radio' name='materialized_concept' value='1' />Thing</label>
    <label><input type='radio' name='materialized_concept' value='1' />Person</label>
    <label><input type='radio' name='materialized_concept' value='1' />Personal Addresse</label>
    <label><input type='radio' name='materialized_concept' value='1' />Travel</label>
</div>

<div class='cm-edit-bottom-buttons' >
    <input type="button" class='cancel-button' value='Cancel' />
    <input type='button' class='submit-button' value='Save' />
</div>

</form>

<scripttoload>
$(document).ready(function () {
	
});
</scripttoload>
