$(document).ready(function (){
    var folder_path='';
    load_folder_list();

    function  load_folder_list(){
        var action = "fetch";
        $.ajax({
            url:"/test/app/folders_action.php",
            method: "POST",
            data:{action:action},
            success:function(data){
                $('#folder_table').html(data);
            }
        })
    }

    $(document).on('click', '#create_folder', function (){
        $('#action').val('create');
        $('#folder_name').val('');
        $('#folder_button').val('Create');
        $('#old_name').val('');
        $('#change_title').text('create Folder');
        $('#folderModal').modal('show');
    });

    $(document).on('click', '#folder_button', function (){

        var folder_path_arr  = folder_path.split("/");
        var folder_name = folder_path_arr[folder_path_arr.length -1];
        folder_path_arr.pop();
        folder_path = folder_path_arr.join("/");

        var folder_name=folder_path+'/'+ $('#folder_name').val();
        var action = $('#action').val()
        var old_name = $('#old_name').val();//.substring($('#old_name').val().lastIndexOf("/") + 1);
        if(folder_name != ''){
            $.ajax({
                url:"/test/app/folders_action.php",
                method: "POST",
                data:{folder_name:folder_name, old_name:old_name, action:action},
                success:function (data){
                    $('#folderModal').modal('hide');
                    load_folder_list();
                    alert(data);
                }
            });
        }
        else {
            alert("Enter Folder Name");
        }
    });

    $(document).on('click', '.update', function(){

        folder_path = $(this).data("name");
        $('#old_name').val(folder_path);

        var folder_path_arr  = folder_path.split("/");
        var folder_name = folder_path_arr[folder_path_arr.length -1];

        $('#folder_name').val(folder_name);
        $('#action').val('change');
        $('#folder_buttond').val('Update');
        $('#change_title').text("Change folder name");
        $('#folderModal').modal("show");
    });


    $(document).on('click', '.delete', function(){
        var folder_name = $(this).data("name");
        var action = "delete";
        if(confirm("Are you sure you want to delete this folder?")) {
            $.ajax({
                url:"/test/app/folders_action.php",
                method:"POST",
                data:{folder_name:folder_name, action:action},
                success:function(data){
                    load_folder_list();
                    alert(data);
                }
            });
        }

    });

    $(document).on('click', '.download', function(){
        var folder_name = $(this).data("name");
        var action = "download";

        $.ajax({
            url:"/test/app/folders_action.php",
            method:"POST",
            data:{folder_name:folder_name, action:action},
            success:function(response){
                var location = '/test/app/'+response;
                window.location.href = location;
                //de aici nu se mai executa
                const fs = require("fs");
                try{
                    fs.unlink(location);
                }catch (err) {
                    alert(err);
                }


            }
        });


    });

    $(document).on('click', '.use', function(){
        var folder_name = $(this).data("name");
        var action = "use";

        $.ajax({
            url:"/test/app/folders_action.php",
            method:"POST",
            data:{folder_name:folder_name, action:action},
            success:function(data){
                window.location.href = "/test/ui/ideToggle.php";

            }
        });

    });

});
