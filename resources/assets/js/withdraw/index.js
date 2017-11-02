$('.audit-confirm-btn').click(function() {
  var url = $(this).data('content-url');
  $('#audit-modal').load(url).modal();
});

