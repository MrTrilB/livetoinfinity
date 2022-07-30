(function ($) {
  "use strict";

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  jQuery(document).ready(function ($) {
    /*faq tab accordion*/
    var wb_ads_elmt = document.getElementsByClassName("wb-ads-accordion");
    var k;
    var wb_ads_elmt_len = wb_ads_elmt.length;
    for (k = 0; k < wb_ads_elmt_len; k++) {
      wb_ads_elmt[k].onclick = function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        }
      };
    }

    $("#wb_ads_rotator_activity_type").selectize({
      placeholder: "-- choose a activity type --",
      plugins: ["remove_button"],
    });

    $("#wb_ads_rotator_activity_position").selectize({
      placeholder: "-- choose a activity position --",
      plugins: ["remove_button"],
    });

    $("#wb_ads_rotator_to_whom_device").selectize({
      placeholder: "-- choose a condition --",
      plugins: ["remove_button"],
    });

    $("#wb_ads_rotator_to_whom_visitor").selectize({
      placeholder: "-- choose a condition --",
      plugins: ["remove_button"],
    });

    $("#wb-ad-rotator-container-id").keyup(function () {
      var Text = $(this).val();
      Text = Text.toLowerCase();
      Text = Text.replace(/[^a-zA-Z0-9]+/g, "-");
      $("#wb-ad-rotator-container-id").val(Text);
    });

    $("#wb-ad-rotator-container-class").keyup(function () {
      var Text = $(this).val();
      Text = Text.toLowerCase();
      Text = Text.replace(/[^a-zA-Z0-9]+/g, "-");
      $("#wb-ad-rotator-container-class").val(Text);
    });

    $(document).ready(function () {
      $('input[type="radio"]').click(function () {
        var inputValue = $(this).attr("value");
        if (inputValue === "plain-text-and-code") {
          $(".plain-text-and-code").show(500);
          $(".rich-content").hide(500);
          $(".image-ad").hide(500);
        }
        if (inputValue === "rich-content") {
          $(".plain-text-and-code").hide(500);
          $(".rich-content").show(500);
          $(".image-ad").hide(500);
        }
        if (inputValue === "image-ad") {
          $(".plain-text-and-code").hide(500);
          $(".rich-content").hide(500);
          $(".image-ad").show(500);
        }
      });
    });
    $(".wb_ads_enable").click(function (e) {
      var datanotice = $(this).data("ads");
      var datanoticevisible = $(this).data("ads-visible");
      var data = {
        action: "wb_ads_rotator_enable",
        visible: datanoticevisible,
        datanotice: datanotice,
        nonce: ajax.nonce,
      };
      $.post(ajaxurl, data, function (response) {
        location.reload();
      });
    });
    $("#wb_ads_rotator_remove_image").click(function (e) {
      var image_id = $(this).data("img-id");
      var data = {
        action: "wb_ads_rotator_remove_image",
        img_id: image_id,
        nonce: ajax.nonce,
      };
      $.post(ajaxurl, data, function (response) {
        $("#wb-ads-preview-images").attr("src", response);
        $(".wb_ads_rotator_image").attr("value", "");
        $("#wb_ads_image_id").attr("value", "0");
        $("#wb_ads_image_width").attr("value", "");
        $("#wb_ads_image_height").attr("value", "");
      });
    });
    /**
     * Image ad uploader
     */
    $(document).on(
      "click",
      ".select-ads-image #wb_ads_rotator_select_image",
      function (e) {
        e.preventDefault();

        var button = $(this);
        // WP 3.5+ uploader
        var file_frame;
        window.formfield = "";
        // If the media frame already exists, reopen it.
        if (file_frame) {
          // file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
          file_frame.open();
          return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
          id: "advads_type_image_wp_media",
          title: "Select or Upload Image",
          button: {
            text: "Insert this media",
          },
          library: {
            type: "image",
          },
          multiple: false, // only allow one file to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on("select", function () {
          var selection = file_frame.state().get("selection");
          selection.each(function (attachment, index) {
            attachment = attachment.toJSON();
            if (0 === index) {
              // place first attachment in field
              $("#wb_ads_image_id").val(attachment.id);
              $(
                '.wb_ads_rotator-input input[name="wb_ads_rotator[size][width]"]'
              ).val(attachment.width);
              $(
                '.wb_ads_rotator-input input[name="wb_ads_rotator[size][height]"]'
              ).val(attachment.height);
              // update image preview
              var new_image =
                '<img width="' +
                attachment.width +
                '" height="' +
                attachment.height +
                '" title="' +
                attachment.title +
                '" alt="' +
                attachment.alt +
                '" src="' +
                attachment.url +
                '" id="wb-ads-preview-images"/>';
              $("#wb-ads-preview-image").html(new_image);
              $(".wb_ads_rotator_image").attr("value", attachment.url);
              $("#wb_ads_rotator_remove_image").attr(
                "data-img-id",
                attachment.id
              );
            }
          });
        });

        // Finally, open the modal
        file_frame.open();
      }
    );

    $(document).on("click", ".shortcode-copy", function (e) {
      e.preventDefault();
      var copyText = $(this).data("shortcode");
      document.addEventListener(
        "copy",
        function (e) {
          e.clipboardData.setData("text/plain", copyText);
          e.preventDefault();
        },
        true
      );

      document.execCommand("copy");
      var tooltip = $(this).next();
      tooltip.removeClass("shortcode-text-hide");
      setTimeout(function () {
        tooltip.addClass("shortcode-text-hide");
      }, 500);
    });
    function myFunction() {
      var text = jQuery("#wb-ad-rotator-content-plain").val();
      return text;
    }
    if (jQuery("#wb-ad-rotator-content-plain").length) {
      var code = wp.codeEditor.initialize(
        $("#wb-ad-rotator-content-plain"),
        cm_settings
      );
    }
    $(document).keyup("#wb-ad-rotator-content-plain", function (e) {
      var x = code.codemirror.getValue();
      var enabled_php = jQuery("#wb-ad-rotator-allow-php").prop("checked");
      var enabled_sc = jQuery("#wb-ad-rotator-allow-shortcode").prop("checked");
      if (enabled_php && !/\<\?php/.test(x)) {
        $(".wb_ads_rotator-wrapper #wb-ad-rotator-allow-php-warning").show(200);
      } else {
        $(".wb_ads_rotator-wrapper #wb-ad-rotator-allow-php-warning").hide(200);
      }

      if (enabled_sc && !/\[[^\]]+\]/.test(x)) {
        $(
          ".wb_ads_rotator-wrapper #wb-ad-rotator-allow-shortcode-warning"
        ).show(200);
      } else {
        $(
          ".wb_ads_rotator-wrapper #wb-ad-rotator-allow-shortcode-warning"
        ).hide(200);
      }
    });
    var texts = myFunction();
    var enabled_php = jQuery("#wb-ad-rotator-allow-php").prop("checked");
    var enabled_sc = jQuery("#wb-ad-rotator-allow-shortcode").prop("checked");
    if (enabled_php && !/\<\?php/.test(texts)) {
      $(".wb_ads_rotator-wrapper #wb-ad-rotator-allow-php-warning").show(200);
    } else {
      $(".wb_ads_rotator-wrapper #wb-ad-rotator-allow-php-warning").hide(200);
    }
    if (enabled_sc && !/\[[^\]]+\]/.test(texts)) {
      $(".wb_ads_rotator-wrapper #wb-ad-rotator-allow-shortcode-warning").show(
        200
      );
    } else {
      $(".wb_ads_rotator-wrapper #wb-ad-rotator-allow-shortcode-warning").hide(
        200
      );
    }

    $(document).on("click", ".ads-copy", function (e) {
      e.preventDefault();
      var copyText = $(this).data("code");
      document.addEventListener(
        "copy",
        function (e) {
          e.clipboardData.setData("text/plain", copyText);
          e.preventDefault();
        },
        true
      );

      document.execCommand("copy");
      var tooltip = $(this).next();
      tooltip.removeClass("shortcode-text-hide");
      setTimeout(function () {
        tooltip.addClass("shortcode-text-hide");
      }, 500);
    });
  });
})(jQuery);
