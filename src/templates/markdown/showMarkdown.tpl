{$htmlTitle =  "`$title` - `$vault->getName()`" }

{extends file="base/layout.tpl"}

{block name="head"}
    <!--suppress ALL -->
    <meta property="og:title" content="{$htmlTitle}" />
    <meta property="og:description" content="{$rawContent|truncate:200}" />
    <meta name="theme-color" content="#FF0000">
    <meta name="description" content="{$rawContent|truncate:200}">
    <link href="{$smarty.const.BASE_URL}css/markdown.css" rel="stylesheet" >
    <link href="{$smarty.const.BASE_URL}css/navigationItems.css" rel="stylesheet" >
    <title>{$htmlTitle}</title>

    <script>
        $(function () {
            $('.navigation-containsSelection').click();
            {if $content == ''}
                toggleNavigation();
            {/if}
        });
    </script>
    <style>
        {if $smarty.const.USE_TINTED_NAVIGATION}
        .tintedNavigation {
            background-color: {$vault->getColor()}
        }
        {/if}
    </style>
{/block}

{block name="navigation"}
    {include file='markdown/navigation/navigation.tpl'}
{/block}

{block name="main"}
    <div class="contentDisplay">
        <p class="title">{$title}</p>

        {$content}

    </div>
{/block}