<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Conference Page</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 
Rectangle Template 
http://www.templatemo.com/preview/templatemo_439_rectangle
-->
<!-- <link rel="stylesheet" href="css/normalize.css"> -->
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/templatemo-style.css">
<link rel="stylesheet" href="loading2.css">
<link rel="stylesheet" href="mdui-v0.4.2/css/mdui.css">
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
<script src="js/vendor/jquery-1.10.2.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="mdui-v0.4.2/js/mdui.js"></script>
<script src="js/echarts.js"></script>
<script src="js/jquery-3.2.1.js"></script>
<style type="text/css">
	body {
		text-align: center;
	}
	table {
	padding: 0px;
	margin: 0px auto;
	border: 1px solid #009393;
	border-collapse: collapse;
	}
	td {
	cellpadding: "0";
	cellspacing: "0";
	border: 1px solid #009393;
	height: 35px;
	width:100px;
	margin: 0px auto;
	text-align: center;
	}

	.line1 {
		background: #009393;
		text-align: center;
		color: #ffffff;
		width: 1500px;
		height: 30px;
	}

	.table2 {
		margin-top: 20px;
		margin-bottom: 5px;
/*		width: 800px;*/
	}
</style>
</head>

<div class="sk-wave" id =  "#sk-three-bounce">
            <div class="sk-rect sk-rect1"></div>
            <div class="sk-rect sk-rect2"></div>
            <div class="sk-rect sk-rect3"></div>
            <div class="sk-rect sk-rect4"></div>
            <div class="sk-rect sk-rect5"></div>
        </div>

        <script>
	        (function($){
	         $(window).on("load",function(){  
				    $('.sk-wave').fadeOut(300); 
				});
	     })(jQuery);
        </script>



<body>

	<img src="images/99.jpg" width="100%" height="100%" style="z-index:-100;position:fixed;left:0;top:0">
    <!-- TOP HEADER -->
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <p class="phone-info" style="text-align: left">Call me: 18817893525</p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="http://wpa.qq.com/msgrd?v=3&uin=954223738&site=qq&menu=yes" class="fa fa-qq"></a></li>
                            <li><a href="#" class="fa fa-weixin"></a></li>
                            <li><a href="https://github.com/lllukehuang" class="fa fa-github"></a></li>
                            <li><a href="mailto:LukeHuang@sjtu.edu.cn" class="fa fa-envelope"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .top-header -->

    <div class="mdui-appbar">
		  <div class="mdui-tab mdui-color-indigo" mdui-tab>
		    <a href="#tab1" class="mdui-ripple mdui-ripple-white">
		      <i class="fa fa-book"></i>
		      <label>Detail</label>
		    </a>
		    <a href="#tab2" class="mdui-ripple mdui-ripple-white">
		      <i class="fa fa-pie-chart"></i>
		      <label>Graphs</label>
		    </a>
		    <a href="#tab3" class="mdui-ripple mdui-ripple-white">
		      <i class="fa fa-users"></i>
		      <label>Recommand</label>
		    </a>
		  </div>
	</div>



	<div class="mdui-container-fluid">
  		<div id="tab1">
    <div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2><i class = "fa fa-users"></i>   Conference Page</h2>
		</div>
	</div>
	<?php
		$conference_id = $_GET["conference_id"];
		$link = mysqli_connect("localhost:3306", 'root', '', 'test');
		mysqli_query($link, 'SET NAMES utf8');
		$perNumber = 10;
		$_page = isset($_GET['page'])? $_GET['page'] : 1;
		$start = ($_page-1)*$perNumber;
		$preveoustips = "preveous";
		$nexttips = "next";
		$result = mysqli_query($link, "SELECT ConferenceName from conferences where ConferenceID='$conference_id'");
		$conference_name = mysqli_fetch_array($result)['ConferenceName'];
		if ($conference_name){
			echo "Conference Name: $conference_name<br>";
		}else{
			echo "Conference not found!";
		}
		$tempresult = mysqli_query($link, "SELECT COUNT(*) as number FROM (SELECT PaperID from papers where ConferenceID='$conference_id') as tmp");
		$data = mysqli_fetch_array($tempresult);
		if (!$data) {
		printf("Error: %s\n", mysqli_error($link));
		exit();
		}
		$count = $data['number'];
		if ($count/$perNumber != 0){
			$totalPage = floor($count / $perNumber) +1;
		}else{
			$totalPage = floor($count / $perNumber);
		} //计算出总页数
		if ($totalPage != 1){
				echo "<div class=\"project-pages\">";
				echo "<ul>";
			}
		if ($_page != 1) { //页数不等于1
			$preveous = $_page-1;
		echo "<li><a href=\"/conference.php?conference_id=$conference_id&page=$preveous\">$preveoustips </a></li>";
		}
		if ($totalPage>10){
				if ($_page <=5){
					for ($i=1;$i<=10;$i++) { //循环显示出页面
	                echo "<li><a href=\"/conference.php?conference_id=$conference_id&page=$i\">$i</a></li>";
					}
				}else{
					for ($i=5;$i>=0;$i--) { //循环显示出页面
						$current = $_page-$i;
	                echo "<li><a href=\"/conference.php?conference_id=$conference_id&page=$current\">$current</a></li>";
	            	}
	            	for ($i=1;$i<=4;$i++) { //循环显示出页面
						$current = $_page+$i;
	                echo "<li><a href=\"/conference.php?conference_id=$conference_id&page=$current\">$current</a></li>";
	            	}
			}}else{
				for ($i=1;$i<=$totalPage;$i++) { //循环显示出页面
				echo "<li><a href=\"/conference.php?conference_id=$conference_id&page=$i\">$i </a></li>";
				}
			}
		if ($_page<$totalPage) { //如果page小于总页数,显示下一页链接
			$next = $_page+1; 
		echo "<li><a href=\"/conference.php?conference_id=$conference_id&page=$next\">$nexttips </a></li>";
		}
		if ($totalPage != 1){
				echo "</ul>";
				echo "</div>";
			}

		$sql = "SELECT PaperID,Title,PaperPublishYear from papers where ConferenceID='$conference_id' limit ".$start.", $perNumber";
		$result = mysqli_query($link, $sql);
		if ($result) {
			echo "<table>";
			echo "<tr>";
			echo "<td class=\"line1\">";
			echo "RESULT";
			echo "</td>";
			echo "</tr>";
			echo "<tr><td>";
			echo "<table class = \"table2\" border=\"1\" align = center width = 90%><tr><td><b>Title</b></td><td><b>Authors</b></td><td><b>Paper Publish Year</b></td></tr>";
			while ($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				$paper_id = $row['PaperID'];
				$paper_title = $row['Title'];
				$paperpublishyear = $row['PaperPublishYear'];
				if ($paper_id){
					echo "<td width = 50%><a href=\"/paper.php?paper_id=$paper_id\">$paper_title </a></td>";
				}else{
					echo "<td width = 50%>not found!</td>";
				}
				

				echo "<td width = 30%>";
				if ($paper_id){
						$author_info = mysqli_query($link, "SELECT AuthorName FROM paper_author_affiliation INNER JOIN authors ON paper_author_affiliation.AuthorID = authors.AuthorID WHERE PaperID = '$paper_id' ORDER BY paper_author_affiliation.AuthorSequence desc");
						if ($author_info){
							while ($obj = mysqli_fetch_object($author_info)) {
								$author_id = mysqli_fetch_array(mysqli_query($link, "SELECT AuthorID from authors where AuthorName='$obj->AuthorName'"))['AuthorID'];
								echo "<a href=\"/author.php?author_id=$author_id\">$obj->AuthorName; </a>";
							}
						}
					}else{
						echo "not found";
					}
				echo "</td>";

				echo "<td width = 10%>";
				if ($paper_id){
					echo $paperpublishyear;
				}else{
					echo "not found!";
				}
				echo "</td>";
				echo "</tr>";
			}
			echo "</table></td></tr><br><br>";
		}
		echo "</table>";
	?>

</div>

	<div id = "tab2">
		 <div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2><i class = "fa fa-pie-chart"></i>   Information Graphs</h2>
		</div>
		</div>
		<?php
			$confy = "SELECT temp1.PaperPublishYear,count(*) as cnt from (SELECT PaperPublishYear from test.papers where ConferenceID = '$conference_id') as temp1 inner join (SELECT distinct PaperPublishYear from test.papers where ConferenceID = '$conference_id') as temp2 on temp2.PaperPublishYear = temp1.PaperPublishYear group by PaperPublishYear order by PaperPublishYear asc";
			$confresult = mysqli_fetch_all(mysqli_query($link,$confy));
			$confyear = array();
			$confpaper = array();
			foreach ($confresult as $conre) {
				array_push($confyear, $conre[0]);
				array_push($confpaper, $conre[1]);
			}
			echo "<script type=\"text/javascript\"> var confyear = ".json_encode($confyear).";";
			echo "var confpaper =".json_encode($confpaper).";</script>";
		?>
		<div  id="main1" style="width:1200px;height:800px;"></div>
		<script type="text/javascript">

			var myChart = echarts.init(document.getElementById('main1'));
			option = {
				// color:'#69C990',
				color: {
			    type: 'linear',
			    x: 0,
			    y: 0,
			    x2: 0,
			    y2: 1,
			    colorStops: [{
			        offset: 0, color: '#55DDDD' // 0% 处的颜色
			    },{
			    	offset:0.5,color:'blue'
			    },
			    {
			        offset: 1, color: '#69C990' // 100% 处的颜色
			    }],
			    globalCoord: false // 缺省为 false
				},
				// color: {
				//     type: 'radial',
				//     x: 0,
				//     y: 0,
				//     r: 1,
				//     colorStops: [{
				//         offset: 0, color: 'blue' // 0% 处的颜色
				//     }, {
				//         offset: 1, color: '#69C990' // 100% 处的颜色
				//     }],
				//     globalCoord: false // 缺省为 false
				// },
				title:{
					text:'Publication Graph'
				},
			    angleAxis: {
			        type: 'category',
			        data: confyear,
			        axisLabel: {
                			textStyle: {color: '#33cccc'}
                			},
			        z: 10
			    },
			    tooltip:{
			    	show:true,
			    	formatter: function(params){
			    		var id = params.dataIndex;
			    		return confyear[id]+'<br>Papers: '+ confpaper[id];
			    	}
			    },
			    radiusAxis: {
			    	axisLabel: {
                			textStyle: {color: '#33cccc'}
                			}
			    },
			    polar: {
			    },
			    series: [{
			        type: 'bar',
			        itemstyle:{
			        	normal:{
			        		color: new echarts.graphic.LinearGradient(
                			0, 0, 0, 1,
                			[
			                    {offset: 0, color: '#000'},
			                    {offset: 0.5, color: '#888'},
			                    {offset: 1, color: '#ddd'}
			                ]
			                )
			        	},
			        	label:{
			        		show: true,
	                        position: 'right',
	                        formatter: "{b}",
	                        textStyle: {
	                            color: '#C4F6F6',
	                            fontSize: 15
	                        }
			        	}
			        },
			        data: confpaper,
			        coordinateSystem: 'polar',
			    }],
			};
			myChart.setOption(option);

		</script>
	</div>

	<div id = "tab3">
		 <div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2><i class="fa fa-users"></i>   Recommend Information</h2>
		</div>

		<div class="mdui-container">
		  <div class="mdui-row">
		    <div class="mdui-col-sm-4 mdui-col-md-4">
		      <div class="mdui-card" style="width: 400px;height: 400px;">
		        <div class="mdui-card-media">
		          <img src="images/cc/00.jpg" style="width: 400px;height: 400px;">
		          <div class="mdui-card-media-covered">
		            <div class="mdui-card-primary">
		              <div class="mdui-card-primary-title" style="text-align: left;">Recommend Papers</div>
		              <div class="mdui-card-primary-subtitle" style="text-align: left;">Have A Try!</div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>

		<?php
			$refpaper = "SELECT Title,t.PaperID,t.cnt from (select temp.PaperID,count(*) as cnt from (select PaperID from test.papers where ConferenceID = '$conference_id') as temp inner join test.paper_reference on paper_reference.ReferenceID = temp.PaperID group by PaperID order by cnt desc) as t inner join test.papers on papers.PaperID = t.PaperID order by cnt desc";
			$refresult = mysqli_fetch_all(mysqli_query($link,$refpaper));
			$index = 0;
			while ($index < 8 ){
				$refid = $refresult[$index][1];
				$refname = $refresult[$index][0];
				$indexi = $index +1;
			    echo "<div class=\"mdui-col-sm-2 mdui-col-md-2\">
			      <div class=\"mdui-card\" style=\"width: 200px;height: 200px;\">
			        <div class=\"mdui-card-media\">
			          <img src=\"images/cc/$indexi.jpg\" style=\"width: 200px;height: 200px;\">
			          <div class=\"mdui-card-media-covered\">
			            <div class=\"mdui-card-primary\">";
			              echo "<div class=\"mdui-card-primary-subtitle\" style=\"text-align: left;\"><a href=\"/paper.php?paper_id=$refid\" style=\"color:#94F3F3;font-size:15px;\">$refname </a></div>";
			              // echo "<div class=\"mdui-card-primary-subtitle\" style=\"text-align: left;\"></div>";
			            echo "</div>
			          </div>
			        </div>
			      </div>
			    </div>";
			    $index +=1;
			}
		?>
		</div>
		</div>
	</div>
</div>
</div>

<a href="/index.html#now">
    <button>Return Homepage</button>
</a>
<div class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                	Copyright &copy; 2019 SJTU IEEE Pilot Class
                
            <!-- | Design: <a href="http://www.templatemo.com" target="_parent"><span class="green">free templates</span></a> -->
                </p>
            </div>
        </div>
    </div>
</div> 
</body>
</html>
