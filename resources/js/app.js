require('./bootstrap');
require('chart.js');
//START department edit modal
var department_id = 0;
var postBodyElement = null;
$('#department_save').on('click', function() {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: {
                d_id: department_id,
                code: $('#code').val(),
                d_name: $('#d_name').val(),
                _token: token
            }
        })
        .done(function(msg) {
            $(postBodyElement.childNodes[1]).text(msg['new_code']);
            $(postBodyElement.childNodes[3]).text(msg['new_name']);
            $('#departmentEditModal').modal('hide');
        });
});

$('.department-edit').on('click', function(event) {
    event.preventDefault();
    department_id = event.target.parentNode.parentNode.parentNode.parentNode.dataset['did'];
    postBodyElement = event.target.parentNode.parentNode.parentNode.parentNode;
    var department_code = postBodyElement.childNodes[1].textContent;
    var department_name = postBodyElement.childNodes[3].textContent;
    $('#d_name').val(department_name);
    $('#code').val(department_code);
    $('#departmentEditModal').modal('show');
});
//END department edit modal

// NVQ Modal Model
var nvq_id = 0;
var postBodyElement = null;
$('#nvq_save').on('click', function() {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: { n_id: nvq_id, n_name: $('#n_name').val(), _token: token }
        })
        .done(function(msg) {
            $(postBodyElement.childNodes[1]).text(msg['new_code']);
            $(postBodyElement.childNodes[3]).text(msg['new_name']);
            $('#nvqEditModal').modal('hide');
        });
});

$('.nvq-edit').on('click', function(event) {
    event.preventDefault();
    nvq_id = event.target.parentNode.parentNode.parentNode.parentNode.childNodes[1].textContent;
    postBodyElement = event.target.parentNode.parentNode.parentNode.parentNode;
    var nvq_name = postBodyElement.childNodes[3].textContent;
    $('#n_name').val(nvq_name);
    $('#nvqEditModal').modal('show');
});

//Course Model
var course_id = 0;
var postBodyElement = null;
$('#course_save').on('click', function() {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: {
                course_id: course_id,
                name: $('#name').val(),
                code: $('#code').val(),
                department_id: $('#department_id').val(),
                nvq_id: $('#nvq_id').val(),
                duration: $('#duration').val(),
                ojt_duration: $('#ojt_duration').val(),
                _token: token
            }
        })
        .done(function(msg) {
            $(postBodyElement.childNodes[1]).text(msg['code']);
            $(postBodyElement.childNodes[3]).text(msg['name']);
            $(postBodyElement.childNodes[5]).text(msg['department']);
            $(postBodyElement.childNodes[7]).text(msg['nvq']);
            $(postBodyElement.childNodes[9]).text(msg['duration']);
            $(postBodyElement.childNodes[11]).text(msg['ojt_duration']);
            $('#courseEditModal').modal('hide');
        });
});


$('.course-edit').on('click', function(event) {
    event.preventDefault();
    course_id = event.target.parentNode.parentNode.parentNode.parentNode.dataset['cid'];
    postBodyElement = event.target.parentNode.parentNode.parentNode.parentNode;
    var course_code = postBodyElement.childNodes[1].textContent;
    var course_name = postBodyElement.childNodes[3].textContent;
    var department_id = postBodyElement.childNodes[5].textContent;
    var nvq_id = postBodyElement.childNodes[7].textContent;
    var duration = postBodyElement.childNodes[9].textContent;
    var ojt_duration = postBodyElement.childNodes[11].textContent;
    $('#code').val(course_code);
    $('#name').val(course_name);
    $('#duration').val(duration);
    $('#ojt_duration').val(ojt_duration);
    $('#department_id option:contains("' + department_id + '")').attr('selected', true);
    $('#nvq_id option:contains("' + nvq_id + '")').attr('selected', true);
    $('#courseEditModal').modal('show');
});

//

//Course Dropdown
$('#course_id').change(function(event) {
    var course_id = this.value;
    $.ajax({
        method: 'POST',
        url: urlModuleByCourse,
        data: {
            id: course_id,
            _token: token
        }
    }).done(function(msg) {
        $("#modules").empty();
        $.each(msg['modules'], function() {
            $("#modules").append(new Option(this.name, this.id));
        });
    });
});

//TVEC EXAM Results 
$('#tvec_exam_results_add_batch').on('click', function(event) {
    event.preventDefault();
    var batch_id = event.target.dataset['batch'];
    $.ajax({
        method: 'POST',
        url: urlStudentsByBatch,
        data: {
            id: batch_id,
            _token: token
        }
    }).done(function(msg) {
        $.each(msg['students'], function() {
            $("#tvec_exam_results").append('<tr>\
            <td>' + this.reg_no + '</td>\
            <td>' + this.shortname + '</td>\
            <td>\
                <select class="custom-select custom-select-sm" name="results[' + this.id + ']" required>\
                    <option value="" selected>Select</option>\
                    <option value="P">Pass</option>\
                    <option value="F">Fail</option>\
                    <option value="AB">Absent</option>\
                </select>\
            </td>\
            <td> \
                <select class="custom-select custom-select-sm" name="attempts[' + this.id + ']" required>\
                    <option value="1" selected>Attempt 1</option>\
                    <option value="2">Attempt 2</option>\
                    <option value="3">Attempt 3</option>\
                </select>\
            </td>\
            </tr>');
        });
        $('#tvec_exam_results_add_batch').hide();
    });
});

$('#tvec_exam_results_add_repeat').on('click', function(event) {
    var student_reg = $('#tvec_exam_results_name_repeat').val();
    $.ajax({
        method: 'POST',
        url: urlStudentByReg,
        data: {
            id: student_reg,
            _token: token
        }
    }).done(function(msg) {
        $.each(msg['students'], function() {
            $("#tvec_exam_results").append('<tr class="table-info">\
            <td>' + this.reg_no + '</td>\
            <td>' + this.shortname + '</td>\
            <td>\
                <select class="custom-select custom-select-sm" name="results[' + this.id + ']" required>\
                    <option value="" selected>Select</option>\
                    <option value="P">Pass</option>\
                    <option value="F">Fail</option>\
                    <option value="AB">Absent</option>\
                </select>\
            </td>\
            <td> \
                <select class="custom-select custom-select-sm" name="attempts[' + this.id + ']" required>\
                    <option value="1" selected>Attempt 1</option>\
                    <option value="2">Attempt 2</option>\
                    <option value="3">Attempt 3</option>\
                </select>\
            </td>\
            </tr>');
        });
    });
});

//Tooltip
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$('#batch_couese_id').change(function(event) {
    var course_id = this.value;
    $.ajax({
        method: 'POST',
        url: urlBatchesByCourse,
        data: {
            id: course_id,
            _token: token
        }
    }).done(function(msg) {
        $("#batch_id").empty();
        $.each(msg['batches'], function() {
            $("#batch_id").append(new Option(this.name, this.id));
        });
    });
});

$('.toast').toast('show');