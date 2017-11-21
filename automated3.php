<!DOCTYPE html>
<html>
<head>
	<title>Search Api</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .u-name{
            color: #1DA1F2;
            font-size: 13px !important;
        }
        .tw-text{
            font-size: 12px;
        }
        img{
            padding: 5px;
        }
        h5{
            font-size: 11px;
        }
        .query,.btn-secondary{
            height: 45px !important;
            border-radius: 0px !important;
        }
    </style>
</head>
<body>
<div class="container">
	<div class="row" style="margin-top: 20px">
	  <div class="col-lg-8 col-md-8  col-md-offset-2  col-lg-offset-2" style="padding-left: 0px;">
	    <div class="input-group">
	      <input type="text" class="form-control query" placeholder="Search with hashtag or keywords" aria-label="Search for...">
	      <span class="input-group-btn">
	        <button class="btn btn-secondary" type="button" onclick="fetchData();" style="background-color: #00ad00;color: #fff;">Search</button>
	      </span>
	    </div>
	  </div>
	  <div class="col-lg-6 col-md-6 col-md-offset-2  col-lg-offset-2">
	  		<h5 class="result-count"></h5>
	  </div>
	  <div class="col-lg-6 col-md-6 col-md-offset-2  col-lg-offset-2 t-search">
	    <!-- <div class="row" style="margin-bottom: 10px;background-color: #dcd9d4;">
	      	<div class="col-lg-2">
	      		<img src="http://pbs.twimg.com/profile_images/3272193998/543a36b20c510144e80e41d3d59aeed9_normal.jpeg" class="img-circle" alt="Cinque Terre">
	      	</div>
	      	<div class="col-lg-8">
	      	     <b>Madam Curious</b>@murpharoo
	      	    <div class="tw-text">
	      	          No one denies Muslims the right to practice their religion peacefully in Australia. But any suggestion that they ge… https://t.co/htOZVK1W9O
	      	    </div>
	      	</div>
	    </div> -->
	  </div>
	</div>
</div>
<script type="text/javascript">
	var returnData = '';
	function fetchData(){
	    if($('.query').val().trim()!=''){
            $('.result-count').html('<h4>Please Wait...<h3>');
            $.ajax({
                  type: "POST",
                  url: "automated2.php?act=query",
                  data: {
                      'q':$('.query').val().trim()
                  },
                  success: function(resultData){
                    returnData = JSON.parse(resultData);
                    if(returnData.success=='true'){
                        $('.result-count').text(returnData.counts+' Results  in '+returnData.count_t + " ms");
                        returnData = returnData.data;
                        var htmle = '';
                        $.each(returnData,function(index,object){
                            htmle  += '<div class="row" style="margin-bottom: 10px;background-color: #dcd9d4;padding: 4px 0px;"><div class="col-lg-2"> <img src="'+object.u_thumbnail+'" class="img-circle" alt="Cinque Terre"></div><div class="col-lg-9" style="padding-left: 0;font-size: 11px"> <span class="u-name">'+object.u_name+'</span> <b>@'+object.u_sname+'</b><div class="tw-text">'+object.u_text+'</div></div></div>';
                        });
                        $('.t-search').html(htmle);
                    }else{
                        $('.result-count').html('<h4>Oops something went wrong...<h3>');
                    }
                  }
            });
        }
	}
    $('input[type=text]').on('keydown', function(e) {
        if (e.which == 13) {
            fetchData();
        }
    });
</script>
</body>
</html>
