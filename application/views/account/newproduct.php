<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>

    <body class="fix-header">
        <!-- ============================================================== -->
        <!-- Preloader -->
        <!-- ============================================================== -->
        <?php $this->load->view('account/template/preloader'); ?> 
        <!-- ============================================================== -->
        <!-- Wrapper -->
        <!-- ============================================================== -->
        <div id="wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <?php $this->load->view('account/template/nav'); ?>  
            <!-- End Top Navigation -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <?php $this->load->view('account/template/sidebar'); ?> 
            <!-- ============================================================== -->
            <!-- End Left Sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page Content -->
            <!-- ============================================================== -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">สินค้า</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                            <ol class="breadcrumb">
                                <li ><a href="#" >คลังสินค้า</a></li> 
                                <li><a href="#" >สินค้า</a></li> 
                                <li class="active">เพิ่มสินค้า</li> 
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================================== -->
                    <!-- Different data widgets -->
                    <!-- ============================================================== -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> With Border Form</div>
                                <div class="panel-wrapper collapse in" aria-expanded="true">
                                    <div class="panel-body">
                                        <form action="#" class="form-horizontal form-bordered">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">First Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" placeholder="small" class="form-control"> <span class="help-block"> This is inline help </span> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Last Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" placeholder="medium" class="form-control"> <span class="help-block"> This is inline help </span> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Gender</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control">
                                                            <option value="">Male</option>
                                                            <option value="">Female</option>
                                                        </select> <span class="help-block"> Select your gender. </span> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Date of Birth</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Category</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control">
                                                            <option value="Category 1">Category 1</option>
                                                            <option value="Category 2">Category 2</option>
                                                            <option value="Category 3">Category 5</option>
                                                            <option value="Category 4">Category 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Multi-Value Select</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" multiple="">
                                                            <optgroup label="NFC EAST">
                                                                <option>Dallas Cowboys</option>
                                                                <option>New York Giants</option>
                                                                <option>Philadelphia Eagles</option>
                                                                <option>Washington Redskins</option>
                                                            </optgroup>
                                                            <optgroup label="NFC NORTH">
                                                                <option>Chicago Bears</option>
                                                                <option>Detroit Lions</option>
                                                                <option>Green Bay Packers</option>
                                                                <option>Minnesota Vikings</option>
                                                            </optgroup>
                                                            <optgroup label="NFC SOUTH">
                                                                <option>Atlanta Falcons</option>
                                                                <option>Carolina Panthers</option>
                                                                <option>New Orleans Saints</option>
                                                                <option>Tampa Bay Buccaneers</option>
                                                            </optgroup>
                                                            <optgroup label="NFC WEST">
                                                                <option>Arizona Cardinals</option>
                                                                <option>St. Louis Rams</option>
                                                                <option>San Francisco 49ers</option>
                                                                <option>Seattle Seahawks</option>
                                                            </optgroup>
                                                            <optgroup label="AFC EAST">
                                                                <option>Buffalo Bills</option>
                                                                <option>Miami Dolphins</option>
                                                                <option>New England Patriots</option>
                                                                <option>New York Jets</option>
                                                            </optgroup>
                                                            <optgroup label="AFC NORTH">
                                                                <option>Baltimore Ravens</option>
                                                                <option>Cincinnati Bengals</option>
                                                                <option>Cleveland Browns</option>
                                                                <option>Pittsburgh Steelers</option>
                                                            </optgroup>
                                                            <optgroup label="AFC SOUTH">
                                                                <option>Houston Texans</option>
                                                                <option>Indianapolis Colts</option>
                                                                <option>Jacksonville Jaguars</option>
                                                                <option>Tennessee Titans</option>
                                                            </optgroup>
                                                            <optgroup label="AFC WEST">
                                                                <option>Denver Broncos</option>
                                                                <option>Kansas City Chiefs</option>
                                                                <option>Oakland Raiders</option>
                                                                <option>San Diego Chargers</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Membership</label>
                                                    <div class="col-md-9">
                                                        <div class="radio-list">
                                                            <label>
                                                                <input type="radio" name="optionsRadios2" value="option1"> Free </label>
                                                            <label>
                                                                <input type="radio" name="optionsRadios2" value="option2" checked=""> Professional </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Street</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">City</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">State</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Post Code</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"> </div>
                                                </div>
                                                <div class="form-group last">
                                                    <label class="control-label col-md-3">Country</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control"> </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                                                <button type="button" class="btn btn-default">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <?php $this->load->view('account/template/footer'); ?> 
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="<?= base_url("res/account/plugins/bower_components/jquery/dist/jquery.min.js") ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url("res/account/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
        <!-- Menu Plugin JavaScript -->
        <script src="<?= base_url("res/account/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js") ?>"></script>
        <!--slimscroll JavaScript -->
        <script src="<?= base_url("res/account/js/jquery.slimscroll.js") ?>"></script> 
        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url("res/account/js/custom.min.js") ?>"></script> 
        <script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
        <!--Style Switcher -->
        <script src="<?= base_url("res/account/plugins/bower_components/styleswitcher/jQuery.style.switcher.js") ?>"></script>
    </body>

</html>
