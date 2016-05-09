var options = {
                dropdowns: [
                    {id: "time_range", multiple: false, name: "Time Range", type: "dropdown"
                        , fields: [
                            {id: "any-time", text: "Any time"}
                            , {id: "last-month", text: "Last month"}
                            , {id: "last-year", text: "Last year"}
                            , {id: "user-defined", text: "Custom range", class: "user-defined",
                                inputs: [
                                    {id: "from", label: "From: ", class: "time_input"}
                                    , {id: "to", label: "To: ", class: "time_input"}
                                ]}
                        ]},
                    {id: "article_types", multiple: true, name: "Article types", type: "dropdown"
                        , fields: [
                            {id: "Research Article", text: "Research Article", selected: true}
                            , {id: "Review", text: "Review", selected: true}
                            , {id: "Best Practice", text: "Best Practice", selected: true}
                            , {id: "Book Review", text: "Book Review", selected: true}
                            , {id: "Book Review/Science in the Media", text: "Book Review/Science in the Media", selected: true}
                            , {id: "Case Report", text: "Case Report", selected: true}
                            , {id: "Collection Review", text: "Collection Review", selected: true}
                            , {id: "Community Page", text: "Community Page", selected: true}
                            , {id: "Correction", text: "Correction", selected: false}
                            , {id: "Correspondence", text: "Correspondence", selected: true}
                            , {id: "Correspondence and Other Communications", text: "Correspondence and Other Communications", selected: true}
                            , {id: "Deep Reads", text: "Deep Reads", selected: true}
                            , {id: "Editorial", text: "Editorial", selected: true}
                            , {id: "Education", text: "Education", selected: true}
                            , {id: "Essay", text: "Essay", selected: true}
                            , {id: "Expert Commentary", text: "Expert Commentary", selected: true}
                            , {id: "Expression of Concern", text: "Expression of Concern", selected: true}
                            , {id: "Feature", text: "Feature", selected: true}
                            , {id: "Formal Comment", text: "Formal Comment", selected: true}
                            , {id: "From Innovation to Application", text: "From Innovation to Application", selected: true}
                            , {id: "Guidelines and Guidance", text: "Guidelines and Guidance", selected: true}
                            , {id: "Health in Action", text: "Health in Action", selected: true}
                            , {id: "Historical and Philosophical Perspectives", text: "Historical and Philosophical Perspectives", selected: true}
                            , {id: "Historical Profiles and Perspectives", text: "Historical Profiles and Perspectives", selected: true}
                            , {id: "Interview", text: "Interview", selected: true}
                            , {id: "Journal Club", text: "Journal Club", selected: true}
                            , {id: "Learning Forum ", text: "Learning Forum ", selected: true}
                            , {id: "Message from ISCB", text: "Message from ISCB", selected: true}
                            , {id: "Neglected Diseases", text: "Neglected Diseases", selected: true}
                            , {id: "Obituary", text: "Obituary", selected: true}
                            , {id: "Opinion", text: "Opinion", selected: true}
                            , {id: "Overview", text: "Overview", selected: true}
                            , {id: "Pearls", text: "Pearls", selected: true}
                            , {id: "Perspective", text: "Perspective", selected: true}
                            , {id: "Photo Quiz", text: "Photo Quiz", selected: false}
                            , {id: "Policy Forum", text: "Policy Forum", selected: true}
                            , {id: "Policy Platform", text: "Policy Platform", selected: true}
                            , {id: "Primer", text: "Primer", selected: true}
                            , {id: "Quiz", text: "Quiz", selected: false}
                            , {id: "Research in Translation", text: "Research in Translation", selected: true}
                            , {id: "Research Matters", text: "Research Matters", selected: true}
                            , {id: "Retraction", text: "Retraction", selected: false}
                            , {id: "Special Report", text: "Special Report", selected: true}
                            , {id: "Student Forum", text: "Student Forum", selected: true}
                            , {id: "Symposium", text: "Symposium", selected: true}
                            , {id: "Synopsis", text: "Synopsis", selected: false}
                            , {id: "The PLoS Medicine Debate", text: "The PLoS Medicine Debate", selected: true}
                            , {id: "Topic Page", text: "Topic Page", selected: true}
                            , {id: "Unsolved Mystery", text: "Unsolved Mystery", selected: true}
                            , {id: "Viewpoints ", text: "Viewpoints ", selected: true}

                        ]},
                    , {id: "journals", multiple: true, name: "Journals", type: "dropdown"
                        , fields: [
                            {id: "PLoSONE", text: "PLOS ONE", selected:true}
                            , {id: "PLoSGenetics", text: "PLOS Genetics", selected:true}
                            , {id: "PLoSPathogens", text: "PLOS Pathogens", selected:true}
                            , {id: "PLoSCompBiol", text: "PLOS Computational Biology", selected:true}
                            , {id: "PLoSNTD", text: "PLOS Neglected Tropical Diseases", selected:true}
                            , {id: "PLoSBiology", text: "PLOS Biology", selected:true}
                            , {id: "PLoSMedicine", text: "PLOS Medicine", selected:true}
                            , {id: "PLoSClinicalTrials", text: "PLOS Hub for Clinical Trials", selected:true}
                        ]}
                ]}

var SearchOptions = {
    user_defined_date: false,
    init: function (tag, data) {

        var self = this;

        self.drawOptions(tag, data);

    },
    drawOptions: function (tag, data) {
        var self = this;

        var div = d3.select(tag).append('div')
                .attr("id", "filter-btn")
                .attr("class", "divity")

        div.append('a')
                .attr("href", "#")
                .attr("class", "frontend-btn")
                .text("Options")

        var filters = d3.select(tag).append('div')
                .attr('id', 'filters')
                .attr('class', 'divity frontend-hidden')
        
        d3.select(tag).append('div')
                .attr('id', 'input-container')
                .attr('class', 'divity frontend-hidden')

        data.dropdowns.forEach(function (entry) {

            if (entry.type == "input") {
                var new_input = filters.insert("div", "#input-container")
                                        .attr("class", entry.class)
                            
                new_input.append("label")
                            .attr("for", entry.id)
                            .text(entry.label)
                            .style("margin-left", "8px")
                    
                new_input.append("input")
                                    .attr("id", entry.id)
                                    .attr("name", entry.id)
                                    .attr("type", "text")
                                    .attr("size", "5")
                                    .attr("value", entry.value)
                    
            } else if (entry.type = "dropdown") {

                var new_select = filters
                        .insert('select', "#input-container")
                        .attr("id", entry.id)
                        .style("width", "350px")
                        .style("overflow", "auto")
                        .attr("class", "dropdown_multi_" + entry.id)
                        .style("vertical-align", "top")
                        .attr("name", entry.id)

                if (entry.multiple) {
                    new_select.attr("name", entry.id + "[]")
                    new_select.attr("multiple", "multiple")
                }

                entry.fields.forEach(function (option) {
                    var current_option = new_select
                            .append('option')
                            .attr("value", option.id)
                            .text(option.text);

                    if (option.selected) {
                        current_option.attr("selected", "");
                    }

                    if (option.inputs != null) {
                        option.inputs.forEach(function (input) {
                            d3.select("#input-container")
                                    .append("label")
                                    .attr("for", input.id)
                                    .text(input.label)
                                    .style("margin-left", "8px")

                            d3.select("#input-container")
                                    .append("input")
                                    .attr("id", input.id)
                                    .attr("name", input.id)
                                    .attr("class", input.class)
                                    .attr("type", "text")
                                    .attr("size", "15")
                            
                            d3.select("#input-container")
                                    .append("br");
                        })
                    }
                })
            }
        })
        /*filters.append("div")
                .attr("class", "submit-btn")
                .append("a")
                .attr("id", "submit-btn")
                .attr("href", "#")
                .attr("class", "frontend-btn")
                .style("vertical-align", "middle")
                .text("Submit");

        /*d3.select(tag).append("div")
                .attr("id", "stats")
                .attr("class", "divity")
                .html("<p>Loading...</p>")*/

        $("#filter-btn").click(function () {
            $("#filters").toggleClass("frontend-hidden");
            //$("#stats").toggleClass("frontend-hidden");
            $(".frontend-btn").toggleClass("filter-btn-highlight")

            var closed = $("#filters").css("display") == "none";

            if (closed) {
                $("#input-container").css("display", "none");
            } else if (self.user_defined_date) {
                $("#input-container").css("display", "block");
            }

        });

    },
    select_multi: function (dropdown_class, entity) {

        var self = this;

        $(function () {
            $(dropdown_class).multiselect({
                allSelectedText: "All " + entity
                , nonSelectedText: "No " + entity
                , nSelectedText: entity
                , buttonWidth: '150px'
                , numberDisplayed: 2
                , maxHeight: 250
                , onChange: function (element, checked) {
                    if (checked === true) {

                        if (element.val() !== "user-defined") {
                            self.user_defined_date = false;
                            d3.select("#input-container").style("display", "none");
                        } else {
                            self.user_defined_date = true;
                            d3.select("#input-container").style("display", "block");
                        }

                        self.setDateRangeFromPreset("#from", "#to", element.val());
                    }
                }
            });

        })
    },
    setDateRangeFromPreset: function (from, to, val) {
        var self = this;

        var start = new Date();
        var end = new Date();
        end.setHours(start.getHours() + (start.getTimezoneOffset() / 60) * -1);

        switch (val) {

            case "user-defined":
                self.user_defined_date = true;
                d3.select("#input-container").style("display", "block");
                break;

            case "any-time":
                start.setTime(0);
                this.setDateFields(from, to, start, end);
                break;

            case "last-month":
                start.setMonth(end.getMonth() - 1);
                this.setDateFields(from, to, start, end);
                break;

            case "last-year":
                start.setFullYear(end.getFullYear() - 1);
                this.setDateFields(from, to, start, end);
                break;

            default:
                break;
        }
    },
    setDateFields: function (from, to, start, end) {
        Date.prototype.yyyymmdd = function () {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
            var dd = this.getDate().toString();
            return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]); // padding
        };

        $(from).datepicker("setDate", start);
        $(to).datepicker("setDate", end);
    },
    initDateFields: function (from, to) {
        setDateFields(from, to);
    },
    addDatePickerFromTo: function (from, to, init_time_range) {

        var self = this;
        
        var time_delay = "";
        
        if (init_time_range == null) {    
            init_time_range = "any-time";
        }
        
        switch(init_time_range) {
            case "any-time":
                time_delay = "-1y";
                break;

            case "last-month":
                time_delay = "-1m";
                break;

            case "last-year":
                time_delay = "-1y";
                break;

            default:
                time_delay = new Date(1970, 0, 1, 0, 0, 0, 0);
                break;
        }

        $(function () {
            $(from).datepicker({
                defaultDate: time_delay,
                changeMonth: true,
                numberOfMonths: 3,
                dateFormat: 'yy-mm-dd',
                onClose: function (selectedDate) {
                    $(to).datepicker("option", "minDate", selectedDate);
                }
            });
            $(to).datepicker({
                changeMonth: true,
                numberOfMonths: 3,
                dateFormat: 'yy-mm-dd',
                onClose: function (selectedDate) {
                    $(from).datepicker("option", "maxDate", selectedDate);
                }
            });

            self.setDateRangeFromPreset("#from", "#to", init_time_range);

        });
    }
};