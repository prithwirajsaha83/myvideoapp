// Loads the Mockable API and the listed videos there
var app = angular.module('videoApp', []);
app.controller('videoController', function($scope, $http) {
    $http.get("https://demo2697834.mockable.io/movies").then(function(response) {
        $scope.videoData = response.data.entries;
       
    });
});

// Loads videos in the video modal
$('#videoModal').on('show.bs.modal', function(e) {

	$('#videoTag').attr("src",$(e.relatedTarget).data('href'));
	$('#modalTitle').html($(e.relatedTarget).data('title'));
	var videoPlayer =  document.getElementById('videoPlayer');
	videoPlayer.load();
	//Send which video viewed to Database
	$.ajax({
			  type: "POST",
			  url: '../pushdata.php',
			  data: {sessionId:$(e.relatedTarget).data('session-id'),videoName:$(e.relatedTarget).data('title')},
			  success: function(data){
				  	if(data>0)
				  	{
				  		//Record Succesfully inserted
				  	}
				  	else{
				  		//Silently fail
				  	}
			  }	  
	});   
});
//When video modal is closed stop playing and reset video
$('#videoModal').on('hidden.bs.modal', function (e) {	
	var videoPlayer =  document.getElementById('videoPlayer');
	videoPlayer.pause();
	videoPlayer.currentTime  = 0;
})
//When video ends close video modal automatically
$("#videoPlayer").bind("ended", function() {
  	$('#videoModal').modal('hide')
});
// Show history in history modal
$('#historyModal').on('show.bs.modal', function(e) {
		$.ajax({
			  type: "POST",
			  url: '../getData.php',
			  data: {sessionId:$(e.relatedTarget).data('session-id')},
			  success: function(data){

					data = JSON.parse(data) ;	
					items = Object.keys(data).length;
					html = "<br/><br/><p>";

					if(items >0)
					{
						$.each(data, function(i, val) {
						 	html = html + "<i>"+val.videoName+"</i><br/>";
						 	//console.log(val.videoName);
						});	 
					}
					else
						html = html + "<i>No videos viewed till now!</i><br/>";	
					html = html+ "</p>";
					$('#modal-body').html(html);
			  }	  
	});   
});