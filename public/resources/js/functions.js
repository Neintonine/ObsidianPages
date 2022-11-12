let showClass = 'navigation-item-shown';
let arrowClass = 'navigation-arrow-shown';

window.toggleNavigationItem = function (target) {
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

window.toggleNavigation = function() {
    let contentWrapper = $('.contentWrapper')[0];
    contentWrapper.dataset.navopen = '' + !(contentWrapper.dataset.navopen === 'true');
}