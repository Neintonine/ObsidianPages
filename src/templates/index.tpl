{$enableNavigation = false}
{$htmlTitle = "My public vaults"}
{extends file="base/layout.tpl"}

{block name="head"}
    <link href="{$basicConfig->getBaseURL()}css/indexPage.css" rel="stylesheet" >
{/block}

{block name="main"}

    <div class="contentDisplay">

        {if $hasAuthConfig}
            {if $isAuthenticated}
                <a style="float: right" href="{$basicConfig->getBaseURL()}logout">Logout</a>
                {else}
                <a style="float: right" href="{$basicConfig->getBaseURL()}login">Login</a>
            {/if}
        {/if}
        <h3>My Vaults:</h3>

        {foreach from=$vaults item=vault}
            <div>
                <a class="vaultSelect" href="{$basicConfig->getBaseURL()}{$vault->getFolderName()}/">
                    <div class="vaultSelector" style="background-color: {$vault->getColor()}"></div>
                    {$vault->getName()}
                </a>
            </div>
            <br>
        {/foreach}
    </div>
{/block}