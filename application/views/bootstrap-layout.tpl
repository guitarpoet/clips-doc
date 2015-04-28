{extends file="base-layout.tpl"}
	{block name="main"}
		{container}
			{row}
				{column class="navbar" id="navigationbar"}
					{column class="navbar-header"}
						{h3 id="brand"}{context key="app_name"}{/h3}
					{/column}
					{column class="navbar-section"}
						{block name="navbar"}{/block}
					{/column}
				{/column}
				{column id="content"}
					{row}
						{column id="quickbar"}
							{row}
								{column}
									{row class="navbar"}
										{column class="navbar-header"}
											{h3}{context key="html_title"}{/h3}
										{/column}
									{/row}
								{/column}
							{/row}
						{/column}
						{column id="toolbar"}
							{block name="toolbar"}{/block}
						{/column}
						{column id="workbench"}
							{row}
								{column}
									{row id="editarea"}
										{block name="workbench"}{/block}
									{/row}
								{/column}
							{/row}
						{/column}
					{/row}
				{/column}
			{/row}
		{/container}
	{/block}
