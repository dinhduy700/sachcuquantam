'use strict'

// Sidebar
$(".collapsed").click(function() {
    $(this).parent().children().closest('.collapse', this).toggleClass("show");
    $(".fa-angle-down", this).toggleClass("fa-rotate-90");
});

// SidebarToggler
$('#jsSidebarToggler').on('click', function() {
    $('body').addClass('sidebar-open');
});

$('.sidebar-toggler').on('click', function() {
    $('body').removeClass('sidebar-open');
});

// Check all
$('#jsCheckAll').click(function() {
    $('input:checkbox').prop('checked', this.checked);
    countChecked();
});

function countChecked() {
    var n = $("input:checked").not('#jsCheckAll').length;

    if (n === 0) {
        $('.table-bulk-actions').removeClass('active');
    } else {
        $('.table-bulk-actions').addClass('active');
    }

    $('.count-number').text(n);
};

$('input[type=checkbox]').on('click', countChecked);

$('#jsBtnBulkAction').click(function() {
    $(this).parent().children('.dropdown-menu', this).toggleClass("show");
});

// Count String
function countString(src) {
    const limit = $(src).attr("maxlength");
    const chars = $(src).val().length;

    if (chars <= limit) {
        $(src).parent().children().closest('.form-control-character-count', src).text(`${chars} / ${limit}`);
    }
}

// Select
$('.category-list').on('click', '.category-item', function() {
    const val = $(this).text();
    const parent_id =$(this).attr('data-parent');
    const parent = $(this).attr('parent');
    if(parseInt(parent) ==0){
        $('.category-selected').children('.jsCaterogySelected').html('');
    }
    var html = '';
    var _self = this;
    $('#product_category_id').val(parent_id);
    $(_self).parent().next().closest('ul.list-group', _self).html('');
    $.ajax({  
        headers: { 'X-CSRF-TOKEN': tokenHeader },
        url:categoryUrl,  
        method:"GET",
        data: {parent_id:parent_id},  
        success: function(result){
            var result = result.data;
            console.log(result)
            var item_right = `<div class="category-item-right">
            <i class="fas fa-angle-right"></i>
          </div>`;
            $.each(result, function(k, v) {
                if(v['child_num'] < 1) item_right = '';
                html += `<li class="list-group-item category-item" data-parent="`+v['id'] +`" parent="1">
                <p class="m-0">
                  `+ v['translation'].product_category_name+`
                </p>`+ item_right +`
              </li>`;
            });
            $(_self).parent().next().closest('ul.list-group', _self).append(html);
            // console.log(html)
        },
        error: function(result) {
          console.log('ajax error');
        }
    });
    // console.log(html)
    setCategorySelected(val);
    
    // $(this).parent().next().closest('ul.list-group', this).append(html);
});

function setCategorySelected(val) {
    let fullText = $('.jsCaterogySelected:contains("'+val+'")');
    if(fullText.length === 0){
        $('.category-selected').children('.jsCaterogySelected').append(`
            <span class="cat-selected-item text-primary">
            <i class="fas fa-angle-right"></i>
            ${val}
            </span>
        `);
    }
}

$('.set-locale').on('click', function() {
    $('#locale-admin input[name="locale"]').val($(this).find('img').attr('title'));
    $('form#locale-admin').submit();
});

function swalDeleteConfirm(element, title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            element.parentNode.submit();
        }
    })
}

// Toast
$(".toast-close").click(function() {
    $(this).closest('.toast').remove();
});

setTimeout(() => {
    $('div.toast-list').remove();
}, 3000);

function initDatePicker() {
    // datepicker
    var date = new Date();

    $('.jsDatepicker').datetimepicker({
        format: 'd-m-Y H:i',
    });
}

initDatePicker();

// Scroll Div
$(window).scroll(function() {
    const scrollTop = $(this).scrollTop();
    const wrap = $('#fix-header-content');

    if (scrollTop > 54) {
        wrap.addClass("fix-div");
    } else if (scrollTop < 30) {
        wrap.removeClass("fix-div");
    }
});

// Set Navigation
setNavigation();

function setNavigation() {
    const path = window.location.origin + window.location.pathname;

    $(".nav a").each(function () {
        var href = $(this).attr('href');
        if (path.substring(0, href.length) === href) {
            $(this).closest('li').addClass('active');
            $(this).closest('.collapse').addClass('show');
            $(this).closest('.collapse').parent().closest('li').addClass('active');
        }
    });
}
