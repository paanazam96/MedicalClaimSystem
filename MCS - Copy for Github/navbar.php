<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light shadow p-3 mb-5 rounded" style="background-color: #e3f2fd;">
    <img src="imgs/Untitled-1.png" style="width: 200px; height: 50px;">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="welcomepage.php">Home</a>
            </li>
            <li class="dropdown">
                <a class="nav-link" href="welcomepage.php" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add Details
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="staffadd.php">Add Staff</a>
                    <a class="dropdown-item" href="deptlist.php">Add Department</a>
                    <a class="dropdown-item" href="companylist.php">Add Company</a>
                    <a class="dropdown-item" href="cliniclist.php">Add Clinic</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="staffsummary.php?id=">Staff Summary</a>
            </li>
            <li class="nav-item" style="margin-left: 130px;">
                <h3 style="font-family:Trebuchet MS;">Medical Claim System</h3>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a class="nav-link" href="logout.php" style="color: red;">Logout</a>
        </form>
    </div>
</nav> 
<!-- /Navbar -->