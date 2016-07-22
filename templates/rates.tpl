{include file="header.tpl"}

<div class="colmask twocol">
	<div class="colleft">
		<div class="col1">	<!-- Right column start -->
		<h2>{$base['caption']}</h2>
{foreach $rates_links as $title=>$file}
		<h2><a href="downloads/{$file}">{$title}</a></h2>
{/foreach}
		<table id="rates">
			<tr id="baseRow">
				<td>{$base['label']}</td>
				<td>${$base['cost']}</td>
			</tr>
			<tr class="spacer"></tr>
			<tr>
				{foreach $header as $th}
				<th>{$th}</th>
				{/foreach}
			</tr>
			{foreach $prices as $gal=>$amt}
			<tr class="{if $amt@iteration is even by 1}even{else}odd{/if}">
				<td>{$gal}</td>
				<td class="rightcol">${$amt}</td>
			</tr>
			{/foreach}
		</table>
		</div>							<!-- Right column end -->
		<div class="col2">	<!-- Left column start -->
		{include file="news.tpl"}
		</div>							<!-- Left column end -->
	</div>
</div>

{include file="footer.tpl"}