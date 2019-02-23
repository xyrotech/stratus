/**
 * Created by kadelakun on 3/29/2017.
 */

// Bootstrap tooltip initalization
$('.copy').tooltip({
    trigger: 'click',
    placement: 'right'
});

// Clipboard ----------------------------

function setTooltip(share, message) {
    $(share).tooltip('hide')
        .attr('data-original-title', message)
        .tooltip('show');
}

function hideTooltip(share) {
    setTimeout(function() {
        $(share).tooltip('hide');
    }, 1000);
}

var clipboard = new Clipboard('.copy');

clipboard.on('success', function(e) {
    setTooltip(e.trigger, 'Copied!');
    hideTooltip(e.trigger);
});

clipboard.on('error', function(e) {
    setTooltip(e.trigger, 'Failed!');
    hideTooltip(e.trigger);
});
// --------------------------------------


function sharing(id){
    var $slider = $('#cmn-toggle-' + id);

    if($slider.is(':checked')){
        $slider.attr("disabled", true);
        $('.shared-' + id).show("fade",500, function(){
            $slider.removeAttr("disabled");
        });

    } else{
        $slider.attr("disabled", true);
        $('.shared-' + id).hide("fade",500, function(){
            $slider.removeAttr("disabled");
        });
    }
}

function doubleCheck(id,filename) {
    swal({
        title: "Are you sure you want to delete " + "<span class=\"text-primary\" style=\"word-wrap:break-word\">" + filename +"</span>?",
        html:  "You will not be able to recover this File!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }).then(
        function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("[name='_token']").val()
                }
            })

            $.ajax({
                url: '/file/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    swal({
                        title: data['title'],
                        html: data['text'],
                        type: data['type'],
                        timer: 5000,
                        allowOutsideClick: false,
                    }).then(function(){
                        if(data['type'] != 'error') {
                            setTimeout(location.reload.bind(location), 500);
                        }
                    },function(dismiss){
                        if (dismiss === 'timer' && data['type'] != 'error') {
                            setTimeout(location.reload.bind(location), 500);
                        }
                    });
                },
                error: function (data) {
                    swal({
                        title: 'An error occured, please try again! ',
                        html: 'Click ok to refresh the page.',
                        type: 'error',
                        timer: 5000,
                        allowOutsideClick: false,
                    }).then(function(){
                        setTimeout(location.reload.bind(location), 500);
                    });
                }
            });
        });

}

$(function () {

    $.fn.modal.Constructor.prototype.enforceFocus = function() {};

    $('.modal.fade').on('hidden.bs.modal', function () {
        var id = $(this).attr('id').substr(6);

        if(!$("[name='share_link-" + id + "']").length){
            $('#cmn-toggle-' + id).attr('checked', false);
        }else{
            $('#cmn-toggle-' + id).prop('checked', true);
        }
        $('#form-errors-' + id).empty();
    });

    $('.input-group.date').datepicker({
        startDate: "03/01/2017",
        maxViewMode: 0,
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });

    Dropzone.options.shuttle = {
        paramName: "payload",
        maxFilesize: 10000,

        previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n   <div class=\"dz-details\">\n    " +
            "<div class=\"dz-size\"><span data-dz-size></span></div>\n " +
            "<div class=\"dz-filename\"><span data-dz-name></span></div>\n " +
            "<div class=\"dz-precentage\" data-dz-precentage>" +
            "</div>\n </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  " +
            "<span class='progress-text'></span>" +
            "<div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n  <div class=\"dz-success-mark\">\n    " +
            "",
        uploadprogress: function(file, progress, bytesSent) {
            var progressElement = file.previewElement.querySelector("[data-dz-uploadprogress]");
            progressElement.style.width = progress + "%";
            $(".progress-text").text(Math.round(progress) + "%");
        },
        dictDefaultMessage: 'Click here or Drop files to upload.',

        init: function() {
            this.on("success", function(file,data) {
                swal({
                    title: data['title'],
                    html: data['text'],
                    type: data['type'],
                    allowOutsideClick: false,
                }).catch(swal.noop);
            });
            this.on("error", function(file) {
                swal({
                    title: 'An error occured!',
                    text: 'Please check the file and try again.',
                    type: 'error',
                    allowOutsideClick: false,
                }).catch(swal.noop);
                this.removeFile(file);
            });
        }

    }

    $('[data-tooltip="tooltip"]').tooltip({
        trigger : 'hover'
    })
})

// Closes the sidebar menu
$("#menu-close").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});

// Opens the sidebar menu
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});

// Displays Save button if changes have been made to properties
function showSave(id,name){
    var $slider = $('#cmn-toggle-' + id);

    if($('#name-' + id).val().match(/\/|\\/g)){
        $('#name-' + id).val($('#name-' + id).val().replace(/\/|\\/g, ""));
    }else{
        if($('#name-' + id).val() != name){
            $('#btnSubmit-' + id).show("fade",500);
        }else if(!$slider.is(':checked')){
            $('#btnSubmit-' + id).hide("fade",500);
        }
    }
}

// Changes form from properties to email
function switchForms(id){
    $("#switch-" + id).attr("disabled", true);

    if($("#properties-" + id).is(':visible')){
        $("#switch-" + id).fadeOut(500, function() {
            $(this).html('<i class="fa fa-gear" style="padding-right:11px"></i>Properties').fadeIn(500);
        });
        $("#title-" + id).fadeOut(500, function() {
            $(this).text('Send Email').fadeIn(500);
        });
        $("#btnSubmit-" + id).fadeOut(500, function () {
            $("#btnEmail-" + id).fadeIn(500);
        });
        $("#properties-" + id).animate({opacity: 0}, 500, function () {
            $("#properties-" + id).css('display','none');
            $("#email-" + id).css('opacity','100');
            $("#email-" + id).show("slide",{ direction: "right" }, 800);
            $("#switch-" + id).removeAttr("disabled");
        });
    }else{
        $("#switch-" + id).fadeOut(500, function() {
            $(this).html('<i class="fa fa-envelope" style="padding-right:11px"></i>Send Email').fadeIn(500);
        });
        $("#title-" + id).fadeOut(500, function() {
            $(this).text('Properties').fadeIn(500);

        });
        $("#btnEmail-" + id).fadeOut(500, function () {
            $("#btnSubmit-" + id).fadeIn(500);
        });

        $("#email-" + id).animate({opacity: 0}, 500, function () {
            $("#email-" + id).css('display','none');
            $("#properties-" + id).css('opacity','100');
            $("#properties-" + id).show("slide",{ direction: "right" }, 800);
            $("#switch-" + id).removeAttr("disabled");
        });
    }
}

// Submit changes to file for sharing
function submitLink(id) {
    var verb = '';
    var my_url = '';
    var formData = {};

    if(id == 0){
        formData = {
            name: $("[name='name-" + id + "']").val(),
            id: $("[name='folder_id-" + id + "']").val(),
            expire_at: $("[name='expire_at-" + id +"']").val(),
            folder: true,
            password: $("[name='password-" + id + "']").val(),
        };
    }else{
        formData = {
            name: $("[name='name-" + id + "']").val(),
            id: $("[name='file_id-" + id + "']").val(),
            expire_at: $("[name='expire_at-" + id +"']").val(),
            password: $("[name='password-" + id + "']").val(),
        };
    }


    var state = $('#cmn-toggle-' + id);

    var share_link = $("[name='share_link-" + id + "']").length;

    if(state.is(':checked') && share_link){
        verb = 'PUT';
        if(id == 0){
            my_url = '/link/' + formData.id
        }else{
            my_url = '/link/' + id;
        }

    } else if(state.is(':checked') && !share_link){
        verb = 'POST';
        my_url = '/link';
    } else if(!state.is(':checked') && share_link){
        verb = 'DELETE';
        if(id == 0){
            my_url = '/link/' + formData.id
        }else{
            my_url = '/link/' + id;
        }
    }else{
        verb = 'PUT';
        my_url = '/file/' + id;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("[name='_token']").val()
        }
    })

    $.ajax({
        type: verb,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function (data) {
            var message = '';
            switch(data['verb']){
                case 'store':
                    message = data['text'] + '<br><br>' + "<span class='text-primary copy' style='cursor: pointer;' data-placement='right'  data-clipboard-text='" + data['link'] + "'>Share Link</span>";
                    break;
                case 'update':
                    message = data['text'];
                    break;
                case 'devare':
                    message = data['text'];
                    break;
            }

            swal({
                title: data['title'],
                html: message,
                type: data['type'],
                timer: 5000,
                allowOutsideClick: false,
            }).then(function(){
                if(data['type'] != 'error') {
                    setTimeout(location.reload.bind(location), 500);
                }
            },function(dismiss){
                if (dismiss === 'timer' && data['type'] != 'error') {
                    setTimeout(location.reload.bind(location), 500);
                }
            });
        },
        error: function (data) {
            var error = data.responseJSON;

            var errorsHtml = '<div class="alert alert-danger"><ul>';

            $.each( error, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
            });
            errorsHtml += '</ul></di>';

            $( '#form-errors-' + id ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
        }
    });
}

// Submit email address to send sharing links
function sendEmail(id) {
    var verb = 'POST';
    var my_url = '/email';
    var formData = {};
    if(id == 0){
        formData = {
            recipients: $("[name='email-" + id + "']").val(),
            message: $("[name='message-" + id + "']").val(),
            id: $("[name='folder_id-" + id + "']").val(),
            folder: true
        };
    }else{
        formData = {
            recipients: $("[name='email-" + id + "']").val(),
            message: $("[name='message-" + id + "']").val(),
            id: $("[name='file_id-" + id + "']").val(),
        };
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("[name='_token']").val()
        }
    })

    $.ajax({
        type: verb,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function (data) {

            swal({
                title: data['title'],
                html: data['text'],
                type: data['type'],
                timer: 5000,
                allowOutsideClick: false,
            }).then(function(){
                if(data['type'] != 'error') {
                    setTimeout(location.reload.bind(location), 500);
                }
            },function(dismiss){
                if (dismiss === 'timer' && data['type'] != 'error') {
                    setTimeout(location.reload.bind(location), 500);
                }
            });
        },
        error: function (data) {
            var error = data.responseJSON;

            var errorsHtml = '<div class="alert alert-danger"><ul>';

            $.each( error, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
            });
            errorsHtml += '</ul></di>';

            $( '#form-errors-' + id ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
        }
    });
}

function updateOptions(id) {
    var formData = {};

    formData = {
        _method: 'PUT',
        email: $('[name=email]:checked').length,
        notify_file: $('[name=notify_file]:checked').length,
        notify_folder: $('[name=notify_folder]:checked').length,
        notify_add: $('[name=notify_add]:checked').length,
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("[name='_token']").val()
        }
    })

    $.ajax({
        type: 'POST',
        url: '/users/' + id,
        data: formData,
        dataType: 'json',
        success: function (data) {
            var message = 'Click ok to reload the page.';

            swal({
                title: data['title'],
                html: message,
                type: data['type'],
                timer: 5000,
                allowOutsideClick: false,
            }).then(function(){
                if(data['type'] != 'error') {
                    setTimeout(location.reload.bind(location), 500);
                }
            },function(dismiss){
                if (dismiss === 'timer' && data['type'] != 'error') {
                    setTimeout(location.reload.bind(location), 500);
                }
            });
        },
        error: function (data) {
            swal({
                title: 'An Error Occurred',
                html: 'Please try again.',
                type: 'error',
                timer: 5000,
                allowOutsideClick: false,
            }).then(function(){
                if(data['type'] != 'error') {
                    setTimeout(location.reload.bind(location), 500);
                }
            },function(dismiss){
                if (dismiss === 'timer' && data['type'] != 'error') {
                    setTimeout(location.reload.bind(location), 500);
                }
            });
        }
    });
}
