<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand">IIIT-Ongole</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a href="welcome.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="issue_outpass.php"  class="nav-link">Issue Outpass</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                    Student list
                </a>
                <div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                    <a href="total_studentlist.php" class="nav-link">Total students</a>
                    <a href="in_studentlist.php" class="nav-link">Students In</a>
                    <a href="out_studentlist.php" class="nav-link">Students Out</a>
                </div>
            </li>

            <li class="nav-item">
                <a href="student_details_page.php" class="nav-link">Student details</a>
            </li>
            <li class="nav-item">
                <?php if($_SESSION['Role'] == 'WARDEN' ||$_SESSION['Role'] == 'D_WARDEN' ){ ?>
                <a href="InSign.php" class="nav-link">InSign</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <a href="approve.php" class="nav-link">Approved List</a>
            </li>
            <li class="nav-item">
                <a href="includes/logout.php" class="nav-link">Logout</a>
            </li>

        </ul>

    </div>


</nav>
<?php { ?>
   
    <script type="text/javascript">
    $(document).ready(function() {
        $('nav li').click(function() {
            $('nav li').removeClass('active');
            $(this).addClass('active');
        });
    });

</script>
<?php } ?>

