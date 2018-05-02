function viewCourses()
{
    var OUT;
    $.ajax({
        type: "POST",
        url: "queryExecutor.php",
        data: { query : 'select * from courses'},
        success: function (OUTPUT) {
            alert(OUTPUT);
            OUT = OUTPUT;
        },
        complete:function(){
            document.getElementById("AllCourses").innerHTML = OUT;
            document.getElementById("AllCourses").style.background = "green";

        }
    });
}

function coursesOffered()
{
    var OUT;
    $.ajax({
        type: "POST",
        url: "queryExecutor.php",
        data: { query : 'select * from course_offering'},
        success: function (OUTPUT) {
           // alert(OUTPUT);
            OUT = OUTPUT;
        },
        complete:function(){
            document.getElementById("CoursesOffered").innerHTML = OUT;
            document.getElementById("CoursesOffered").style.background = "white";

        }
    });
}