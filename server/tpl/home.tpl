<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<div class="autocomplete-container" >

    <div class='gui-subblock gui-halfblock gui-folding-block'> 
        <h2 class='gui-folding-block-title'>Syntactic analysis</h2>

        <div class='gui-block-content gui-folding-block-content'>
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
    <div class='gui-subblock gui-halfblock gui-folding-block'>
        <h2 class='gui-folding-block-title'>Syntactic analysis</h2>
        <div class='gui-folding-block-content gui-init-unfolded'>
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
    <div class='gui-subblock gui-halfblock gui-folding-block'>
        <h2 class='gui-folding-block-title'>Syntactic analysis</h2>
        <div class='gui-folding-block-content' >
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
                unfolded.slideUp('fast')
                var toBeUnfolded = $(this).parent().find('.gui-folding-block-content')
                toBeUnfolded.slideDown('fast')
                unfolded = toBeUnfolded
            })
    })
</scripttoload>
