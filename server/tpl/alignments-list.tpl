<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/concept.css' rel='stylesheet' />
<h2>Alignments</h2>

<form class='edit-form'>

<div class='edit-list-container alignment-edit-list-container'>
	<form id='cm-choose-form'>new
		{foreach $alignments_list as $item}
		<label><input type='radio' name='materialized_concept' value='{$item.id}' />{$item.name}</label>
		{/foreach}
	    <div class='concepts-bottom-buttons-container'>
	        <input type='button' name='action' value='New' class='new-alignment-btn' />
	        <input type='button' name='action' value='Edit' class='edit-alignment-btn' />
	        <input type='button' name='action' value='Delete' class='delete-alignment-btn' />
	    </div>
	    <input type='button' name='action' value='alignment' class='alignment-button' />
	</form>	
</div>


<div class='edit-bottom-buttons' >
    <input type='submit' class='submit-button' value='Save' />
</div>

</form>

<scripttoload>
    $(document).ready(function () {
        var get_checked_input = function() {
            var f = $('#cm-choose-form')
            return f.find('input[type="radio"]:checked')
        }
        /* --------- Buttons handlers ------- */
        $('.edit-alignment-btn').click(function (e) {
            var c = get_checked_input()
            if (c.length) {
                c = c.eq(0).attr('value')
                load_url('/alignment.php', {
                    'alignment_id': c,
                    'action': 'edit',
                })
            }
        })

        $('.delete-alignment-btn').click(function (e) {
            var c = get_checked_input()
            if (c.length) {
                name = c.eq(0).parent().contents()[1].data /* this is clearly not good code TODO improve that */
                answer = window.confirm('Are you sure you want to desintegrate the alignment "' + name + '"')
                if (answer) {
                    $.post(SERVER_BASE_URL + '/alignment.php', {
                        'action': 'delete',
                        'alignment_id': c.eq(0).attr('value')
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


        $('.new-alignment-btn').click(function (e) {
            load_url('/alignment.php', {
                'action': 'new',
                'cm_id': {$cm.id} /* we need the CM id in order to create an alignment, so that we can display the right options... */
            })
        })

        $('.alignment-button').click(function (e) {
            var c = get_checked_input()
            if (c.length) {
                c = c.eq(0).attr('value')
                load_url('/alignment.php', {
                    'alignment_id': c,
                    'action': 'list',
                })
            }
        })


    })
</scripttoload>
