<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $this->actionTitle;?> - <?php echo $this->appName;?></title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/font-awesome/4.1.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/css/ace.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/css/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/css/ace-ie.min.css" />
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/js/html5shiv.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-layout">
<div class="main-container">
<div class="main-content">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="login-container">
<div class="center">
    <h1>
        <i class="ace-icon fa fa-leaf green"></i>
        <span class="red">greatming</span>
        <span class="white" id="id-text2">blog</span>
    </h1>
    <h4 class="blue" id="id-company-text">&copy; Company Name</h4>
</div>

<div class="space-6"></div>

<div class="position-relative">
    <div id="login-box" class="login-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header blue lighter bigger">
                    <i class="ace-icon fa fa-coffee green"></i>
                    Please Enter Your Information
                </h4>

                <div class="space-6"></div>

                <form>
                    <fieldset>
                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
                        </label>

                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
                        </label>

                        <div class="space"></div>

                        <div class="clearfix">

                            <button type="button" class="width-35 pull-right btn btn-sm btn-primary submit">
                                <i class="ace-icon fa fa-key"></i>
                                <span class="bigger-110">Login</span>
                            </button>
                        </div>

                        <div class="space-4"></div>
                    </fieldset>
                </form>
                <div class="alert alert-danger error_info" style="display: none" role="alert"></div>
                <div class="space-6"></div>


            </div><!-- /.widget-main -->

            <div class="toolbar clearfix">
            </div>
        </div><!-- /.widget-body -->
    </div><!-- /.login-box -->

</div><!-- /.position-relative -->

</div>
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets/ext/bootstrap/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='/assets/ext/bootstrap/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    
    //you don't need this, just used for changing background
    jQuery(function($) {
        $(".submit").on("click",function(){
            login();
        })
        $(document).keypress(function(e) {
            // 回车键事件
            if(e.which == 13) {
                login();
            }
        });
    });

    var login = function(){
        $user_name = $("input[name='username']").val();
        $password = $("input[name='password']").val();
        $post_url = "<?php echo $this->createUrl("public/SLogin");?>";
        $.post($post_url,{
            "LoginForm[username]":$user_name,
            "LoginForm[password]":$password
        },"","json").done(function(ret){
            if(ret.status == 1){
                window.location.href = "<?php echo $this->createUrl("index/index");?>"
            }else{
                if(ret.info.username){
                    var error_info = ret.info.username[0];
                }else{
                    var error_info = ret.info.password[0];
                }
                $(".error_info").text(error_info).show();
            }
        })
    }
</script>
</body>
</html>
