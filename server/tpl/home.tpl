<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<div class="autocomplete-container gui-folding-block" >
    <h2 class='gui-folding-block-title'>Autocomplete</h2>
    <div class='gui-folding-block-content gui-init-unfolded' >
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
    <div class='gui-folding-block-content' >
        <h3>Concepts</h3>
        <form action='TOOD' method='TODO' >
            <label><input type='radio' name='concept' value='1' />Me - Person</label>
            <label><input type='radio' name='concept' value='1' />My Address - Personal Address</label>
            <div class='concepts-bottom-buttons-container'>
                <input type='button' name='action' value='New' />
                <input type='button' name='action' value='Edit' />
                <input type='button' name='action' value='Delete' />
            </div>
            <input type='button' name='action' value='alignment' class='alignment-button' />
        </form>
    </div>
</div>
<scripttoload>
    $(document).ready(function () {
        $('.autocomplete-history dt').click(function (e) {
            $(this).next('dd').slideToggle('fast'); 
        })
        // At the beginning, fold everything except the one noted as not folder at the beginning:
        $('.gui-folding-block-content').toggle()
        var unfolded = $('.gui-init-unfolded')
        unfolded.slideDown('fast')
        $('.gui-folding-block .gui-folding-block-title').click(function () {
                unfolded.slideUp('slow')
                var toBeUnfolded = $(this).parent().find('.gui-folding-block-content')
                toBeUnfolded.slideDown('slow')
                unfolded = toBeUnfolded
            })
    })
</scripttoload>
