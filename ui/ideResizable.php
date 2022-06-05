<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codeboard Online IDE</title>
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
</head>


<body>

<div id="folderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span id="change_title">Create Folder</span>
                </h4>
            </div>
            <div class="modal-body">
                <p>Enter Folder Name
                    <input type="text" name="folder_name" id="folder_name" class="form-control"/>
                </p>
                <br/>
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="old_name" id="old_name" />
                <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="fileModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span id="change_title">Create File</span>
                </h4>
            </div>
            <div class="modal-body">
                <p>Enter File Name With Extension!!
                    <input type="text" name="file_name" id="file_name" class="form-control"/>
                </p>
                <br/>
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="old_name" id="old_name" />
                <input type="button" name="file_button" id="file_button" class="btn btn-info" value="Create" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<nav class="navbar">
    <div class="navbar-container container">
        <h1 class="logo">Alk</h1>
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li>
                <form class="ide-form" action="ideToggle.php" method="post">
                    <button class="btn" name="open-folder">Home</button>
                </form>
            </li>
            <li><?php
                require_once("../app/LoginLogoutButton.php");
                LoginLogout();
                ?>
            </li>
            <li>
                <form class="project-form" action="foldersDrop.php" method="post">
                    <button class="btn" name="open-folder">Open project</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
<br>
<div class="welcome-msg">
    <h4>
        <?php
        require_once("../app/LoginLogoutButton.php");
        welcomeMsg();
        ?>
    </h4>
</div>

<div class="button-container">
    <button class="btn" id="save-btn" onclick="saveFile()">Save</button>
    <button class="btn" id="run-btn" onclick="executeCode()"> Run </button>
</div>


<ul class="rc-menu" id="rc-menu-id">
    <li class="rc-menu-items" id="new-file">New file</li>
    <li class="rc-menu-items" id="new-folder">New folder</li>
    <li class="rc-menu-items" id="rename-folder">Rename Folder</li>
    <li class="rc-menu-items" id="delete-folder">Delete Folder</li>
</ul>

<ul class="rc-menu-file off" id="rc-menu-file-id">
    <li class="rc-menu-items" id="rename-file">Rename File</li>
    <li class="rc-menu-items" id="delete-file">Delete File</li>
</ul>

<div class="containerCode">
    <div class="clstreeview" id="treeview">
        <br>
        <ul class="asTree">
            <?php
            require_once("../app/fetch.php");
            if(isset($_SESSION['projectPath'])) {
                $projectPath = $_SESSION["projectPath"];
                ListFolder('../app/'.$projectPath);
            }
            else{
                echo "<li> no project selected</li>";
            }
            ?>
        </ul>
    </div>
    <div class="editor" id="editor"></div>
</div>
<div class="parameters-container">
    <fieldset class="parameters" id="parameters" onchange= "changeParameters()">
        <legend>Parameters:</legend>
        <div class="input">
            <form class="input-file" action="" method="post" enctype="multipart/form-data" >
                <input id="inputfilecheck" name="inputfilecheck" type="checkbox" value="InputFile">
                <label for="inputfilecheck">Input file</label>
                <div class="upload off" id="upload">
                    <input id="file" type="file" name="file" />
                    <span id="uploaded_file"></span>
                </div>
            </form>
            <form class="input-text" id="input-text" action="" method="post" enctype="multipart/form-data">
                    <input id="inputtextcheck" name="inputtextcheck" type="checkbox" value="InputText">
                    <label for="inputtextcheck">Input text</label>
            </form>
            <span class="resizable-input off" id="resizable-input"><textarea id="input_text" name="file" onchange="changeInputText()"></textarea></span>
        </div>
        <div class="other-parameters">
            <form class="input-precision" action="" method="post" enctype="multipart/form-data">
                <input id="precisioncheck" name="inputcheck" type="checkbox" value="Precision">
                <label for="precisioncheck">Precision</label>
                <input class="precision off" id="input_precision" type="number" name="file" onchange="changePrecision()"/>
            </form>
            <input id="metacheck" name="metacheck" type="checkbox" value="Meta">
            <label for="metacheck">Metadata</label>
            <br>
            <input id="exhaustivecheck" name="exhaustivecheck" type="checkbox" value="Exhaustive">
            <label for="exhaustivecheck">Exhaustive mode</label>
            <br>
            <!--        <input id="complexitycheck" name="complexitycheck" type="checkbox" value="Complexity">
                    <label for="complexitycheck">Complexity</label>-->
            <input id="pathconditioncheck" name="pathconditioncheck" type="checkbox" value="PathCondition">
            <label for="pathconditioncheck">Path condition</label>
            <br>
            <!--        <input id="tracecheck" name="tracecheck" type="checkbox" value="Trace">
                    <label for="tracecheck">Trace</label>-->
            <!--        <input id="runtimeverifcheck" name="runtimeverifcheck" type="checkbox" value="RuntimeVerification">
                    <label for="runtimeverifcheck">Runtime Verification</label>-->
            <input id="staticverifcheck" name="staticverifcheck" type="checkbox" value="StaticVerification">
            <label for="staticverifcheck">Static Verification</label>
            <br>
            <input id="stmcheck" name="stmcheck" type="checkbox" value="Smt">
            <label for="stmcheck">Smt</label>
            <br>
            <input id="versioncheck" name="versioncheck" type="checkbox" value="Version">
            <label for="versioncheck">Version</label>
        </div>

    </fieldset>

</div>

<pre class="output"></pre>

<script src="js/lib/ace.js"></script>
<script src="js/lib/theme-monokai.js"></script>
<script src="js/ide.js"></script>

<script>
    $(document).ready(function (){
        $(document).on('change', '#file', function (){
            var property = document.getElementById("file").files[0];
            var file_name = property.name;
            var file_extension = file_name.split(".").pop().toLowerCase();
            if(jQuery.inArray(file_extension, ['txt','alk','in'])== -1){
                alert("invalid type file");
            }
            var file_size = property.size;
            if(file_size > 20000000){
                alert("invalid size");
            }
            else {
                var form_data = new FormData();
                form_data.append("file", property);
                $.ajax({
                    url:"../app/uploadInput.php",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend:function(){
                        $('#uploaded_file').html("<label class='text-succes'> File Uploading...</label>");
                    },
                    success:function(data){
                        $('#uploaded_file').html(data);
                    }
                })
            }

        });

    });

</script>

</body>
</html>

