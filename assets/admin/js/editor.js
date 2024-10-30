"use strict";

!(function (i) {

	(window.laGetButtonWithIcon = function( view ){

        var classes, r = [];
        // var  = [];
        if( 
            (( classes = classes || {}),
            ( classes = _.defaults( classes, { // wp_parse_args()
                oldIcon: "button_icon",
                iconPos: "button_icon_position",
                newIcon: "selected_icon",
                text: "button_text",
                link: "button_link",
                class: "la-btn",
                textClass: "la-btn-text",
            })
        ),
        _.isObject(view)) ){

            var settings = view.model.attributes.settings.toJSON();

            view.addRenderAttribute( 'button', 'class', 'la-btn' );
            view.addRenderAttribute( 'button', 'id', settings.button_css_id );
            view.addRenderAttribute( 'button', 'class', 'la-btn--' + settings.style );
            view.addRenderAttribute( 'button', 'class', 'la-size-' + settings.size );
            view.addRenderAttribute( 'button', 'class', 'elementor-animation-' + settings.hover_animation );
            view.addRenderAttribute( 'button', 'href', settings.link.url );
            view.addRenderAttribute( 'button', 'role', 'button' );

            view.addRenderAttribute( classes.text, 'class', 'la-btn-text' );
            var iconHTML = elementor.helpers.renderIcon( view, settings[classes.newIcon], { 'aria-hidden': true }, 'i' , 'object' );
		    var migrated = elementor.helpers.isIconMigrated( settings, settings[classes.newIcon] );

            r.push("<div class=\"elementor-button-wrapper\">");
                r.push("<a "+ view.getRenderAttributeString('button') +">");
                    r.push("<span class=\"la-btn-content-wrapper\">");
                        if ( settings.icon || settings[classes.newIcon] ) {
                            r.push("<span class=\"la-btn-icon la-align-icon-"+ settings.icon_align +"\">");
                            if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) {
                                r.push(iconHTML.value);
                            }else{
                                r.push("<i class=\"" + settings.icon +"\" aria-hidden=\"true\"></i>");
                            }
                            r.push("</span>");
                        }
                        r.push("<span "+ view.getRenderAttributeString( classes.text ) +">"+ settings[classes.text] +"</span>");
                    r.push("</span>");
                r.push("</a>");
            r.push("</div>");

            return r.join("");
        }
	});
})(jQuery);