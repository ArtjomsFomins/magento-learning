'use strict'

define([
    'ko',
    'uiElement'
], function (ko, Element) {
    console.log('hello')
    return Element.extend({

        initObservable: function () {
            this._super()
                .observe('counterValue')
                //"buttonDisable": "true",

            this._super().observe('buttonDisable')
            //let button = ko.observable(false)
            return this
        },
        increment: function() {
            const value = parseInt(this.counterValue(),10)
            this.counterValue(value + 1)
            if(value > 0) {
                document.querySelector('.cart__btn').disabled = false
            }
        },
        decrement: function() {
            const value = parseInt(this.counterValue(),10)
            if(value === 1) {
                document.querySelector('.cart__btn').disabled = true
            }
            if(value === 0) {
                return
            }
            this.counterValue(value - 1)
        },
        isOverZero: function() {
            const value = parseInt(this.counterValue(),10)
            if(value > 0) return false

            return true
        }
    });
});
