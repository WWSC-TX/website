<h1>{$news}</h1>
<ul style="list-style-type:circle;padding-left:5px">
{foreach $text as $line=>$link}
<li><a href="downloads/{$link}">{$line}</a></li>
{/foreach}
</ul>
<hr />

<dl>
{foreach $links as $text=>$link}
	<dt>{$text}</dt>
	<dd><a href="{$link}" rel="external">{$link}</a></dd>
{/foreach}
</dl>