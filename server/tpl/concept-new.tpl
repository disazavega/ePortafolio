<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/concept.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/schema.css' rel='stylesheet' />
<link href='{$BASE_URL}/res/css/attribute.css' rel='stylesheet' />
<h2>Concept Creation</h2>

<form class='concept-new-form'>
    <input type='hidden' name='action' value='create'>
    <input type='hidden' name='schema_id' value='{$schema_id}'><!-- TODO: INject the actual form id? -->

    <div class='concept-form-top-aligned-fields'>
        <label for='concept_name_input'>Name</label> 
        <input id='concept_name_input' type='text' name='concept_name' />
    </div>
    
    <h3>Attributes</h3>
    
    <div id="attributes" class='attributes table'>
      
      <div class='attributes-header header-row'>
	<div>Name</div> <div>Type</div>
      </div>
      
      <div class='attribute row'>
	<div><input type="text" name="attributename[]"></input></div> 
	<div>
	  <select name="attributetype[]">
	    <option value="text">Text</option>
	    <option value="number">Number</option>
	    <option value="url">URL</option>
	    <option value="currenty">Currency</option>
	  </select>
	</div>
      </div>
      

    </div>
    
    <div>
      <div>
	<input type="button" id="add-attribute" value="+" />
	<input type="button" id="remove-attribute" value="-"/>
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
    
    $('#add-attribute').click(function (e) {
      var newrow = '<div class="attribute row">' + 
	'<div><input type="text" name="attributename[]"></input></div>' + 
	'<div>' +
	  '<select name="attributetype[]">' + 
	    '<option value="text">Text</option>' + 
	    '<option value="number">Number</option>' + 
	    '<option value="url">URL</option>' + 
	    '<option value="currenty">Currency</option>' + 
	  '</select>' + 
	'</div>' + 
      '</div>'
      
      $('#attributes').append(newrow);
    });
    
    $('#remove-attribute').click(function (e) {
      $('#attributes .row').get(length-1).remove()
    });
</scripttoload>
