jQuery(document).ready(function() {
  console.log("asdf");
  var $ = jQuery;
  $(document).on("click", ".set_custom_images", function(e) {
      e.preventDefault();
      var button = $(this);
      var id = button.prev();
      wp.media.editor.send.attachment = function(props, attachment) {
          id.val(attachment.id);
      };
      wp.media.editor.open(button);
      return false;
  });
  
});
