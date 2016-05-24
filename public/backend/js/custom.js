/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** ******  left menu  *********************** **/
$(function () {
    $('#sidebar-menu li ul').slideUp();
    $('#sidebar-menu li').removeClass('active');

    $('#sidebar-menu li').click(function () {
        if ($(this).is('.active')) {
            $(this).removeClass('active');
            $('ul', this).slideUp();
            $(this).removeClass('nv');
            $(this).addClass('vn');
        } else {
            $('#sidebar-menu li ul').slideUp();
            $(this).removeClass('vn');
            $(this).addClass('nv');
            $('ul', this).slideDown();
            $('#sidebar-menu li').removeClass('active');
            $(this).addClass('active');
        }
    });

    $('#menu_toggle').click(function () {
        if ($('body').hasClass('nav-md')) {
            $('body').removeClass('nav-md');
            $('body').addClass('nav-sm');
            $('.left_col').removeClass('scroll-view');
            $('.left_col').removeAttr('style');
            $('.sidebar-footer').hide();

            if ($('#sidebar-menu li').hasClass('active')) {
                $('#sidebar-menu li.active').addClass('active-sm');
                $('#sidebar-menu li.active').removeClass('active');
            }
        } else {
            $('body').removeClass('nav-sm');
            $('body').addClass('nav-md');
            $('.sidebar-footer').show();

            if ($('#sidebar-menu li').hasClass('active-sm')) {
                $('#sidebar-menu li.active-sm').addClass('active');
                $('#sidebar-menu li.active-sm').removeClass('active-sm');
            }
        }
    });
});

/* Sidebar Menu active class */
$(function () {
    var url = window.location;
    $('#sidebar-menu a[href="' + url + '"]').parent('li').addClass('current-page');
    $('#sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent('li').addClass('current-page').parent('ul').slideDown().parent().addClass('active');
});

/** ******  /left menu  *********************** **/


/** ******  /switcher  *********************** **/
/** ******  collapse panel  *********************** **/
// Close ibox function
$('.close-link').click(function () {
    var content = $(this).closest('div.x_panel');
    content.remove();
});

// Collapse ibox function
$('.collapse-link').click(function () {
    var x_panel = $(this).closest('div.x_panel');
    var button = $(this).find('i');
    var content = x_panel.find('div.x_content');
    content.slideToggle(200);
    (x_panel.hasClass('fixed_height_390') ? x_panel.toggleClass('').toggleClass('fixed_height_390') : '');
    (x_panel.hasClass('fixed_height_320') ? x_panel.toggleClass('').toggleClass('fixed_height_320') : '');
    button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
    setTimeout(function () {
        x_panel.resize();
    }, 50);
});
/** ******  /collapse panel  *********************** **/
/** ******  iswitch  *********************** **/
if ($("input.flat")[0]) {
    $(document).ready(function () {
        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
}
/** ******  /iswitch  *********************** **/

/** ******  table  *********************** **/
$('table input').on('ifChecked', function () {
    check_state = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('table input').on('ifUnchecked', function () {
    check_state = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});

var check_state = '';
$('.bulk_action input').on('ifChecked', function () {
    check_state = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
    check_state = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
    check_state = 'check_all';
    countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
    check_state = 'uncheck_all';
    countChecked();
});

function countChecked() {
        if (check_state == 'check_all') {
            $(".bulk_action input[name='table_records']").iCheck('check');
        }
        if (check_state == 'uncheck_all') {
            $(".bulk_action input[name='table_records']").iCheck('uncheck');
        }
        var n = $(".bulk_action input[name='table_records']:checked").length;
        if (n > 0) {
            $('.column-title').hide();
            $('.bulk-actions').show();
            $('.action-cnt').html(n + ' Records Selected');
        } else {
            $('.column-title').show();
            $('.bulk-actions').hide();
        }
    }
    /** ******  /table  *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******  Accordion  *********************** **/

$(function () {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

/** ******  Accordion  *********************** **/
/** ******  scrollview  *********************** **/
$(document).ready(function () {
  
            $(".scroll-view").niceScroll({
                touchbehavior: true,
                cursorcolor: "rgba(42, 63, 84, 0.35)"
            });

});
/** ******  /scrollview  *********************** **/

/*******************************/
/********* DATATABLES **********/
/*******************************/
var asInitVals = new Array();
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('table.table td img').error(function(){
        $(this).attr('src','/backend/images/placeholder.png');
    });

});

function deleteItem(url, id, itemPatern, selector) {
    if (typeof selector == 'undefined')
        selector = "#tableXContent";
    if (typeof itemPatern == 'undefined') { itemPatern = "#item" };
    
    var sayOk = confirm("Bạn thực sự muốn xóa mục này?");
    if (!sayOk) return
    $.post(url+"/"+id, {
        '_method':'DELETE',
        'id': id
    },function(response){
        if (response.hasError == false) {
            $(itemPatern+id).remove();
            showFlash(response.message, "success", selector)
        } else 
            showFlash(response.message, "error", selector)
    },'json');
}
function checkStatus(url, id, itemPatern, selector) {
    if (typeof selector == 'undefined')
        selector = "#tableXContent";
    if (typeof itemPatern == 'undefined') { itemPatern = "#item" };
    var sayOk = confirm("Bạn có muốn xác nhận đã xử lý xong yêu cầu đặt vé này?");
    if (!sayOk) return
    $.get(url,function(response){
        console.log(response.hasError)
        if (response.hasError == false) {
            $(itemPatern+id).remove();
            showFlash(response.message, "success", selector)
        } else 
            showFlash(response.message, "error", selector)
    },'json');
}

function showFlash(content, type, selector) {
    if (typeof selector == 'undefined')
        selector = "#tableXContent"
    var template = '<div class="alert alert-#type#"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>#content#</div>';
    template = template.replace("#type#", type);
    template = template.replace("#content#", content);
    $(selector).prepend(template);
}
var asInitVals = new Array();
function setupDataTable($id, $options) {  
    var $default = {
        "oLanguage": {
            "sSearch": "Tìm trên tất cả các cột:"
        },
        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [0]
            } //disables sorting for column one
        ],
        'iDisplayLength': 10,
        "sPaginationType": "full_numbers",     
        "dom": 'lfrtip',
        "tableTools": {}
    }
    if (typeof $options !== 'undefined') {
        for(var i in $options) {
            $default[i] = $options[i];
        }
    }  
    var oTable = $($id).dataTable($default);
    $("tfoot input").keyup(function () {
    /* Filter on the column based on the index of this element's parent <th> */
        oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
    });
    $("tfoot input").each(function (i) {
        asInitVals[i] = this.value;
    });
    $("tfoot input").focus(function () {
        if (this.className == "search_init") {
            this.className = "";
            this.value = "";
        }
    });
    $("tfoot input").blur(function (i) {
        if (this.value == "") {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    });
    $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
}