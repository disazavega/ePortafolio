<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />

<div class="autocomplete-container gui-folding-block" >
    <h2 class='gui-folding-block-title'>Autocomplete</h2>
    <div class='gui-folding-block-content' >
        <div class='gui-subblock gui-halfblock'> 
            <h2 class=''>Syntactic analysis</h2>

            <div class='gui-block-content'>
                <dl class='autocomplete-history'>
                {foreach $longerhistory as $entry}

                <dt>
                {$entry.name} <span class='entry-title-separation'>--</span> {$entry.date}
                </dt>
                <dd>
                Here we can put the multiple entries for a same name if we want...
                </dd>

                {/foreach}
            </div>
        </div>
        <div class='gui-subblock gui-halfblock'>
            <h2 class=''>Semantic analysis</h2>
            <div class=''>
                <dl class='autocomplete-history'>
                {foreach $history as $entry}

                <dt>
                {$entry.name} <span class='entry-title-separation'>--</span> {$entry.date}
                </dt>
                <dd>
                Here we can put the multiple entries for a same name if we want...
                </dd>

                {/foreach}
            </div>
        </div>
    </div>
</div>
<div class='cm-container gui-folding-block'>
    <h2 class='gui-folding-block-title'>Concept Materializer</h2>
    <div class='gui-folding-block-content gui-init-unfolded' >
        <h3>Concepts</h3>
        <form id='cm-choose-form' >
            {foreach $materialized_concepts_list as $item}
            <label><input type='radio' name='cm_id' value='{$item.id}' />{$item.name}</label>
            {/foreach}
            <div class='bottom-buttons-container'>
                <input type='button' name='action' value='New' class='new-concept-btn' />
                <input type='button' name='action' value='Edit' class='edit-concept-btn' />
                <input type='button' name='action' value='Delete' class='delete-concept-btn' />
            </div>
            <input type='button' name='action' value='Alignment' class='alignment-button' />
        </form>
    </div>
</div>
<div class='schema-container gui-folding-block'>
    <h2 class='gui-folding-block-title'>Schema</h2>
    <div class='gui-folding-block-content gui-init-unfolded' >
        <h3>Schemas</h3>
        <form id='schema-choose-form' >
            {foreach $schema_list as $item}
            <label><input type='radio' name='schema_id' value='{$item.id}' />{$item.name}</label><br/>
            {/foreach}
            <div class='bottom-buttons-container'>
                <input type='button' name='action' value='New' class='new-schema-btn' />
                <input type='button' name='action' value='Edit' class='edit-schema-btn' />
                <input type='button' name='action' value='Delete' class='delete-schema-btn' />
            </div>
        </form>
    </div>
</div>
<scripttoload>
    $(document).ready(function () {
        /* Sliding up/down tabs code */
        $('.autocomplete-history dt').click(function (e) {
            $(this).next('dd').slideToggle('fast'); 
        })
        /* At the beginning, fold everything except the one noted as not folder at the beginning: */
        $('.gui-folding-block-content').toggle()
        var unfolded = $('.gui-init-unfolded')
        unfolded.slideDown('fast')
        $('.gui-folding-block .gui-folding-block-title').click(function () {
                unfolded.slideUp('fast')
                var toBeUnfolded = $(this).parent().find('.gui-folding-block-content')
                toBeUnfolded.slideDown('fast')
                unfolded = toBeUnfolded
            })
        
        /* ------ Now it's about materialized concepts ------- */
        var get_cm_checked_input = function() {
            var f = $('#cm-choose-form')
            return f.find('input[type="radio"]:checked')
        }
        /* --------- Buttons handlers ------- */
        $('.edit-concept-btn').click(function (e) {
            var c = get_cm_checked_input()
            if (c.length) {
                c = c.eq(0).attr('value')
                load_url('/materialized_concept.php', {
                    'cm_id': c,
                    'action': 'edit',
                })
            }
        })

        $('.delete-concept-btn').click(function (e) {
            var c = get_cm_checked_input()
            if (c.length) {
                name = c.eq(0).parent().contents()[1].data /* this is clearly not good code TODO improve that */
                answer = window.confirm('Are you sure you want to desintegrate the materialized concept "' + name + '"')
                if (answer) {
                    $.post(SERVER_BASE_URL + '/materialized_concept.php', {
                        'action': 'delete',
                        'cm_id': c.eq(0).attr('value')
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
            load_url('/materialized_concept.php', {
                'action': 'new'
            })
        })

        /* ------ Now it's about schemas ------- */
        var get_schema_checked_input = function() {
            var f = $('#schema-choose-form')
            return f.find('input[type="radio"]:checked')
        }

        /* --------- Buttons handlers ------- */
        $('.edit-schema-btn').click(function (e) {
            var c = get_schema_checked_input()
            if (c.length) {
                c = c.eq(0).attr('value')
                load_url('/schema.php', {
                    'schema_id': c,
                    'action': 'edit',
                })
            }
        })

        $('.delete-schema-btn').click(function (e) {
            var c = get_schema_checked_input()
            if (c.length) {
                name = c.eq(0).parent().contents()[1].data /* this is clearly not good code TODO improve that */
                answer = window.confirm('Are you sure you want to delete Schema "' + name + '"')
                if (answer) {
                    $.post(SERVER_BASE_URL + '/schema.php', {
                        'action': 'delete',
                        'schema_id': c.eq(0).attr('value')
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

        $('.new-schema-btn').click(function (e) {
            load_url('/schema.php', {
                'action': 'new'
            })
        })

        $('.alignment-button').click(function (e) {
            var c = get_cm_checked_input()
            if (c.length) {
                c = c.eq(0).attr('value')
                load_url('/alignment.php', {
                    'cm_id': c,
                    'action': 'list',
                })
            } else {
                alert('Nothing has been checked!')
            }
        })
        
    })
</scripttoload>
