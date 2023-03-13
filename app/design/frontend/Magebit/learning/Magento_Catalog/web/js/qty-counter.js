define([
   // "jquery",
    //'ko',
   ], function($,ko){

    /* code goes here */
    console.log("hello!!!!!!!!!!")
    class Qty {
        constructor() {
            this.input = document.querySelector(".counter__input")
            this.value = parseInt(this.input.value,10)
            console.log(this.value,'valueee')
            if(isNaN(this.value)) this.value = 0
        }

        decrement() {
            if(this.value !== 0) this.value--
            this.input.value = this.value
        }
        increment() {

            console.log(this.input)
            this.value++
            this.input.value = this.value

        }
    }
    document.querySelector(".counter__changer-minus").addEventListener("click", () => {
        const counter = new Qty()
        console.log(counter,counter.input)
        counter.decrement()
    })
    document.querySelector(".counter__changer-plus").addEventListener("click", () => {
        const counter = new Qty()
        counter.increment()
    })
});
