let firstInput=0;
let editor;
let parametersArr = [];
let precision;
let inputText = '';
let filePath = '';
let menu = null;
let x, y;
let newFolderPath = '';
let newFilePath ='';

window.onload = function() {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/python");
    menu = document.querySelector('.rc-menu');
    menu.classList.add('off');

    menu = document.querySelector('.rc-menu-file');
    menu.classList.add('off');

}

function changePrecision() {

    precision = $("#input_precision").val();

}

function changeInputText() {

    inputText = $("#input_text").val();

}

function changeParameters() {
    parametersArr = [];
    let inputFile = document.getElementById("inputfilecheck");
    let inputText = document.getElementById("inputtextcheck");
    let meta = document.getElementById("metacheck");
    let precision = document.getElementById("precisioncheck");
    let exhaustive = document.getElementById("exhaustivecheck");
    let complexity = document.getElementById("complexitycheck");
    let pathCondition = document.getElementById("pathconditioncheck");
    let trace = document.getElementById("tracecheck");
    let runtimeVerification = document.getElementById("runtimeverifcheck");
    let staticVerification = document.getElementById("staticverifcheck");
    let stm = document.getElementById("stmcheck");
    let version = document.getElementById("versioncheck");

    if(inputFile.checked == true && inputText.checked == false) {
        if(!parametersArr.includes("-if")) {
            parametersArr.push("-if");
            firstInput = 1;
            let inputItem = document.getElementById('upload');
            inputItem.classList.remove('off');
            inputItem = document.getElementById('resizable-input');
            inputItem.classList.add('off');

        }
    }else if(inputFile.checked == false && inputText.checked == true) {
        if(!parametersArr.includes("-it")) {
            parametersArr.push("-it");
            firstInput = 2;
            let inputItem = document.getElementById('upload');
            inputItem.classList.add('off');
            inputItem = document.getElementById('resizable-input');
            inputItem.classList.remove('off');
        }
    }else if(inputFile.checked == true && inputText.checked == true && firstInput == 1) {
        inputFile.checked = false;
        if(!parametersArr.includes("-it")) {
            parametersArr.push("-it");
            firstInput = 2;
            let inputItem = document.getElementById('resizable-input');
            inputItem.classList.remove('off');
            inputItem = document.getElementById('upload');
            inputItem.classList.add('off');
        }
    }else if(inputFile.checked == true && inputText.checked == true && firstInput == 2) {
        inputText.checked = false;
        if(!parametersArr.includes("-if")) {
            parametersArr.push("-if");
            firstInput = 1;
            let inputItem = document.getElementById('resizable-input');
            inputItem.classList.add('off');
            inputItem = document.getElementById('upload');
            inputItem.classList.remove('off');
        }
    }else {
        let inputItem = document.getElementById('upload');
        inputItem.classList.add('off');
        inputItem = document.getElementById('resizable-input');
        inputItem.classList.add('off');
    }

    if(meta.checked == true){
        if(!parametersArr.includes("-m")) {
            parametersArr.push("-m");
        }
    }
    if(precision.checked == true){
        if(!parametersArr.includes("-p")) {
            parametersArr.push("-p");
            let inputItem = document.getElementById('input_precision');
            inputItem.classList.remove('off');
        }
    }else {
        let inputItem = document.getElementById('input_precision');
        inputItem.classList.add('off');
    }
    if(exhaustive.checked == true){
        if(!parametersArr.includes("-e")) {
            parametersArr.push("-e");
        }
    }
    if(pathCondition.checked == true){
        if(!parametersArr.includes("-pc")) {
            parametersArr.push("-pc");
        }
    }
    if(staticVerification.checked == true){
        if(!parametersArr.includes("-s")) {
            parametersArr.push("-s");
        }
    }
    if(stm.checked == true){
        if(!parametersArr.includes("-smt z3")) {
            parametersArr.push("-smt z3");
        }
    }
    if(version.checked == true){
        if(!parametersArr.includes("-v")) {
            parametersArr.push("-v");
        }
    }
}

function executeCode() {

    $.ajax({

        url: "/test/app/compiler.php",

        method: "POST",

        data: {
            code: editor.getSession().getValue(),
            parameters: parametersArr,
            precision: precision,
            inputText:inputText,
        },

        success: function (response) {
            $(".output").text(response)
        }
    })
}

function copyCode(path){
    var filePathB = path;
    var action = "fetch_file";
    filePath = filePathB;
    $.ajax({
        url: "/test/app/projectFileManagement.php",
        method: "POST",
        data: {action:action, filePath:filePathB},
        success: function (response) {
            editor.getSession().setValue(response);
        }
    })


}

function saveFile(){
    var action = "save";
    $.ajax({
        url: "/test/app/projectFileManagement.php",
        method: "POST",
        data: {action:action,
               filePath:filePath,
               code: editor.getSession().getValue(),
        },
        success: function (response) {
            //alert(response);
        }
    })
}

function setMenu(e, menufile){
    x = e.clientX;
    y = e.clientY;
    e.preventDefault();
    menu = document.querySelector(menufile);
    menu.addEventListener('mouseleave', hidemenu);
    menu.classList.add('off');
    console.log(x, y);
    menu.style.top = `${y-5 }px`;
    menu.style.left = `${x-5}px`;
    menu.classList.remove('off');

}

function rightClickFolder(e, path){
    newFolderPath = path;
    setMenu(e, '.rc-menu');
    addMenuListeners();

}
function rightClickFile(e, path){
    newFilePath = path;
    var file_path_arr  = newFilePath.split(".");
    var extension = file_path_arr[file_path_arr.length-1];
    if(extension=='in'){
        setMenu(e, '.rc-menu-file-input');
        addMenuListenersFileInput();
    }else {
        setMenu(e, '.rc-menu-file');
        addMenuListenersFile();
    }


}


function hidemenu() {
    menu.classList.add('off');
    menu.style.top = '-200%';
    menu.style.left = '-200%';
}

function addMenuListeners(){
    document.getElementById('new-file').addEventListener('click', createFile);
    document.getElementById('new-folder').addEventListener('click', createFolder);
    document.getElementById('rename-folder').addEventListener('click', renameFolder);
    document.getElementById('delete-folder').addEventListener('click', deleteFolder);
}

function addMenuListenersFile(){
    document.getElementById('rename-file').addEventListener('click', renameFile);
    document.getElementById('delete-file').addEventListener('click', deleteFile);
}

function addMenuListenersFileInput(){
    document.getElementById('use-file-input').addEventListener('click', useFile);
    document.getElementById('rename-file-input').addEventListener('click', renameFile);
    document.getElementById('delete-file-input').addEventListener('click', deleteFile);
} 

function createFile(){
    $('#action').val('createFile');
    $('#file_name').val('');
    $('#file_button').val('Create');
    $('#change_title').text('create File');
    $('#fileModal').modal('show');

    $(document).on('click', '#file_button', function (){
        var file_name= $('#file_name').val();
        var action = $('#action').val()
        if(folder_name != ''){
            $.ajax({
                url: "/test/app/projectFileManagement.php",
                method: "POST",
                data: {file_name:file_name,
                       action:action,
                       filePath:newFolderPath,
                },
                success: function (response) {
                    //alert(response);
                    $('#fileModal').modal('hide');
                    $("#treeview").load(window.location.href + " #treeview" );
                }
            })
        }
        else {
            alert("Enter Folder Name");
        }
    });

}

function createFolder(){
        $('#action').val('createFolder');
        $('#folder_name').val('');
        $('#folder_button').val('Create');
        $('#old_name').val('');
        $('#change_title').text('create Folder');
        $('#folderModal').modal('show');

    $(document).on('click', '#folder_button', function (){
        var folder_name= $('#folder_name').val();
        var action = $('#action').val()
        if(folder_name != ''){
            $.ajax({
                url: "/test/app/projectFileManagement.php",
                method: "POST",
                data: {folder_name:folder_name,
                    action:action,
                    folderPath:newFolderPath,
                },
                success: function (response) {
                    //alert(response);
                    $('#folderModal').modal('hide');
                    $("#treeview").load(window.location.href + " #treeview" );
                }
            })
        }
        else {
            alert("Enter Folder Name");
        }
    });

}

function renameFolder(){

    var folder_path = newFolderPath;
    $('#old_name').val(folder_path);


    var folder_path_arr  = folder_path.split("/");

    if(folder_path_arr.length == 5){
        alert("Renaming this project is not possible here. Go to project list.")
        return;
    }
    var folder_name = folder_path_arr[folder_path_arr.length -1];
    folder_path_arr.pop();
    folder_path = folder_path_arr.join("/");

    $('#folder_name').val(folder_name);
    $('#action').val('updateFolder');
    $('#folder_buttond').val('Update');
    $('#change_title').text("Change folder name");
    $('#folderModal').modal("show");


    $(document).on('click', '#folder_button', function (){
        folder_path=folder_path+'/'+ $('#folder_name').val();
        var action = $('#action').val()
        var old_name = $('#old_name').val();
        if($('#folder_name').val() != ''){
            $.ajax({
                url: "/test/app/projectFileManagement.php",
                method: "POST",
                data: {folder_path:folder_path,
                    old_name:old_name,
                    action:action,
                },
                success: function (response) {
                    //alert(response);
                    $('#folderModal').modal('hide');
                    $("#treeview").load(window.location.href + " #treeview" );
                }
            })
        }
        else {
            alert("Enter Folder Name");
        }
    });

}

function deleteFolder(){

    var folder_name =  newFolderPath;
    $('#old_name').val(folder_name);


    var folder_path_arr  = folder_name.split("/");

    if(folder_path_arr.length == 5){
        alert("Deleting this project is not possible here. Go to project list.")
        return;
    }
    var action = "delete";
    if(confirm("Are you sure you want to delete this folder?")) {
        $.ajax({
            url: "/test/app/projectFileManagement.php",
            method:"POST",
            data:{folder_name:folder_name, action:action},
            success:function(data){
                //alert(data);
                $("#treeview").load(window.location.href + " #treeview" );
            }
        });
    }
}

function renameFile(){

    var file_path = newFilePath;
    $('#old_name').val(file_path);


    var file_path_arr  = file_path.split("/");
    var file_name = file_path_arr[file_path_arr.length -1];
    file_path_arr.pop();
    file_path = file_path_arr.join("/");

    $('#file_name').val(file_name);
    $('#action').val('updateFile');
    $('#file_button').val('Update');
    $('#change_title').text("Change file name");
    $('#fileModal').modal("show");

    $(document).on('click', '#file_button', function (){
        file_path= file_path+'/'+$('#file_name').val();
        var action = $('#action').val();
        var old_name = $('#old_name').val();
        if($('#file_name').val() != ''){
            $.ajax({
                url: "/test/app/projectFileManagement.php",
                method: "POST",
                data: {file_path:file_path,
                    old_name:old_name,
                    action:action,
                },
                success: function (response) {
                    //alert(response);
                    $('#fileModal').modal('hide');
                    $("#treeview").load(window.location.href + " #treeview" );
                }
            })
        }
        else {
            alert("Enter Folder Name");
        }
    });

}

function deleteFile(){

    var file_path =  newFilePath;
    var action = "deleteFile";
    if(confirm("Are you sure you want to delete this file?")) {
        $.ajax({
            url: "/test/app/projectFileManagement.php",
            method:"POST",
            data:{file_path:file_path, action:action},
            success:function(data){
                //alert(data);
                $("#treeview").load(window.location.href + " #treeview" );
            }
        });
    }
}


function useFile(){

    var file_path =  newFilePath;
    var action = "fetch_file";
    $.ajax({
        url: "/test/app/projectFileManagement.php",
        method: "POST",
        data: {action:action, filePath:file_path},
        success: function (response) {
            $("#inputtextcheck").prop("checked", 1);
            changeParameters();
            $("#input_text").text(response);
            hidemenu();
        }
    })

}




