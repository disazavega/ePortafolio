<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/concept.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/schema.css' rel='stylesheet' />
<h2>Concept Creation</h2>

<form class='concept-new-form'>
    <input type='hidden' name='action' value='create'>
    <input type='hidden' name='schema_id' value='{$schema_id}'><!-- TODO: INject the actual form id? -->

    <div class='concept-form-top-aligned-fields'>
        <label for='concept_name_input'>Name</label>     <input id='concept_name_input' type='text' name='concept_name' />
    </div>
	<div class='bottom-buttons-container'>
            <input type='reset' value='Cancel' class='cancel-button' />
            <input type='submit' value='Save/Create' class='submit-button' />
    </div>
</form>

<scripttoload>
    var get_concept_checked_input = function() {
        var f = $('#concept-choose-form')
        return f.find('input[type="radio"]:checked')
    }
    /* --------- Buttons handlers ------- */
    $('.edit-concept-btn').click(function (e) {
        var c = get_concept_checked_input()
        if (c.length) {
            c = c.eq(0).attr('value')
            load_url('/concept.php', {
                'concept_id': c,
                'action': 'edit',
            })
        }
    });

    
    $('.cancel-button').click(function (e) {
        load_url('/home.php'); return false;
    });	

    $('.concept-new-form').bind('submit', function (e) {
	    $.ajax({
		    url: SERVER_BASE_URL + '/concept.php',
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
	    });
	    e.preventDefault();
    })
</scripttoload>
