var app = app || {};

(function () {
    'use strict';

    app.ContentView = Backbone.View.extend({
        setView: function (view) {
            this.$el.empty();
            this.$el.append(view.$el);

            view.render();
        }
    });

})();
