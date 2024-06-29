<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>


<table id = main border="0" cellspacing="0">
    <tr>
        <td id="hered" >
        <h2> Add Record with PHP &  Ajax </h2>

        <div id="search-bar">
        
            <input type="text" id="search" autocomplete="off" placeholder="Search Now">
        </div>
        </td>
    </tr>
    <tr>
        <td id="table-form">
            <form id="AddForm">
         Name : <input type="text" id="fname" class="inp-f">&nbsp;
        Address : <input  type="text" id="add" class="inp-f">&nbsp;
        S Cord : <input  type="text" id="cord" class="inp-f">&nbsp;
        NO : <input  type="text" id="no" class="inp-f">&nbsp;
        <input id="save-button" type="submit" class="save" name="button"  value="Save">
        </form>
        </td>
    </tr>
    <tr>
       <td id="table-data">
        <table border="1" width="100%" cellspacing="0" cellpadding="10px">
   
        </table>

       </td>
</td>
    </tr>
    </table>
<div id="error-message"></div>
<div id="success-message"></div>
<div id="modal">
    <div id="modal-form">
    <i id="edit" class="ri-close-line"></i>
        <h2>Edit Form</h2>
        <table cellpadding="10px" width="100%">
           

        </table>
    </div>
</div>

  <script type="text/javascript">
    $(document).ready(function() {
        //load table record
        function loadtable(){
            $.ajax({
                url : "ajaxlode.php",
                type: "POST", // GET  by defolt hota hai 
                success :function(data){
                    $("#table-data").html(data); // ye data ko kaha show kar na hai ye bata hai 

                }
            });
        }
        loadtable(); // load table record on page load


// insert new records
$("#save-button").on("click",function(e){
    e.preventDefault();
    var fname = $("#fname").val();
    var add = $("#add").val();
    var cord = $("#cord").val();
    var no = $("#no").val();
//  validation chake  all fild are filld are not 

if(fname == "" || add == "" || cord == "" || no == ""){
    $("#error-message").html("All fields are required.").slideDown();
    $("#success-message").slideUp();

}else{
    $.ajax(
        {
            url : "ajax-inset.php", 
            type : "post",
            data: {
            sname: fname,
            add: add,
            cord: cord,
            no: no
        },
            success :function(data){

                if(data == 1){
                    loadtable();
                    $("#AddForm").trigger("reset");
                    $("#success-message").html("data save.").slideDown();

                }else{
                    $("#error-message").html("Can't save Record.").slideDown();
                    $("#success-message").slideUp();
                }
            }
        });
    }
}) 


   //$("#DELITE") es treka ka koi va event nai kar shk the q dinamocal aarha hai deta us ke liye alag the ka aata hai 

   $(document).on("click", ".delete-butn", function(){
    if(confirm("do you really want to delete this record ?")){

  
    var sid  = $(this).data('id'); // Corrected
    var element = this;
    // alert(sid);
    $.ajax({
        url: "ajax-delete.php",
        type: "POST",
        data: { keyid: sid },
        success : function(data) {
            if(data == 1) {
                $(element).closest("tr").fadeOut();
            } else {
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
            }
        },
        error: function() {
            // Handle any errors with the AJAX request
        }
    });
}
});

    //swho model box
    $(document).on("click", ".edit-butn", function(){
   $('#modal').show();
   var sid= $(this).data("edit");// ye line ke waja se id or us ka pura deta mil rha hai 
//    alert(sid)

   $.ajax({
    url : "update.php",
    type :"POST",
    data : {updateid : sid},
    success : function(data){
        $('#modal-form table').html(data);
    }
   })
    });

    //hide model box
    $(document).on("click", "#edit", function(){
   $('#modal').hide();
    });
    // save update form
$(document).on("click", "#edit-submit", function(){
    var sid = $("#edit-sid").val();
    var sname = $("#edit-name").val();
    var saddress = $("#edit-ad").val();
    var sclass = $("#edit-class").val();
    var sphone = $("#edit-no").val();

    $.ajax({
        url : "ajaxUpdateform.php",
        type : "POST",
        data : { key_id: sid, s_name: sname, s_address: saddress, s_class: sclass,  s_no: sphone },
        success : function(data){
         if (data == 1) {   
            $('#modal').hide();
            loadtable(); 
        }else{
            alert("sorry")
        }
        }
    })

});
//live search
$("#search").on("keyup", function(){
 var search_term = $(this).val();
 $.ajax({
    url:"livesearch.php",
    type:"POST",
    data : {search_value: search_term},
    success:function(data){
    $("#table-data").html(data);
    }
 })
});


});

  </script>  
</body>
</html>