$('.audit-confirm-btn').click(function() {
  var url = $(this).data('content-url');
  $('#audit-pass-modal').load(url).modal();
});
