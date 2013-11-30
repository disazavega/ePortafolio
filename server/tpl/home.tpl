<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<div class="autocomplete-container" >

    <div class='gui-subblock gui-halfblock'> 
        <h2>Syntactic analysis</h2>

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

    <div class='gui-subblock gui-halfblock'>
        <h2>Syntactic analysis</h2>
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
<scripttoload>
    $(document).ready(function () {
        $('.autocomplete-history dt').click(function (e) {
            $(this).next('dd').slideToggle('fast'); 
        })
    })
</scripttoload>
