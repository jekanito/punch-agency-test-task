function showModalTask() {
    $('.background-task-modal').css('display', 'flex');
}

function hideModalTask() {
    $('.background-task-modal').css('display', 'none');
}

function getListTasks() {
    $.ajax({
        method: 'get',
        url: '/api/tasks',
        success: (data) => {
            console.log(data);
            var data_table = '';
            var count_completed_tasks = 0;
            var count_tasks = 0;
            data.data.forEach((element) => {
                count_tasks++;
                if (element.status === 'completed') {
                    count_completed_tasks++;
                }
                data_table += '<tr>'
                    + '<td>'
                    + element.id
                    +'</td>'
                    + '<td>'
                    + element.name
                    +'</td>'
                    + '<td>'
                    + element.description
                    +'</td>'
                    + '<td>'
                    + element.status
                    +'</td>'
                    + '<td>'
                    + element.date_completion
                    +'</td>'
                    + '<td>'
                    + '<button onclick="editNewTask(' + element.id + ')" class="edit-task">'
                    + 'Edit'
                    + '</button>'
                    + '<button onclick="deleteNewTask(' + element.id + ')" class="delete-task">'
                    + 'Delete'
                    + '</button>'
                    +'</td>'
                    + '</tr>';
            });
            $('.table-tasks tbody').html(data_table);
            $('.all-count-completed-tasks').html(count_completed_tasks);
            $('.all-count-tasks').html(count_tasks);
        }
    })
}

function addNewTask() {
    $('.apply-modal').html('Create');
    $('#create-flag').val(1);
    $('#name').val('');
    $('#description').val('');
    $('#status').val('pending');
    $('#date-completion').val('');
    $('#id').val('');
}

function storeNewTask() {
    $.ajax({
        method: 'post',
        url: '/api/tasks',
        data: $('#task-modal-form').serialize(),
        success: (data) => {
            console.log(data);
            hideModalTask();
            getListTasks();
        },
        error: (data) => {
            console.log(data);
        }
    });
}

function editNewTask(id) {
    $('.apply-modal').html('Update');
    $('#create-flag').val(0);
    $.ajax({
        method: 'get',
        url: '/api/tasks/' + id,
        success: (data) => {
            console.log(data);
            $('#name').val(data.data.name);
            $('#description').val(data.data.description);
            $('#status').val(data.data.status);
            $('#date-completion').val(data.data.date_completion);
            $('#id').val(data.data.id);
            showModalTask();
        },
        error: (data) => {
            console.log(data);
        }
    })
}

function updateNewTask() {
    $.ajax({
        method: 'put',
        url: '/api/tasks/' + $('#id').val(),
        data: $('#task-modal-form').serialize(),
        success: (data) => {
            console.log(data);
            hideModalTask();
            getListTasks();
        },
        error: (data) => {
            console.log(data);
        }
    })
}

function deleteNewTask(id) {
    var check = confirm("Are you sure? what doy want delete row # " + id + "?");
    if (check) {
        $.ajax({
            method: 'delete',
            url: '/api/tasks/' + id,
            success: (data) => {
                console.log(data);
                hideModalTask();
                getListTasks();
            },
            error: (data) => {
                console.log(data);
            }
        })
    }
}

function applyModalTask() {
    if ($('#create-flag').val() == 1) {
        storeNewTask();
    } else {
        updateNewTask();
    }
}

$(document).ready(function() {
    console.log("ready!");
    getListTasks();

    $('.add-task').on('click', function() {
        showModalTask();
        addNewTask();
    });

    $('.close-modal').on('click', function() {
        hideModalTask();
    });

    $('.apply-modal').on('click', function() {
        applyModalTask();
    });
});
