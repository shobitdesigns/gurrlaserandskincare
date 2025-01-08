(function ($) {

  const wdtBeforeAfterSlideWidgetHandlers = function($scope, $) {

    $(window).on('load', function() {
    // Center the slider button on load
    $scope.find(".wdt-slider-button").css("left", `calc(50% - 0px)`);
});

var element_scope = $scope.find('.wdt-before-after-slider-container');

$.each(element_scope, function() {
    var element = $(this);
    var element_div = element.find('input');
    var element_id = element_div.attr('id');

    // Listen for input or change events on the range slider
    $scope.find("#" + element_id).on("input change", function(e) {
        const BeforeAfterSlider = e.target.value;
        // Update the width of the foreground image and slider button position
        element.find(".wdt-foreground-img").css("clip-path", `inset(0 0 0 ${BeforeAfterSlider}%)`);
        element.find(".wdt-slider-button").css("left", `${BeforeAfterSlider}%`); // Adjust -10px as per button size
    });

    // Add drag functionality to the slider button
    // element.find(".wdt-slider-button").draggable({
    //     axis: "x",
    //     containment: "parent",
    //     drag: function(event, ui) {
    //         // Calculate the new slider value based on the position of the slider button
    //         var sliderValue = ui.position.left / $(this).parent().width() * 100;
    //         // Update the width of the foreground image and slider button position during drag
    //         element.find(".wdt-foreground-img").css("clip-path", `inset(0 0 0 ${sliderValue}%)`);
    //         element.find(".wdt-slider-button").css("left", `calc(${sliderValue}% - 10px)`); // Adjust -10px as per button size
    //     }
    // });
});

return wdtBeforeAfterSlideWidgetHandlers;

  }

  $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wdt-before-after-slider.default', wdtBeforeAfterSlideWidgetHandlers);
  });

})(jQuery);