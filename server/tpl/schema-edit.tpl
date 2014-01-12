<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/concept.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/schema.css' rel='stylesheet' />
<h2>Schemas / Creation</h2>

<form class='schema-edit-form'>
    <input type='hidden' name='action' value='update'>
    <input type='hidden' name='form_id' value='1'><!-- TODO: INject the actual form id? -->
	<input id='schema_id_input' type='hidden' name='schema_id' value='{$schema.id}'/>

    <div class='schema-form-top-aligned-fields'>
        <label for='schema_name_input'>Name</label>     <input id='schema_name_input' type='text' name='schema_name' value='{$schema.name}'/>
        <label for='schema_author_input'>Author</label> <input id='schema_author_input' type='text' name='schema_author' value='{$schema.author}'/>
        <label for='schema_date_input'>Date</label>     <input id='schema_date_input' type='text' name='schema_date' value='{$schema.date}'/>
    </div>

    <div class=''>
        <h3>Concepts</h3>
        <div id='concept-choose-form' class='edit-list-container'>
            {foreach $concepts_list as $item}
            <label><input type='radio' value='{$item.id}' name='concept_id'> {$item.name}</label>
            {/foreach}
        </div>
        <div class='bottom-buttons-container'>
            <input type='button' name='action' value='New' class='new-concept-btn' />
            <input type='button' name='action' value='Edit' class='edit-concept-btn' />
            <input type='button' name='action' value='Delete' class='delete-concept-btn' />
        </div>
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
    })

    $('.delete-concept-btn').click(function (e) {
        var c = get_concept_checked_input()
        if (c.length) {
            name = c.eq(0).parent().contents()[1].data /* this is clearly not good code TODO improve that */
            answer = window.confirm('Are you sure you want to desintegrate the materialized concept "' + name + '"')
            if (answer) {
                $.post(SERVER_BASE_URL + '/concept.php', {
                    'action': 'delete',
                    'concept_id': c.eq(0).attr('value')
                },
                function (data, txtStatus, jqXHR) {
                    if (data === 'OK') {
                        load_url('/home.php', null)
                    } else {
                        /* TODO: Error handling? */
                        alert("Error, server responded: " + data)
                    }
                })
            } else {
                return false
            }
        } else {
            return false
        }
    })


    $('.new-concept-btn').click(function (e) {
        load_url('/concept.php', {
            'action': 'new',
            'schema_id' : {$schema.id}
        })
    })

    $('.cancel-button').click(function (e) {
        load_url('/home.php'); return false;
    })	

	$('.schema-edit-form').bind('submit', function (e) {
		$.ajax({
			url: SERVER_BASE_URL + '/schema.php',
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
</scripttoload>
