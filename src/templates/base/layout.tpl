<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        {include file="base/head.tpl"}
        {block "head"}{/block}
    </head>
    <body>

        <div class="flex-container">

            <nav>
                <div class="navigationBackground"></div>
                {if $smarty.const.USE_TINTED_NAVIGATION}
                    <div class="tintedNavigation"></div>
                {/if}
                <div class="navigation-content">
                    {block "navigation"}{/block}
                </div>

            </nav>

            <main>

                {block "main"}{/block}

            </main>

        </div>
    </body>
</html>