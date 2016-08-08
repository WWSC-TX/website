{foreach $sidebar as $block}
<h4>{$block['label']}:</h4>
<p>{foreach $block['text'] as $line}{$line}{if $line@last}{else}<br>{/if}{/foreach}</p>
{if $block['email']}<p><a href="mailto:{$block['email']}">{$block['email']}</a></p>{/if}
{/foreach}