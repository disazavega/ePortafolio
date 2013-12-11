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
        <form id='cm-choose-form' action='TODO' method='TODO' >
            <label><input type='radio' name='cm_id' value='1' />Me - Person</label>
            <label><input type='radio' name='cm_id' value='2' />My Address - Personal Address</label>
            <div class='concepts-bottom-buttons-container'>
                <input type='button' name='action' value='New' class='new-concept-btn' />
                <input type='button' name='action' value='Edit' class='edit-concept-btn' />
                <input type='button' name='action' value='Delete' class='delete-concept-btn' />
            </div>
            <input type='button' name='action' value='alignment' class='alignment-button' />
        </form>
    </div>
</div>
<scripttoload>
    $(document).ready(function () {
        var get_checked_input = function() {
            var f = $('#cm-choose-form')
            return f.find('input[type="radio"]:checked')
        }
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
        /* --------- Buttons handlers ------- */
        $('.edit-concept-btn').click(function (e) {
            var c = get_checked_input()
            if (c.length) {
                c = c.eq(0).attr('value')
                load_url('/concept.php', {
                    'cm_id': c,
                    'action': 'edit',
                })
            }
        })

        $('.delete-concept-btn').click(function (e) {
            var c = get_checked_input()
            if (c.length) {
                name = c.eq(0).parent().contents()[1].data /* this is clearly not good code TODO improve that */
                answer = window.confirm('Are you sure you want to desintegrate the materialized concept "' + name + '"')
                if (answer) {
                    $.post(SERVER_BASE_URL + '/concept.php', {
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
            load_url('/concept.php', {
                'action': 'new'
            })
        })

        $('.alignment-button').click(function (e) {
            var c = get_checked_input()
            if (c.length) {
                c = c.eq(0).attr('value')
                load_url('/alignment.php', {
                    'cm_id': c,
                    'action': 'list',
                })
            }
        })


    })
</scripttoload>
