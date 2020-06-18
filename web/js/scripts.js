(function() {

    "use strict";

    var Core = {

        initialized: false,

        initialize: function() {

            if (this.initialized) return;
            this.initialized = true;

            this.build();

        },

        build: function() {

            this.initWow();
        },

        initWow: function () {
            new WOW().init();
        }
    };

    $(window).ready(function () {
        Core.initialize();
    });

})();