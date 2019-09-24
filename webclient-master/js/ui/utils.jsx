var React = require("react");
var ReactDOM = require("react-dom");

var MegaRenderMixin = require("../stores/mixins.js").MegaRenderMixin;
var RenderDebugger = require("../stores/mixins.js").RenderDebugger;

/**
 * jScrollPane helper
 * @type {*|Function}
 */
var JScrollPane = React.createClass({
    mixins: [MegaRenderMixin],
    getDefaultProps: function() {
        return {
            className: "jScrollPaneContainer",
            requiresUpdateOnResize: true
        };
    },
    componentDidMount: function() {
        var self = this;
        var $elem = $(ReactDOM.findDOMNode(self));


        $elem.height('100%');

        $elem.find('.jspContainer').replaceWith(
            function() {
                var $children = $elem.find('.jspPane').children();
                if ($children.size() === 0 || $children.size() > 1) {
                    console.error(
                        "JScrollPane on element: ", $elem, "encountered multiple (or zero) children nodes.",
                        "Mean while, JScrollPane should always (!) have 1 children element."
                    );
                }
                return $children;
            }
        );

        var options = $.extend({}, {
            enableKeyboardNavigation: false,
            showArrows: true,
            arrowSize: 8,
            animateScroll: true,
            container: $('.jspContainer', $elem),
            pane: $('.jspPane', $elem)
        }, self.props.options);

        $elem.jScrollPane(options);


        if (self.props.onFirstInit) {
            self.props.onFirstInit($elem.data('jsp'), $elem);
        }
        $elem.rebind('jsp-will-scroll-y.jsp' + self.getUniqueId(), function(e) {
            if ($elem.attr('data-scroll-disabled') === "true") {
                e.preventDefault();
                e.stopPropagation();

                return false;
            }
        });

        $elem.rebind('jsp-user-scroll-y.jsp' + self.getUniqueId(), function(e, scrollPositionY, isAtTop, isAtBottom) {
            if (self.props.onUserScroll) {
                if ($(e.target).is($elem)) {
                    self.props.onUserScroll(
                        $elem.data('jsp'),
                        $elem,
                        e,
                        scrollPositionY,
                        isAtTop,
                        isAtBottom
                    );
                }
            }

            // if (e.target.className.indexOf("textarea-scroll") > -1) {
            //     return;
            // }
            //
            // if (self.lastScrollPosition === scrollPositionY || self.scrolledToBottom !== 1) {
            //     return;
            // }
            //
            // if (scrollPositionY < 350 && !isAtBottom && self.$messages.is(":visible")) {
            //     if (
            //         self.lastUpdatedScrollHeight !== $jsp.getContentHeight() &&
            //         !self.props.chatRoom.messagesBuff.messagesHistoryIsLoading() &&
            //         self.props.chatRoom.messagesBuff.haveMoreHistory()
            //     ) {
            //         self.props.chatRoom.messagesBuff.retrieveChatHistory();
            //         self.forceUpdate();
            //         self.lastUpdatedScrollHeight = $jsp.getContentHeight();
            //         self.shouldMaintainScroll = true;
            //     }
            // }
            //
            // if (isAtBottom) {
            //     self.lastScrolledToBottom = true;
            // }
            // else {
            //     self.lastScrolledToBottom = false;
            // }
            //
            // self.lastScrollHeight = $jsp.getContentHeight();
            // self.lastScrollPosition = scrollPositionY;
            // self.lastScrollPositionPerc = $jsp.getPercentScrolledY();
        });

        $elem.rebind('forceResize.jsp'+self.getUniqueId(), function(e, forced, scrollPositionYPerc, scrollToElement) {
            self.onResize(forced, scrollPositionYPerc, scrollToElement);
        });
        $(window).rebind('resize.jsp' + self.getUniqueId(), self.onResize);
        self.onResize();
    },
    componentWillUnmount: function() {
        var $elem = $(ReactDOM.findDOMNode(this));
        $elem.unbind('jsp-will-scroll-y.jsp' + this.getUniqueId());

        $(window).unbind('resize.jsp' + this.getUniqueId());
    },
    eventuallyReinitialise: function(forced, scrollPositionYPerc, scrollToElement) {
        var self = this;

        if (!self.isMounted()) {
            return;
        }
        if (!self.isComponentVisible()) {
            return;
        }

        var $elem = $(ReactDOM.findDOMNode(self));

        var currHeights = [$('.jspPane', $elem).outerHeight(), $elem.outerHeight()];

        if (forced || self._lastHeights != currHeights) {

            self._lastHeights = currHeights;

            self._doReinit(scrollPositionYPerc, scrollToElement, currHeights, forced, $elem);
        }
    },
    _doReinit: function(scrollPositionYPerc, scrollToElement, currHeights, forced, $elem) {
        var self = this;

        if (!self.isMounted()) {
            return;
        }
        if (!self.isComponentVisible()) {
            return;
        }

        self._lastHeights = currHeights;
        var $jsp = $elem.data('jsp');
        if ($jsp) {
            $jsp.reinitialise();

            var manualReinitialiseControl = false;
            if (self.props.onReinitialise) {
                manualReinitialiseControl = self.props.onReinitialise(
                    $jsp,
                    $elem,
                    forced,
                    scrollPositionYPerc,
                    scrollToElement
                );
            }

            if (manualReinitialiseControl === false) {
                if (scrollPositionYPerc) {

                    if (scrollPositionYPerc === -1) {
                        $jsp.scrollToBottom();
                    }
                    else {
                        $jsp.scrollToPercentY(scrollPositionYPerc, false);
                    }
                }
                else if (scrollToElement) {
                    $jsp.scrollToElement(scrollToElement);
                }
            }
        }
    },
    onResize: function(forced, scrollPositionYPerc, scrollToElement) {
        if (forced && forced.originalEvent) {
            forced = true;
            scrollPositionYPerc = undefined;
        }


        this.eventuallyReinitialise(forced, scrollPositionYPerc, scrollToElement);
    },
    componentDidUpdate: function() {
        this.onResize();
    },
    render: function () {
        return (
            <div {...this.props} onResize={this.onResize}>
                <div className="jspContainer">
                    <div className="jspPane">
                        {this.props.children}
                    </div>
                </div>
            </div>
        );
    }
});

/**
 * A trick copied from http://jamesknelson.com/rendering-react-components-to-the-document-body/
 * so that we can render Dialogs into the body or other child element, different then the current component's child.
 */
var RenderTo = React.createClass({
    componentDidMount: function() {
        this.popup = document.createElement("div");
        this.popup.className = this.props.className ? this.props.className : "";
        if (this.props.style) {
            $(this.popup).css(this.props.style);
        }
        this.props.element.appendChild(this.popup);
        this._renderLayer();
        if (this.props.popupDidMount) {
            this.props.popupDidMount(this.popup);
        }
    },
    componentDidUpdate: function() {
        this._renderLayer();
    },
    componentWillUnmount: function() {
        ReactDOM.unmountComponentAtNode(this.popup);
        if (this.props.popupWillUnmount) {
            this.props.popupWillUnmount(this.popup);
        }
        this.props.element.removeChild(this.popup);
    },
    _renderLayer: function() {
        ReactDOM.render(this.props.children, this.popup);
    },
    render: function() {
        // Render a placeholder
        return null;
    }

});


var EmojiFormattedContent = React.createClass({
    _eventuallyUpdateInternalState: function(props) {
        if (!props) {
            props = this.props;
        }

        assert(
            typeof(props.children) === "string",
            "EmojiFormattedContent received a non-string (got: " + typeof(props.children) + ") as props.children"
        );

        var str = props.children;
        if (this._content !== str) {
            this._content = str;
            this._formattedContent = megaChat.plugins.emoticonsFilter.processHtmlMessage(htmlentities(str));
        }
    },
    shouldComponentUpdate: function(nextProps, nextState) {
        if (!this._isMounted) {
            this._eventuallyUpdateInternalState();
            return true;
        }

        if (nextProps && nextProps.children !== this.props.children) {
            this._eventuallyUpdateInternalState(nextProps);
            return true;
        }
        else {
            return false;
        }
    },
    render: function() {
        this._eventuallyUpdateInternalState();
        
        return <span dangerouslySetInnerHTML={{__html: this._formattedContent}}></span>;
    }
});



module.exports = {
    JScrollPane,
    RenderTo,
    EmojiFormattedContent
};
