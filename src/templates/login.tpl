{$enableNavigation = false}
{$htmlTitle = "Login"}
{extends file="base/layout.tpl"}

{block name="head"}
{/block}

{block name="main"}
    <div class="contentDisplay">

        <h2>Login</h2>

        {if $authResult !== ''}
            <div class="alert alert-danger">
                {$authResult}
            </div>
        {/if}

        <form action="{$basicConfig->getBaseURL()}login" method="post">


            {foreach from=$formular key=form_key item=form_item }
                <div class="form-floating mb-3">
                    <input type="{$form_item['type']}" name="{$form_item['name']}" class="form-control" id="floatingInput-{$form_key}" placeholder="{$form_item['placeholder']}">
                    <label for="floatingInput-{$form_key}">{$form_item['name']}</label>

                </div>
            {/foreach}

            <button class="btn btn-outline-primary">
                Login
            </button>
        </form>
    </div>
{/block}