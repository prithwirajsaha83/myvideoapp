<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>My video app</title>

<!-- Bootstrap -->
<link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="css/override.css" rel="stylesheet">
</head>
<body>

<div class="container" ng-app="videoApp" ng-controller="videoController">
  <div class="row" style="background-color:#c5c5c5;height:120px;">
        <div class="col-sm-6">
           Home
        </div>
         <div class="col-sm-6" style="text-align: right;">
            <a data-target="#historyModal" data-toggle="modal" class="openModalHistory" data-session-id="<?php echo session_id();?>">
              Viewed video History
             </a>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <div class="well">
                <div id="myCarousel" class="carousel fdi-Carousel slide">
                 <!-- Carousel items -->
                    <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                        <div class="carousel-inner onebyone-carosel" >

                           <div class="item" ng-class="{'active': $first==true}" ng-repeat="video in videoData" ng-if="$index % 4 == 0">

                               <div class="col-md-4" >
                                    <a data-href="{{videoData[$index].contents[0].url}}" data-target=".bd-example-modal-lg" data-toggle="modal" class="openModal" data-title="{{videoData[$index].title}}" data-session-id="<?php echo session_id();?>">
                                      <img ng-src="{{videoData[$index].images[0].url!= '' && videoData[$index].images[0].url || 'http://placehold.it/214x317'}}" class="img-responsive center-block">
                                    </a>
                                    <div class="text-center">{{videoData[$index].title}}</div>
                                </div>
                                <div class="col-md-4" >
                                    <a data-href="{{videoData[$index+1].contents[0].url}}" data-target=".bd-example-modal-lg" data-toggle="modal" class="openModal" data-title="{{videoData[$index+1].title}}" data-session-id="<?php echo session_id();?>">
                                      <img ng-src="{{videoData[$index+1].images[0].url!= '' && videoData[$index+1].images[0].url || 'http://placehold.it/214x317'}}" class="img-responsive center-block">
                                    </a>
                                    <div class="text-center">{{videoData[$index+1].title}}</div>
                                </div>
                                <div class="col-md-4" ng-if="$index != 28">
                                    <a data-href="{{videoData[$index+2].contents[0].url}}" data-target=".bd-example-modal-lg" data-toggle="modal" class="openModal" data-title="{{videoData[$index+2].title}}" data-session-id="<?php echo session_id();?>">
                                      <img ng-src="{{videoData[$index+2].images[0].url!= '' && videoData[$index+2].images[0].url || 'http://placehold.it/214x317'}}" class="img-responsive center-block">
                                    </a>
                                    <div class="text-center">{{videoData[$index+2].title}}</div>
                                </div>
                            </div>

                            
                        </div>
                        <a class="left carousel-control" href="#eventCarousel" data-slide="prev"></a>
                        <a class="right carousel-control" href="#eventCarousel" data-slide="next"></a>
                    </div>
                    <!--/carousel-inner-->
                </div><!--/myCarousel-->

 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="videoModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modalTitle"></h4>
        </div>
     <div align="center" class="embed-responsive embed-responsive-16by9">
        <video class="embed-responsive-item" controls="controls" id="videoPlayer">
            <source src="" type="video/mp4" id="videoTag">
        </video>
    </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="historyModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modalTitle">Video's viewed by you</h4>
        </div>
     <div align="center" id="modal-body" class="embed-responsive embed-responsive-16by9">
        
    </div>
    </div>
  </div>
</div>
            </div><!--/well-->
        </div>
    </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/angular/angular.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>