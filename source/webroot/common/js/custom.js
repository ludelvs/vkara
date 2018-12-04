function checkEventComment(mixiEventId, mixiCommunityId) {
  var url = '/event_comment_check.html';

  $.post(
    url,
    {'mixiEventId' : mixiEventId, 'mixiCommunityId' : mixiCommunityId},
    function(data) {

      $('#eventLink' + mixiEventId).html(data);
    });
}

function updateEventStatusType(mixiEventId, eventStatusType) {
  var url = '/event_status_type_update.html';
  loading('before');

  $.post(
    url,
    {'mixiEventId' : mixiEventId, 'eventStatusType' : eventStatusType},
    function(data) {

      $('#mixiEventList').html(data);
      loading('after');
    });
}

function loading(division) {
  if (division == 'before') {
    $("#loading").attr('style','display: block');
    $("#loading_background").attr('style','display: block');
    $("#loading").html('<img src="/common/images/loading.gif" width="50" height="50" alt="Now Loading..." />');

    $("#loading_background").animate(
      {
        height: document.documentElement.scrollHeight,
        width: document.documentElement.scrollWidth
      },
      0
    );
  } else {
    $("#loading").attr('style','display: none');
    $("#loading_background").attr('style','display: none');
  }
}

function changeEventStatusType() {
  var url = '/event_list.html';

  loading('before');

  $.post(
    url,
    {'eventStatusType' : $("#event_status_type").val(), 'selectFlag' : true},
    function(data) {

      $('#mixiEventList').html(data);
      loading('after');
    });
}

function deleteEvent(mixiEventId, eventStatusType) {
  var url = '/event_delete.html';
  loading('before');
  $.post(
    url,
    {'mixiEventId' : mixiEventId, 'eventStatusType' : eventStatusType},
    function(data) {

      $('#mixiEventList').html(data);
      loading('after');
    });
}

function changeEventId(url) {
  loading('before');
  $.post(
    url,
    {'eventId' : $("#event_id").val(), 'selectFlag' : true},
    function(data) {

      $('#contents').html(data);
      loading('after');
    });
}

function popupEventDetail(eventId) {
  var url = '/event_detail.html/eventId/' + eventId;

  $.get(url, function(data) {
    if (data != '') {
      $('.event_detail').html(data);
      $('.event_detail').css('left', $(window).width() / 2 - $('.event_detail').width() / 2);
      $('.event_detail').css('top', $(window).height() / 2 - $('.event_detail').height() / 2);
      $('.event_detail').fadeIn('slow');
    }
  });
}

function closePopup() {
  $('.overlay').css('display', 'none');
  $('.event_detail').fadeOut('slow', function() {

  });
}
