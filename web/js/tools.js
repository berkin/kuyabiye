function showReply(comment_id, tag_id, depth) {
  var aHref = 'href-' + comment_id;
  var objHref = $(aHref);
  var commentHolder = 'comment-' + comment_id;
  var objCommentHolder = $(commentHolder);
  var commentFormHolder = $('comment-form-' + comment_id);
  var objCommentFormHolder = $(commentFormHolder);
  csrf = document.forms['main-comment'].elements['_csrf_token'].value;
	document::
  
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
