$(function() {
  // contact form animations
  $('.contact-popup').click(function() {
    $('.PopupContactForm').fadeToggle();
    $('.opaque-container').css("opacity", 0.5);
    // $('#PopupContactForm').css("opacity", 1.5);
  })
  $(document).mouseup(function (e) {
    var container = $(".PopupContactForm");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut();
    }
  });
  
});