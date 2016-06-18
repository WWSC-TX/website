<div id="menu">
<ul>
{foreach $menu as $key=>$value}
<li><a href="{$value}" class="menu{if $value@last} last-item{/if}">{$key}</a></li>
{/foreach}
</ul>
</div>