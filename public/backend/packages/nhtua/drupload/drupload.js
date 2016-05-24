

var isAdvancedUpload = function() {
  var div = document.createElement('div');
  return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
};
var FPR = 5; //File per request
var FIELD_NAME = 'file';
var ACTION = $('.add-item').find('input.drupload_action').val();
var METHOD = 'POST';
var DELETE_URL = $('.add-item').find('input.drupload_delete').val();
var UPDATE_URL = $('.add-item').find('input.drupload_update').val();
$(function(){

  var $tool = $('.add-item');
  var droppedFiles = false;
  $tool.click(function(e){
    e.preventDefault();
    $('input.drupload_files').trigger('click');
  });
  $('input.drupload_files').change(function(e){
    var selectedFiles = document.querySelector('input.drupload_files').files;
    createPreviewItem(selectedFiles, $tool);
    doUpload(selectedFiles, $tool);
  });
  if ( !isAdvancedUpload() ) {
    $tool.append('<p>Trình duyệt không hỗ trợ kéo thả. Vui lòng click vào dấu [+] để chọn file.<p>')
  } else {
    $tool.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
      e.preventDefault();
      e.stopPropagation();
    })
    .on('dragover dragenter', function() {
      $tool.addClass('is-dragover');
    })
    .on('dragleave dragend drop', function() {
      $tool.removeClass('is-dragover');
    })
    .on('drop', function(e) {
      droppedFiles = e.originalEvent.dataTransfer.files;
      createPreviewItem(droppedFiles, $tool);
      $tool.trigger('submit');
    });
    $tool.on('submit', function(e) {
      e.preventDefault();
      doUpload(droppedFiles ,$tool);
    });
  }
  $(document).on('click', '.item-delete', function(e){
    e.preventDefault();
    var confirm = window.confirm('Bạn thực sự muốn xóa item này?');
    if (!confirm)
      return;
    var $tool =  $(this).parents('div.item');
    var remoteId = $tool.attr('remote-id');
    if (typeof remoteId !== 'undefined') {
      $.ajax({
        url: DELETE_URL+'/'+remoteId,
        type: 'POST',
        data: {'id':remoteId,'_method':'DELETE'},
        dataType: 'json',
        success: function(json){
          if(json.status == 'error') {
            $tool.find('.view-first .mask p').text(json.message);
            $tool.addClass('is-error'); 
          } else {
            $tool.animate({width: '0px',height: '0px'}, 200, 'linear', function(){
              $tool.remove();
            });
          }
        },
        error: function(xhr, statusText, errorThrown){          
          $tool.find('.view-first .mask p').text(errorThrown);
          $tool.addClass('is-error'); 
        }
      });
    }
  });
  $(document).on('click','.item-edit', function(e){
    e.preventDefault();
    var data = $(this).parents('div.item').find('input.hidden-data').val();
    openItemDetail(data);
  });
  $('#updateItemDetail').click(function(){
    updateItemDetail();
  });
});

/**
 * Generate random string.
 * @param Integer len; Length of string
 * @return String;
 * @author Roger Knapp
 * @refer http://stackoverflow.com/a/1349426/1235074
 */
function nhtRandomID(len)
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < len; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function createPreviewItem(droppedFiles, $tool) {
  $.each(droppedFiles, function (index, file) { 
    if (!file.type.match(/image.*/)) 
      return;
    var $tmp = $('.item-template').clone();
    $tmp.removeClass('item-template');
    var img = document.createElement('img');
    img.onload = function () {
        window.URL.revokeObjectURL(this.src);
    };
    img.src = window.URL.createObjectURL(file);
    $tmp.find('img').replaceWith(img);
    $tmp.find('.item-title').text(file.name);
    var rand = nhtRandomID(4);
    droppedFiles[index].localId = rand;
    $tmp.attr('local-id', rand);
    $tmp.attr('remote-id', '');

    $tool.parent().before($tmp);
  });
}
function doUpload(droppedFiles, $tool) {
  if ($tool.hasClass('is-uploading')) return false;      
  $tool.addClass('is-uploading');
  if (isAdvancedUpload) {
    var ajaxData = new FormData();
    if (droppedFiles) {
      $.each( droppedFiles, function(i, file) {
        if (!file.type.match(/image.*/)) 
          return;
        ajaxData.append( FIELD_NAME, file );
        ajaxData.append('type', $('#Article_type').val() );  
        ajaxData.append('article_id', $('#ArticleForm input[name=id]').val());
        $('.item[local-id="'+file.localId+'"]').addClass('is-uploading');       
        $.ajax({
          url: ACTION,
          type: METHOD,
          data: ajaxData,
          dataType: 'json',
          cache: false,
          contentType: false,
          processData: false,
          complete: function() {
            $tool.removeClass('is-uploading');
            console.log(file.localId);
            $('.item[local-id="'+file.localId+'"]').removeClass('is-uploading');
          },
          success: function(data) {
            if (data.status == 'error') {
              $('.item[local-id="'+file.localId+'"] .view-first .mask p').text(data.error);
              $('.item[local-id="'+file.localId+'"]').addClass('is-error');                
            } else {
              $('.item[local-id="'+file.localId+'"]').attr('remote-id',data.data.id);
              $('.item[local-id="'+file.localId+'"] input.hidden-data').val(JSON.stringify(data.data));
            }
          },
          error: function(xhr, status, errorText) {
            // Log the error, show an alert, whatever works for you
          },
          xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;                      
                $('.item[local-id="'+file.localId+'"] .view-first .mask').css({width:percentComplete*100+"%"});
              }
            }, false);

            xhr.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                //Do something with download progress
              }
            }, false);

            return xhr;
          },
        });
      });
    }
  } else {
    // ajax for legacy browsers
  }
}

function openItemDetail(dataStr) {
  var data = JSON.parse(dataStr);
  var modal = $('.gallery-item-detail');
  modal.find('#myModalLabel').text(data.title);
  modal.find('div.message').html('');
  var form = document.getElementById('galleryItemDetail');
  form.reset();
  $(form).find('img').attr('src',data.url);
  $(form).find('input[name="item_id"]').val(data.id);
  $(form).find('input[name="item_title"]').val(data.title);
  $(form).find('input[name="item_link"]').val(data.link_to);
  $(form).find('textarea[name="item_content"]').val(data.content);
  modal.modal();
}

function updateItemDetail() {
  var modal = $('.gallery-item-detail');
  modal.find('div.message').html('');
  var tmp = '<div class="alert alert-#status#" role="alert">#message#</div>';
  $.ajax({
    url: UPDATE_URL,
    type: 'POST',
    data: $('#galleryItemDetail').serialize(),
    dataType: 'json',
    success: function(json){
      if(json.status == 'error') {
        tmp = tmp.replace('#status#','danger');
        tmp = tmp.replace('#message#',json.message);
        modal.find('div.message').html(tmp);
      } else {
        tmp = tmp.replace('#status#','success');
        tmp = tmp.replace('#message#',json.message);
        modal.find('div.message').html(tmp);
        $('.item[remote-id="'+json.data.id+'"] input.hidden-data').val(JSON.stringify(json.data));
      }
    },
    error: function(xhr, statusText, errorThrown){          
      tmp = tmp.replace('#status#','danger');
      tmp = tmp.replace('#message#', errorThrown);
      modal.find('div.message').html(tmp);
    }
  });
}