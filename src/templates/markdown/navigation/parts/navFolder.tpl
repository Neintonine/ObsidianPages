<div
        style="margin-left: 6px"
        class="navigation-item navigation-item-{$directoryIndex} {if $depth === 0}navigation-item-shown{/if} navigation-folder"
>
    <i class="fa-solid fa-angle-down navigation-arrow navigation-arrow-{$targetDirectoryIndex}"></i>
    <a
            onclick="toggleNavigationItem({$targetDirectoryIndex})"
            class="navigation-item-text {if $containsSelection}navigation-containsSelection{/if}"
    >
        {$foldername}
    </a>
    {$content}
</div>