function function_randomize(){
    // get the array
    const array = indexArray;

    // randomize
    const generated_random_number = Math.floor(Math.random() * array.length);
    const item = array[generated_random_number];

    // display the generated value
    var data = {
        'updateId' : item,
    };

    $.ajax({
        type: "GET",
        url : "fetch.php",
        dataType: "json",
        crossDomain: "true",
        contentType: "application/json; charset=utf-8",
        data: data,
        success: function (data) {
            // show the modal add with data
            document.getElementById('random_result_name').innerHTML = data.name;
            document.getElementById('random_result_description').innerHTML = data.description;
            document.getElementById('random_result_image').src = "img/" + data.imagepath;
            $("#modalDisplayRandom").modal("show");
        },
        error: function () {
            location.reload();
        }});
}



function function_delete(selected_id){
    // show the Id
    var data = {
        'deleteId' : selected_id,
    };

    // push the id on backent to delete
    $.ajax({
        type: "GET",
        url : "delete.php",
        dataType: "json",
        crossDomain: "true",
        contentType: "application/json; charset=utf-8",
        data: data,
        success: function (response) {
            location.reload();
        },
        error: function () {
            location.reload();
        }});
}


function function_update(selected_id){
    // get the Id

    // hide the modal list
    $("#modalListUlam").modal("hide");
    
    // fetch from db using id
    var data = {
        'updateId' : selected_id,
    };

    $.ajax({
        type: "GET",
        url : "fetch.php",
        dataType: "json",
        crossDomain: "true",
        contentType: "application/json; charset=utf-8",
        data: data,
        success: function (data) {
            // show the modal add with data
            document.getElementById('ulam_name').value = data.name;
            document.getElementById('ulam_description').value = data.description;
            document.getElementById('update_button_when_update').innerHTML = "Update Ulam Details";
            document.getElementById("update_action_when_update").action  = "/edit.php";
            document.getElementById("ulam_id").value  = data.id;


            // hide the image file field
            document.getElementById("hide_image_when_update").style.display  = "none";

            $("#modalAddUlam").modal("show");
        },
        error: function () {
            location.reload();
        }});
}

function function_add_ulam_reset_properties(){
    document.getElementById('ulam_name').value = "";
    document.getElementById('ulam_description').value = "";
    document.getElementById('update_button_when_update').innerHTML = "Save Ulam Entry";
    document.getElementById("hide_image_when_update").style.display  = "block";
    document.getElementById("update_action_when_update").action  = "/add.php";
}
