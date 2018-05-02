function addCourse(course_id) {
    var courseId = course_id.id;

    $.ajax({
        type: "POST",
        url: "insert.php",
        data: {query: 'select * from courses', add_course: "1", course_id:courseId},
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