var app = app || {};

(function () {
    'use strict';

    app.reloadViews = function () {
        $('[data-view]').each(function () {
            var $this = $(this);

            if (!$this.data('backbone-view')) {
                var view = $this.attr('data-view');
                var collection = $this.attr('data-collection');
                var modelId = $this.attr('data-model-id');

                if (view in app) {
                    var options = {el: this};

                    if (collection && modelId && collection in app) {
                        options.model = app[collection].get(modelId);
                    }

                    $this.data('backbone-view', new app[view](options));
                }
            }
        });
    };

    // setup
    $.ajaxSetup({ cache: false });
    Twig.setFunction('path', function (name, params) {
        return Routing.generate(name, params);
    });

    $(function () {
        app.contentView = new app.ContentView({el: $('#content')});
        app.reloadViews();
        Backbone.history.start({pushState: true, silent: true});
    })

})();
