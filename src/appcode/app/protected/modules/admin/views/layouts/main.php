<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - Ace Admin</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="/assets/ext/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/ext/bootstrap/font-awesome/4.1.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="/assets/ext/bootstrap/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="/assets/ext/bootstrap/css/ace.min.css" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/assets/ext/bootstrap/css/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="/assets/ext/bootstrap/css/ace-skins.min.css" />
    <link rel="stylesheet" href="/assets/ext/bootstrap/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/assets/ext/bootstrap/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="/assets/ext/bootstrap/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="/assets/ext/bootstrap/js/html5shiv.min.js"></script>
    <script src="/assets/ext/bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="javascript:void(0)" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    greatming Blog
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">


                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="/assets/ext/bootstrap/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
                                    <?php echo  Yii::app()->params['user_info']['user_name'];?>
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                        <li>
                            <a href="javascript:void(0)" id="logout">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<div class="main-container" id="main-container">
<!-- basic scripts -->

<!--[if !IE]> -->
<script src="/assets/ext/bootstrap/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="/assets/ext/bootstrap/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets/ext/bootstrap/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    try{ace.settings.check('main-container' , 'fixed')}catch(e){}
</script>

<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">

    </div><!-- /.sidebar-shortcuts -->
    <ul class="nav nav-list">
        <?php foreach(Yii::app()->params['menu'] as $key=> $menu_node) { ?>
            <?php if($this->getId() == $menu_node['channel']){ ?>
                <li class="active open">
            <?php }else{?> <li class=""> <?php } ?>
            <a href="#" <?php if($menu_node['is_arrow']){?>class="dropdown-toggle"<?php }?>>
                <i class="menu-icon fa <?php echo $menu_node['ico'];?>"></i>
                <span class="menu-text"> <?php echo $menu_node['name'];?> </span>
                <?php if($menu_node['is_arrow']){?>
                    <b class="arrow icon-angle-down"></b>
                <?php }?>
            </a>
            <?php if($menu_node['is_arrow']){?>
                <ul class="submenu">
                    <?php foreach($menu_node['arrow_list'] as $arrow){?>
                        <li <?php if(in_array($this->getAction()->getId(),$arrow['action'])){?>class="active"<?php }?>>
                            <?php $create_url = $this->getId()."/".$arrow['action'][0];?>
                            <a href="<?php echo $this->createUrl($create_url);?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                <?php echo $arrow['name'];?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            </li>
        <?php } ?>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="/admin/index">首页</a>
            </li>
            <li class="active"><?php echo Yii::app()->params['channel_name'];?></li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-content-area">
            <div class="page-header">
                <h1>
                    <?php echo Yii::app()->params['channel_name'];?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        <?php echo Yii::app()->params['action_name'];?>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <?php echo $content; ?>
                </div><!-- /.row -->
            </div><!-- /.page-content-area -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Blog</span>
							Application &copy; 2014
						</span>

                &nbsp; &nbsp;
            </div>
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->


<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='/assets/ext/bootstrap/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="/assets/ext/bootstrap/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
<script src="/assets/ext/bootstrap/js/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/ext/bootstrap/js/jquery-ui.custom.min.js"></script>
<script src="/assets/ext/bootstrap/js/jquery.ui.touch-punch.min.js"></script>
<script src="/assets/ext/bootstrap/js/jquery.easypiechart.min.js"></script>
<script src="/assets/ext/bootstrap/js/jquery.sparkline.min.js"></script>


<!-- ace scripts -->
<script src="/assets/ext/bootstrap/js/ace-elements.min.js"></script>
<script src="/assets/ext/bootstrap/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
    $('.easy-pie-chart.percentage').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
        var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
        var size = parseInt($(this).data('size')) || 50;
        $(this).easyPieChart({
            barColor: barColor,
            trackColor: trackColor,
            scaleColor: false,
            lineCap: 'butt',
            lineWidth: parseInt(size/10),
            animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
            size: size
        });
    })



    //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
    //but sometimes it brings up errors with normal resize event handlers











    var d1 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.5) {
        d1.push([i, Math.sin(i)]);
    }

    var d2 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.5) {
        d2.push([i, Math.cos(i)]);
    }

    var d3 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.2) {
        d3.push([i, Math.tan(i)]);
    }


    var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});



    $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('.tab-content')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }


    $('.dialogs,.comments').ace_scroll({
        size: 300
    });


    //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
    //so disable dragging when clicking on label
    var agent = navigator.userAgent.toLowerCase();
    if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
        $('#tasks').on('touchstart', function(e){
            var li = $(e.target).closest('#tasks li');
            if(li.length == 0)return;
            var label = li.find('label.inline').get(0);
            if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
        });

    $('#tasks').sortable({
            opacity:0.8,
            revert:true,
            forceHelperSize:true,
            placeholder: 'draggable-placeholder',
            forcePlaceholderSize:true,
            tolerance:'pointer',
            stop: function( event, ui ) {
                //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                $(ui.item).css('z-index', 'auto');
            }
        }
    );
    $('#tasks').disableSelection();
    $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
        if(this.checked) $(this).closest('li').addClass('selected');
        else $(this).closest('li').removeClass('selected');
    });


    //show the dropdowns on top or bottom depending on window height and menu position
    $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
        var offset = $(this).offset();

        var $w = $(window)
        if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
            $(this).addClass('dropup');
        else $(this).removeClass('dropup');
    });

    $("#logout").on("click",function(){
        logout();
    })


})
var logout = function(){
    var logut_url = "<?php echo $this->createUrl("public/SLogout");?>";
    $.post(logut_url,{},function(){
        window.location.href = "<?php echo $this->createUrl("public/login");?>"
    })
}
</script>
</body>
</html>
