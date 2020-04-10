class App {

    /**
     * Array keys are 1 - 100, and is any key is null than missing value is the key.
     * @param array
     * @returns {number}
     */
    findMissingValue(array){
        for (let i = 0; i < array.length; i++) {
            if (array[i] === null) {
                return i;
            }
        }
    };

    /**
     * Create array with values from 1 - 100 and keys will be 1 -100
     * if param value is matched from 1 - 100 than value will be null
     * @param value
     * @return array
     */
    createArray = (value) => {
        const array = [];
        for (let i = 1; i <= 100; i++) {
            array[i] = null;
            if (parseInt(value) !== i) {
                array[i] = i;
            }
        }
        return array;
    };

    /**
     * check input value if empty than is not valid
     * @param input
     * @returns {boolean}
     */
    requiredValidation = (input) => {
        let value = input.val();
        if(value === "" || value === null){
            return false;
        }
    };

    /**
     * display the matched value.
     * @param element
     * @param value
     */
    displayMissingValue = (element, value) => {
        if(typeof value === "undefined" ){
            element.html(`<h1>Missing Number should be between 1 - 100</h1>`);
        }else{
            element.html(`<h1>Missing Number is ${value}</h1>`);
        }
    };

    /**
     * Function will search form for required inputs.
     * inputs validation mesasges div must have errorHelper class
     * inputs data-message is required to display the custom message
     * can be custom css for error message invalid-feedback d-block classes are required
     * can have custom css for is-invalid is required
     * @param form
     */
    validateForm = (form) => {
        const validate = this.requiredValidation;
        form.find('input').each(function () {
            if ($(this).attr('required')) {
                let errorHelper = $('.errorHelper');
                if (validate($(this)) === false) {
                    let message = $(this).attr('data-message').charAt(0).toUpperCase() + $(this).attr('data-message').slice(1);
                    errorHelper.html(`<span class="invalid-feedback d-block">${message}</span>`);
                    $(this).addClass('is-invalid');
                    return false;
                }
                $(this).removeClass('is-invalid');
                errorHelper.html("");
            }
        })
    };
}

$(document).ready(function () {
    $(document).on('click', '#submit', function () {
        const app = new App();
        let input = $('#integer');
        if (app.validateForm($(".validation-on")) === false) {
            return false;
        }
        let array = app.createArray(input.val());
        let missingValue = app.findMissingValue(array);
        app.displayMissingValue($(".message-div"), missingValue);
    });
});
