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
            return this
        },
        increment: function() {
            const value = this.getValue()
            this.counterValue(value + 1)
            if(value > 0) {
                document.querySelector('.cart__btn').disabled = false
            }
        },
        getValue: function () {
            return parseInt(this.counterValue(),10)
        },
        decrement: function() {
            const value = this.getValue()
            if(value === 1) {
                document.querySelector('.cart__btn').disabled = true
            }
            if(value === 0) {
                return
            }
            this.counterValue(value - 1)
        },
        isOverZero: function() {
            const value = this.getValue()
            if(value > 0) return false

            return true
        }
    });
});
