'use strict';

_.extend(Backbone.View.prototype, {
    render: function () {
        var templateContext = {};

        if (this.templateVariable) {
            templateContext[this.templateVariable] = this.model.toJSON();
        } else {
            templateContext = this.model.toJSON();
        }

        this._render(templateContext);

        return this;
    },

    _render: function (templateContext) {
        if (this.template) {
            this.$el.replaceWith(Twig.render(this.template, templateContext));
        }
    }
});
