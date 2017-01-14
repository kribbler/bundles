jQuery(document).ready(function($) {
  $('.html-invoice').click(function (event){

    var url = $(this).attr("href");
    if ($.browser.webkit) {
      window.open(url, "Print", "width=800, height=600");
    }
    else {
      window.open(url, "Print", "scrollbars=1, width=800, height=600");
    }

    event.preventDefault();

    return false;

  });
});