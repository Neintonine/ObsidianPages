{extends file="base/layout.tpl"}

{block name="head"}
    <link href="{$smarty.const.BASE_URL}css/markdown.css" rel="stylesheet" >
    <link href="{$smarty.const.BASE_URL}css/navigation.css" rel="stylesheet" >
    <title>{$title} - {$vaultName}</title>

    <script>
        let showClass = 'navigation-item-shown';
        let arrowClass = 'navigation-arrow-shown';

        function toggleNavigation(target) {
            let selectors = $('.navigation-item-' + target);
            for (let selection of selectors) {
                selection = $(selection);
                if (selection.hasClass(showClass)) {
                    selection.removeClass(showClass);
                    let children = $('.' + showClass, selection);
                    console.log(children);

                    continue;
                }
                selection.addClass(showClass);
            }

            let arrowSelector = $('.navigation-arrow-' + target);
            if (arrowSelector.hasClass(arrowClass)) {
                arrowSelector.removeClass(arrowClass);
            } else {
                arrowSelector.addClass(arrowClass);
            }
        }

        $(function () {
            $('.navigation-containsSelection').click();
        });
    </script>
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