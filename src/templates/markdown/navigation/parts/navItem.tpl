<div
        style="margin-left: 6px; padding-left: 20px"
        class="navigation-item navigation-item-{$directoryIndex} {if $depth === 0}navigation-item-shown{/if}"
>
    <a
            href="{$basicConfig->getBaseURL()}{$path}"
            class="navigation-item-text {if $isSelected}navigation-item-selected{/if}"
    >
        {$content}
    </a>
</div>