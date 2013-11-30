<link href='{$BASE_URL}/res/css/home.css' rel='stylesheet' />
<dl class='autocomplete-history'>
{foreach $history as $entry}

<dt>
{$entry.name} <span class='entry-title-separation'>--</span> {$entry.date}
</dt>
<dd>
Here we can put the multiple entries for a same name if we want...
</dd>

{/foreach}

<scripttoload>
    $(document).ready(function () {
        $('.autocomplete-history dt').click(function (e) {
            $(this).next('dd').slideToggle('fast'); 
        })
    })
</scripttoload>
