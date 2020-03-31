require('./bootstrap');
var department_id = 0;
var postBodyElement = null;
$('#department_save').on('click', function() {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: { d_id: department_id, d_name: $('#d_name').val(), _token: token }
        })
        .done(function(msg) {
            $(postBodyElement).text(msg['new_name']);
            $('#departmentEditModal').modal('hide');
        });
});

$('.department-edit').on('click', function(event) {
    event.preventDefault();
    department_id = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    postBodyElement = event.target.parentNode.parentNode.parentNode.childNodes[3];
    var department_name = postBodyElement.textContent;
    $('#d_name').val(department_name);
    $('#departmentEditModal').modal('show');
});


// NVQ Modal
var nvq_id = 0;
var postBodyElement = null;
$('#nvq_save').on('click', function() {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: { n_id: nvq_id, n_name: $('#n_name').val(), _token: token }
        })
        .done(function(msg) {
            $(postBodyElement).text(msg['new_name']);
            $('#nvqEditModal').modal('hide');
        });
});

$('.nvq-edit').on('click', function(event) {
    event.preventDefault();
    nvq_id = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    postBodyElement = event.target.parentNode.parentNode.parentNode.childNodes[3];
    var nvq_name = postBodyElement.textContent;
    $('#n_name').val(nvq_name);
    $('#nvqEditModal').modal('show');
});

//Course Modal
var course_id = 0;
var postBodyElement = null;
$('#course_save').on('click', function() {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: {
                course_id: course_id,
                name: $('#name').val(),
                department_id: $('#department_id').val(),
                nvq_id: $('#nvq_id').val(),
                duration: $('#duration').val(),
                ojt_duration: $('#ojt_duration').val(),
                _token: token
            }
        })
        .done(function(msg) {
            $(postBodyElement.childNodes[1]).text(msg['course_id']);
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
    course_id = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    postBodyElement = event.target.parentNode.parentNode.parentNode;
    var course_name = postBodyElement.childNodes[3].textContent;
    var department_id = postBodyElement.childNodes[5].textContent;
    var nvq_id = postBodyElement.childNodes[7].textContent;
    var duration = postBodyElement.childNodes[9].textContent;
    var ojt_duration = postBodyElement.childNodes[11].textContent;
    $('#name').val(course_name);
    $('#duration').val(duration);
    $('#ojt_duration').val(ojt_duration);
    $('#department_id option:contains("' + department_id + '")').attr('selected', true);
    $('#nvq_id option:contains("' + nvq_id + '")').attr('selected', true);
    $('#courseEditModal').modal('show');
});