{$enableNavigation = $enableNavigation|default:true}
{$htmlTitle = $htmlTitle|default:""}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:url" content="{$smarty.server.HTTP_HOST}{$smarty.server.REQUEST_URI}" />
        <title>{$htmlTitle}</title>
        {include file="base/head.tpl"}
        {block "head"}{/block}

        <style>
            {if !$enableNavigation}
            main {
                border-bottom-left-radius: 0;
                border-top-left-radius: 0;
            }
            {/if}
        </style>

    </head>
    <body>

        <div class="contentWrapper" data-navOpen="false">
            {if $enableNavigation}
                <nav>
                    {if $smartyConfig->isUsingTintedNavigation()}
                        <div class="tintedNavigation"></div>
                    {/if}

                    <a onclick="toggleNavigation()" style="font-size: 18pt"><i class="navToggle fa-solid fa-bars"></i> <span class="navToggleText">Navigation</span></a>

                    <div class="navigation-content">
                        {block "navigation"}{/block}
                    </div>

                    {if $hasAuthConfig}
                    <div class="navigation-content nav-login">
                        <a href="{$basicConfig->getBaseURL()}login">Login</a>
                    </div>
                    {/if}
                </nav>
            {/if}

            <main>
                {block "main"}{/block}
            </main>
        </div>

    </body>
</html>