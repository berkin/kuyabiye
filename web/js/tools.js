function showReply(comment_id, depth) {
  var aHref = 'href-' + comment_id;
  var objHref = $(aHref);
  var commentHolder = 'comment-' + comment_id;
  var objCommentHolder = $(commentHolder);
  var commentFormHolder = $('comment-form-' + comment_id);
  var objCommentFormHolder = $(commentFormHolder);
  
  if ( objCommentFormHolder ) {
    if ( objCommentFormHolder.style.display == 'none' ) {
      new Effect.BlindDown(commentFormHolder, { duration: 0.5 });
      objHref.innerHTML = 'Close';
    } 
    else {
      new Effect.BlindUp(commentFormHolder, { duration: 0.5 });
      objHref.innerHTML = 'Reply';
    }
  }
  else {
    var commentForm = '<div class="comment indent-' + depth + '" id="comment-form-' + comment_id + '">\
                         <div class="comment-form">\
                           <input type="hidden" name="comment_id" value="' + comment_id + '">\
                           <textarea name="body' + comment_id + '"><\/textarea>\
                         <\/div>\
                         <input type="submit" name="add_comment" value="Send!" \/>\
                       <\/div>';
    new Insertion.After(commentHolder, commentForm);
    new Effect.BlindDown('comment-form-' + comment_id, { duration: 0.5 });          
    objHref.innerHTML = 'Close';
  }
}
