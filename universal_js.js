function addCourse(button) {
    var id = parseInt(button.id, 10);
    var table = document.getElementById("table");

    var rowCollection = table.rows.item(id).cells;
    var courseSlot = rowCollection.item(4).innerText;
    console.log(courseSlot);
    var course_id = rowCollection.item(1).innerText;
    console.log(course_id);

    $.ajax({
        type: "POST",
        url: "insert.php",
        data: {query: 'select * from courses', add_course: "1", course_id: course_id, course_slot: courseSlot},
        success: function (OUTPUT) {
            alert(OUTPUT);
            OUT = OUTPUT;
        },
        complete: function () {


        }
    });
}

function dropCourse(course_id) {
    var courseId = course_id.id;
    alert(courseId);
    $.ajax({
        type: "POST",
        url: "insert.php",
        data: {query: 'select * from courses', add_course: "1", course_id: courseId},
        success: function (OUTPUT) {
            alert(OUTPUT);
            OUT = OUTPUT;
        },
        complete: function () {


        }
    });
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
            document.getElementById("thisdiv").style.background = "green";

        }
    });
}