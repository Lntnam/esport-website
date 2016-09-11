$.widget("custom.combobox", {
    options: {
        showAllItems: 'Show all items',
        didNotMatch: "%1 didn't match any item",
        ifInvalid: null,
    },

    _create: function () {
        // this.wrapper = $("<span>")
        //     .addClass("custom-combobox")
        //     .css("width", "100%")
        //     .insertAfter(this.element);

        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
    },

    _createAutocomplete: function () {
        var selected = this.element.children(":selected"),
            value = selected.val() ? selected.text() : "";

        this.input = $("<input>")
            //.insertAfter(this.element)
            .val(value)
            //.addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left form-control")
            .addClass("form-control")
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: $.proxy(this, "_source")
            })
            .tooltip({
                classes: {
                    "ui-tooltip": "ui-state-highlight"
                }
            })
            .insertAfter(this.element)
        ;

        this._on(this.input, {
            autocompleteselect: function (event, ui) {
                ui.item.option.selected = true;
                this._trigger("select", event, {
                    item: ui.item.option
                });
            },

            autocompletechange: "_removeIfInvalid"
        });
    },

    _createShowAllButton: function () {
        var input = this.input,
            wasOpen = false;

        $addon = $("<span>")
            .addClass("input-group-addon")
            .on("mousedown", function() {
                wasOpen = input.autocomplete("widget").is(":visible");
            })
            .on("click", function() {
                input.trigger("focus");

                // Close if already visible
                if (wasOpen) {
                    return;
                }

                // Pass empty string as value to search for, displaying all results
                input.autocomplete("search", "");
            })
            .insertAfter(this.input);
        $("<span>")
            .addClass("glyphicon glyphicon-menu-down")
            .appendTo($addon);
        // $("<a>")
        //     .attr("tabIndex", -1)
        //     .attr("title", this.options.showAllItems)
        //     .tooltip()
        //     //.appendTo(this.wrapper)
        //     .button({
        //         icons: {
        //             primary: "ui-icon-triangle-1-s"
        //         },
        //         text: false
        //     })
        //     //.removeClass("ui-corner-all")
        //     .addClass("custom-combobox-toggle ui-corner-right")
        //     .on("mousedown", function () {
        //         wasOpen = input.autocomplete("widget").is(":visible");
        //     })
        //     .on("click", function () {
        //         input.trigger("focus");
        //
        //         // Close if already visible
        //         if (wasOpen) {
        //             return;
        //         }
        //
        //         // Pass empty string as value to search for, displaying all results
        //         input.autocomplete("search", "");
        //     })
        //     .insertAfter(this.input);
    },

    _source: function (request, response) {
        var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
        response(this.element.children("option").map(function () {
            var text = $(this).text();
            if (this.value && ( !request.term || matcher.test(text) ))
                return {
                    label: text,
                    value: text,
                    option: this
                };
        }));
    },

    _removeIfInvalid: function (event, ui) {
        // Selected an item, nothing to do
        if (ui.item) {
            return;
        }

        if (this.input.val().trim() == '') {
            this.element.val("");
            return;
        }

        // Search for a match (case-insensitive)
        var value = this.input.val(),
            valueLowerCase = value.toLowerCase(),
            valid = false;
        this.element.children("option").each(function () {
            if ($(this).text().toLowerCase() === valueLowerCase) {
                this.selected = valid = true;
                return false;
            }
        });

        // Found a match, nothing to do
        if (valid) {
            return;
        }

        // Remove invalid value
        if (this.options.ifInvalid != null) {
            this.options.ifInvalid(this.input.val());
        }
        else {
            this.input
                .val("")
                .attr("title", this.options.didNotMatch.replace('%1', value))
                .tooltip("open");
            this.element.val("");
            this._delay(function () {
                this.input.tooltip("close").attr("title", "");
            }, 2500);
            this.input.autocomplete("instance").term = "";
        }
    },

    _destroy: function () {
        this.wrapper.remove();
        this.element.show();
    }
});