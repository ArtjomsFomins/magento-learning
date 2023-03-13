'use strict';

define([
    'ko',
    'uiElement'
], function (ko, Element) {
    console.log("hello")
    return Element.extend({
        defaults: {
            // template: 'Magento_Catalog/input-counter'
        },

        initObservable: function () {
            this._super()
                .observe('counterValue');

            return this;
        },
    });
});
