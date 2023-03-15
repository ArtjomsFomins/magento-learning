'use strict'

define([
    'ko',
    'uiElement'
], function (ko, Element) {
    const input = document.querySelector('.counter__input');
    const button = document.querySelector('.cart__btn');
    input.addEventListener('keydown', event => {
        const codes = [
            190, // .
            69  // e (scientific notaion, 1e2 === 100)
        ]
          if (codes.includes(event.keyCode)) {
            event.preventDefault();
            return false;
          }
          return true;
        });
        input.addEventListener('input', function (e) {
            var reg = /^(?!0)[0-9]*$/;
            console.log(this.value)
            const result = this.value.match(reg)
            if (!result || result[0] === '' ) {
                this.value =  this.value.slice(0,-1)
                this.value = this.value.replace(reg, '')
            }
            const intValue = parseInt(result,10)
            if(intValue > 0) {
                button.disabled = false
            } else if(intValue === 0 || isNaN(intValue)) {
                button.disabled = true
                this.value = '0'
            }
        });
    return Element.extend({

        initObservable: function () {
            this._super()
                .observe('counterValue')
            return this
        },
        increment: function() {
            let value = this.getValue()
            value++
            this.counterValue(value)
            if(value > 0) {
                button.disabled = false
            }
        },
        getValue: function () {
            return parseInt(this.counterValue(),10)
        },
        decrement: function() {
            const value = this.getValue()
            if(value === 1) {
                button.disabled = true
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
