jQuery(document).ready(function ($) {
  const updateCSS = function () {
    $("#sunset_css").val(editor.getSession().getValue());
  };

  $('#save-custom-css-form').submit(updateCSS);
});
const editor = ace.edit("customCss");
editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/css");
