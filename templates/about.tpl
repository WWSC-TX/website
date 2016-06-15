{include file="header.tpl"}

<div class="colmask twocol">
	<div class="colleft">
		<div class="col1">	<!-- Right column start -->
		<div class="imageBorder"><img src="http://maps.googleapis.com/maps/api/staticmap?size={$size}&{if $center ne ''}center={$center}&{/if}{if $zoom ne ''}zoom={$zoom}&{/if}{if $scale ne ''}scale={$scale}&{/if}{if $format ne ''}format={$format}&{/if}{if $maptype ne ''}maptype={$maptype}&{/if}{if $language ne ''}language={$language}&{/if}{if $markers ne ''}markers={$markers}&{/if}{if $path ne ''}path={$path}&{/if}{if $visible ne ''}visible={$visible}&{/if}{if $style ne ''}style={$style}&{/if}sensor={$sensor}" />
		<div>{$office}</div></div>
		<div class="imageBorder"><a href="images/{$ccn_large}"><img src="images/{$ccn_small}" /></a>
		<div>{$ccn_area}</div></div>
		<br clear="both" />
		<h2>{$members['title']}</h2>
		<h4>{$members['term']}</h4>
		<p><a href="downloads/{$bylaws_link}">{$bylaws}</a></p>
		<table style="width: 100%" class="left">
			<tr>
				<th>{$members['th_title']}</th>
				<th>{$members['th_expires']}</th>
				<th>{$members['th_name']}</th>
			</tr>
			{foreach $members['board'] as $board_member}
			<tr class="{if $board_member@iteration is even by 1}even{else}odd{/if}">
				<td>{$board_member->title|default:'Board Member'}</td>
				<td class="center">{$board_member->expires|date_format:"%B %Y"}</td>
				<td class="rightcol">{$board_member->name}</td>
				</td>
			</tr>
			{/foreach}
		</table>
		<!--div id="map_canvas"></div-->
		</div>							<!-- Right column end -->
		<div class="col2">	<!-- Left column start -->
		{include file="news.tpl"}
		</div>							<!-- Left column end -->
	</div>
</div>

{include file="footer.tpl"}