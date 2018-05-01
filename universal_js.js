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
            document.getElementById("thisdiv").innerHTML = OUT;
            document.getElementById("thisdiv").style.background = "green";

        }
    });
}