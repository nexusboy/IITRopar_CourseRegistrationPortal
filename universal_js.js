function addCourse(button) {
    var id = parseInt(button.id, 10);
    var table = document.getElementById("table");
    var rowCollection = table.rows.item(id).cells;
    var courseSlot = rowCollection.item(4).innerText;
    var course_id = rowCollection.item(1).innerText;

    $.ajax({
        type: "POST",
        url: "insert2.php",
        data: {query: 'select * from courses', add_course: "1", course_id: course_id, course_slot: courseSlot},
        success: function (OUTPUT) {
            alert(OUTPUT);
            OUT = OUTPUT;
        },
        complete: function () {
        }
    });
}

function dropCourse(button) {
    var id = parseInt(button.id, 10);
    var table = document.getElementById("table");
    var rowCollection = table.rows.item(id).cells;
    var course_id = rowCollection.item(1).innerText;
    alert(course_id);

    $.ajax({
        type: "POST",
        url: "dropStudent.php",
        data: {query: 'select * from courses', drop_course: "1", course_id: course_id},
        success: function (OUTPUT) {
            OUT = OUTPUT;
        },
        complete: function () {
        }
    });
}

function studentTranscript() {
    var id = document.getElementById("course_id").value;
    // alert(id.value);
    $.ajax({
        type: "POST",
        url: "studentTranscript.php",
        data: {student_id: id},
        success: function (OUTPUT) {
            // alert(OUTPUT);
            OUT = OUTPUT;
        },
        complete: function () {
            document.getElementById("studentTranscriptTable").innerHTML = OUT;
        }
    });
    console.log(id);
}

function viewCourses() {
    var OUT;
    $.ajax({
        type: "POST",
        url: "queryExecutor.php",
        data: {query: 'select * from courses'},
        success: function (OUTPUT) {
            alert(OUTPUT);
            OUT = OUTPUT;
        },
        complete: function () {
            document.getElementById("thisdiv").innerHTML = OUT;

        }
    });
}