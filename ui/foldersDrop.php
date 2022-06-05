<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Folders</title>
    <link rel="stylesheet" href="CSS/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>


<body>
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
            <li>
                <form class="login-logout-form" action="goToLoginPage.php" method="post">
                    <button class="btn">Login</button>
                </form>
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
<br>
<h2>My projects</h2>
<br />
<br /><br />
<div class="container">
    <div class="project-btn-container">
        <button type="button" name="create_folder" id="create_folder" class="btn">Create folder</button>
        <div class="upload-dir-div">
            <h3>Upload Project</h3>
            <div class="picker"><input class="btn-choose-files" type="file" id="picker" name="fileList" webkitdirectory multiple></div>

            <h3>Percentage</h3>
            <span id="box">0%</span>

            <h3>Files Uploaded</h3>
            <!-- <ul id="listing"></ul> -->
            <span id="listing"></span>
        </div>
    </div>
    <br>
    <div id="folder_table" class="table-responsive"></div>
</div>

</body>
</html>

<div id="folderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismis="modal">&times;</button>
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

<div id="uploadModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismis="modal">&times;</button>
                <h4 class="modal-title">
                    <span id="change_title">Upload File</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" id="upload_form" enctype='multipart/form-data'>
                    <p>Select Image
                        <input type="file" name="upload_file" /></p>
                    <br />
                    <input type="hidden" name="hidden_folder_name" id="hidden_folder_name" />
                    <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="fileListModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismis="modal">&times;</button>
                <h4 class="modal-title">
                    <span id="change_title">File List</span>
                </h4>
            </div>
            <div class="modal-body" id="file_list">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="js/main.js"></script>
<script src="JS/foldershandling.js"></script>


