define(function() {
    'use strict';

    /**
     * Just a convenient class for interested parties to subclass.
     *
     * The default Cell classes don't require the formatter to be a subclass of
     * Formatter as long as the fromRaw(rawData) and toRaw(formattedData) methods
     * are defined.
     *
     * @abstract
     * @export  orofilter/js/formatter/abstract-formatter
     * @class   orofilter.formatter.AbstractFormatter
     */
    var AbstractFormatter = function() {};

    AbstractFormatter.prototype = {
        /**
         * Takes a raw value from a model and returns a formatted string for display.
         *
         * @memberOf orofilter.formatter.AbstractFormatter
         * @param {*} rawData
         * @return {string}
         */
        fromRaw: function(rawData) {
            return rawData;
        },

        /**
         * Takes a formatted string, usually from user input, and returns a
         * appropriately typed value for persistence in the model.
         *
         * If the user input is invalid or unable to be converted to a raw value
         * suitable for persistence in the model, toRaw must return `undefined`.
         *
         * @memberOf orofilter.formatter.AbstractFormatter
         * @param {string} formattedData
         * @return {*|undefined}
         */
        toRaw: function(formattedData) {
            return formattedData;
        }
    };

    return AbstractFormatter;
});
