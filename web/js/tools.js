function showReply(comment_id, tag_id, depth) {
  var aHref = 'href-' + comment_id;
  var objHref = $(aHref);
  var commentHolder = 'comment-' + comment_id;
  var objCommentHolder = $(commentHolder);
  var commentFormHolder = $('comment-form-' + comment_id);
  var objCommentFormHolder = $(commentFormHolder);
  csrf = document.forms['main-comment'].elements['_csrf_token'].value;
  
  if ( objCommentFormHolder ) {
    if ( objCommentFormHolder.style.display == 'none' ) {
      new Effect.BlindDown(commentFormHolder, { duration: 0.5 });
      objHref.innerHTML = 'yorum yaz';
    } 
    else {
      new Effect.BlindUp(commentFormHolder, { duration: 0.5 });
      objHref.innerHTML = 'yorum yaz';
    }
  }
  else {
    var commentForm = '<form action="\/kuyabiye\/web\/comment\/add" method="post" class="comment-reply-form" id="comment-form-' + comment_id + '">\
                          <input type="hidden" name="_csrf_token" value="' + csrf + '">\
                          <input type="hidden" name="tag" value="' + tag_id + '">\
                          <input type="hidden" name="comment_id" value="' + comment_id + '">\
                          <textarea name="body"><\/textarea>\
                          <input type="image" name="commit" src="\/kuyabiye\/web\/images\/reply-button.gif" alt="Reply-button" />\
                       <\/form>';
    new Insertion.After(commentHolder, commentForm);
    new Effect.BlindDown('comment-form-' + comment_id, { duration: 0.5 });          
    objHref.innerHTML = 'yorum yaz';
  }
}

function selectMessages(selection) {
  var checkboxes = document.getElementsByName("messages[]");
  var str = '';
  for(i=0; i < checkboxes.length; i++) {
    str = checkboxes[i].className;
    if ( str.indexOf(selection) != -1 ) {
      checkboxes[i].checked = 'checked';
    }
    else {
      checkboxes[i].checked = '';            
    }
  }         
}

function updateJSON(request, json)
{
  var nbElementsInResponse = json.length;

  for (var i = 0; i < nbElementsInResponse; i++)
  {
    Effect.Fade('message-' + json[i]);
  }
}

function checkCity(seld)
{
  var city = document.getElementById('city');
  var country = seld.options[seld.selectedIndex].value;
  
  if ( country != 'TR' )
  {
    city.selectedIndex = 0;
    city.disabled = true;
  }
  else
  {
    city.disabled = false;
  }
}

start_slideshow(1, 3, 2000);

function start_slideshow(start_frame, end_frame, delay) {
    setTimeout(switch_slides(start_frame,start_frame,end_frame, delay), delay);
}
                        
function switch_slides(frame, start_frame, end_frame, delay) {
    return (function() {
        Effect.Fade('slideshow' + frame);
        if (frame == end_frame) { frame = start_frame; } else { frame = frame + 1; }
        setTimeout("Effect.Appear('slideshow" + frame + "');", 850);
        setTimeout(switch_slides(frame, start_frame, end_frame, delay), delay + 850);
    })
}

$(document).ready(function() {
    $('#tag-slideshow').cycle({
		fx: 'scrollVert',
    height: 250,
    width: 600,
    fit: 1,
    delay: 3000
	});
});

