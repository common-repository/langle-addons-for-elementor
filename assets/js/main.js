"use strict";

(function ($) {
  "use strict";

  var $window = $(window);

  $.fn.getLangleSettings = function () {
    return this.data("langle-settings");
  };

  $window.on("elementor/frontend/init", function () {
    // var ModuleHandler = elementorModules.frontend.handlers.Base;

    var NumberHandler = function NumberHandler($scope) {
      elementorFrontend.waypoint($scope, function () {
        var $number = $scope.find(".la-number-text");
        $number.numerator($number.data("animation"));
      });
    };

    var HandleImageCompare = function HandleImageCompare($scope) {
      var $item = $scope.find(".sejs-image-comparison"),
        settings = $item.getLangleSettings(),
        fieldMap = {
          on_hover: "move_slider_on_hover",
          on_swipe: "move_with_handle_only",
          on_click: "click_to_move",
        };
      settings[fieldMap[settings.move_handle || "on_swipe"]] = true;
      delete settings.move_handle;
      $item.imagesLoaded().done(function () {
        $item.twentytwenty(settings);
        var t = setTimeout(function () {
          $window.trigger("resize.twentytwenty");
          clearTimeout(t);
        }, 400);
      });
    };

    var SkillHandler = function SkillHandler($scope) {
      elementorFrontend.waypoint($scope, function () {
        $scope.find(".la-skill-level").each(function () {
          var $current = $(this),
            $lt = $current.find(".la-skill-level-text"),
            lv = $current.data("level");
          $current.animate(
            {
              width: lv + "%",
            },
            500
          );
          $lt.numerator({
            toValue: lv + "%",
            duration: 1300,
            onStep: function onStep() {
              $lt.append("%");
            },
          });
        });
      });
    };

    var Content_Switcher = function Content_Switcher($scope) {
      var parent = $scope.find(".la-content-switcher-wrapper"),
        designType = parent.data("design-type");

      if (designType == "button" || designType == "tabbed") {
        var buttons = parent.find(".la-cs-button"),
          contents = parent.find(".la-cs-content-section");
        buttons.each(function (inx, btn) {
          $(this).on("click", function (e) {
            e.preventDefault();

            if ($(this).hasClass("active")) {
              return;
            } else {
              buttons.removeClass("active");
              $(this).addClass("active");
              contents.removeClass("active");
              var contentId = $(this).data("content-id");
              parent.find("#" + contentId).addClass("active");
            }
          });
        });
      } else {
        var toggleSwitch = parent.find(".la-cs-switch.la-input-label"),
          input = parent.find("input.la-cs-toggle-switch"),
          primarySwitcher = parent.find(".la-cs-switch.primary"),
          secondarySwitcher = parent.find(".la-cs-switch.secondary"),
          primaryContent = parent.find(".la-cs-content-section.primary"),
          secondaryContent = parent.find(".la-cs-content-section.secondary");
        toggleSwitch.on("click", function (e) {
          if (input.is(":checked")) {
            primarySwitcher.removeClass("active");
            primaryContent.removeClass("active");
            secondarySwitcher.addClass("active");
            secondaryContent.addClass("active");
          } else {
            secondarySwitcher.removeClass("active");
            secondaryContent.removeClass("active");
            primarySwitcher.addClass("active");
            primaryContent.addClass("active");
          }
        });
      }
    };

    // function handler
    var fnHanlders = {
      "la-number.default": NumberHandler,
      "la-image-compare.default": HandleImageCompare,
      "la-skill-bars.default": SkillHandler,
      "la-content-switcher.default": Content_Switcher,
    };

    $.each(fnHanlders, function (widgetName, handlerFunction) {
      elementorFrontend.hooks.addAction(
        "frontend/element_ready/" + widgetName,
        handlerFunction
      );
    });

    // Object / class handler
    // var classHandlers = {
    //   "la-image-grid.default": ImageGrid,
    // };

    // $.each(classHandlers, function (widgetName, handlerClass) {
    //   elementorFrontend.hooks.addAction(
    //     "frontend/element_ready/" + widgetName,
    //     function ($scope) {
    //       elementorFrontend.elementsHandler.addHandler(handlerClass, {
    //         $element: $scope,
    //       });
    //     }
    //   );
    // });
  });
})(jQuery);