{extends file="base/layout.tpl"}

{block name="head"}
    <link href="{$smarty.const.BASE_URL}css/indexPage.css" rel="stylesheet" >
    <title>My public vaults</title>
{/block}

{block name="main"}
    <div class="contentDisplay">

        <h3>My Vaults:</h3>

        {foreach from=$vaults item=vault}
            <div>
                <a class="vaultSelect" href="{$smarty.const.BASE_URL}{$vault->getFolderName()}/">
                    <div class="vaultSelector" style="background-color: {$vault->getColor()}"></div>
                    {$vault->getName()}
                </a>
            </div><br>
        {/foreach}
    </div>
{/block}