{extends file="bootstrap-layout.tpl"}
			{block name="navbar"}
				{navigation actions=$actions}{/navigation}
			{/block}
			{block name="workbench"}
				{markup}{$content}{/markup}
			{/block}
