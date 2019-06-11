<!DOCTYPE html> 
<html>
<!-- <html class="no-js"> -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Paper Page</title>
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
<link rel="stylesheet" href="mdui-v0.4.2/css/mdui.css">
<link rel="stylesheet" href="loading2.css">
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
<script src="js/vendor/jquery-1.10.2.min.js"></script>
<script src="mdui-v0.4.2/js/mdui.js"></script>
<script src="js/plugins.js"></script>
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
		      <i class="fa fa-user"></i>
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
					<h2>Paper Page</h2>
				</div>
			</div>
	<?php
		$paper_id = $_GET["paper_id"];
		$link = mysqli_connect("localhost:3306", 'root', '', 'test');
		mysqli_query($link, 'SET NAMES utf8');
		// echo "<div class = \"row\">";
		// echo "<div class = \"col-md-6\">";
		echo "<table>";
		echo "<tr>";
		echo "<td class=\"line1\">";
		echo "RESULT";
		echo "</td>";
		echo "</tr>";
		echo "<tr><td>";
		echo "<table class = \"table2\" border=\"1\" align = center width = 90%>";
		echo "<tr><td width = 30%><b>PaperID</b></td>";
		echo "<td width = 60%>";
		if ($paper_id){
			echo $paper_id;
		}else{
			echo "not found!";
		}
		echo "</td>";
		echo "</tr>";
		$result = mysqli_query($link, "SELECT Title,PaperPublishYear,ConferenceID from papers where PaperID='$paper_id'");
		$res = mysqli_fetch_array($result);
		$title = $res['Title'];
		$paperpublishyear = $res['PaperPublishYear'];
		$conference_id = $res['ConferenceID'];
		echo "<tr>";
		echo "<td><b>Title</b></td>";
		if ($title){
			echo "<td>$title</td>";
		}else{
			echo "<td>not found!</td>";
		}
		echo  "</tr>";
		echo "<tr>";
		echo "<td><b>PaperPublishYear</b></td>";
		if ($paperpublishyear){
			echo "<td>$paperpublishyear</td>";
		}else{
			echo "<td>not found!</td>";
		}
		echo "</tr>";
		echo "<tr>";
		echo "<td><b>Authors</b></td>";
		echo "<td>";
		$author_info = mysqli_query($link, "SELECT AuthorName FROM paper_author_affiliation INNER JOIN authors ON paper_author_affiliation.AuthorID = authors.AuthorID WHERE PaperID = '$paper_id' ORDER BY paper_author_affiliation.AuthorSequence asc");
		if ($author_info){
			while ($obj = mysqli_fetch_object($author_info)) {
				$author_id = mysqli_fetch_array(mysqli_query($link, "SELECT AuthorID from authors where AuthorName='$obj->AuthorName'"))['AuthorID'];
				echo "<a href=\"/author.php?author_id=$author_id\">$obj->AuthorName; </a>";
			}
		}else{
		echo "<td>not found!";
		}
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><b>ConferenceName</b></td>";
		$result = mysqli_query($link, "SELECT ConferenceName FROM papers INNER JOIN conferences ON papers.ConferenceID = conferences.ConferenceID WHERE PaperID = '$paper_id'");
		$conference_name = mysqli_fetch_array($result)['ConferenceName'];
		if ($conference_name){
			echo "<td><a href=\"/conference.php?conference_id=$conference_id\">$conference_name </a></td>";
		}else{
			echo "<td>not found!</td>";
		}
		echo "</tr>";
		echo "</table></td></tr>";
		echo "</table>";
		// echo "</div></div>";

		// Recommand Essays
		$refpaper = "SELECT Title,PaperID from (select ReferenceID,count(*) as cnt from (select ReferenceID as ref from test.paper_reference where PaperID = '$paper_id') as temp inner join test.paper_reference on paper_reference.ReferenceID = temp.ref group by ReferenceID order by cnt desc) as tt inner join test.papers where papers.PaperID = tt.ReferenceID";
		$result1 = mysqli_fetch_all(mysqli_query($link,$refpaper));
		$result2 = mysqli_fetch_all(mysqli_query($link,"SELECT Title,papers.PaperID from (select PaperID from test.paper_reference where paper_reference.ReferenceID = '$paper_id') as temp inner join test.papers where papers.PaperID = temp.PaperID"));
		$index = 0;
		$allnum1 = count($result1);
		$allnum2 = count($result2);
		// echo "<div class=\"mdui-rows\">";
		?>


		</div>

		<div id = "tab2">
			<div class="homepage home-section text-center">
		        <div class="welcome-text">
					<h2><i class="fa fa-pie-chart"></i>  Information Charts</h2>
				</div>
			</div>
			<?php
				$aff = "SELECT Title from (SELECT ReferenceID from test.paper_reference where PaperID = '$paper_id') as temp inner join test.papers on papers.PaperID = temp.ReferenceID";
				$affresult = mysqli_fetch_all(mysqli_query($link,$aff));
				$affname = array();
				foreach ($affresult as $af) {
					array_push($affname, $af[0]);
				}
				echo "<script type=\"text/javascript\"> var affname = ".json_encode($affname).";";
				echo "var pname = \"$title\";</script>";

			?>
				<div  id="main0" style="width:1200px;height:800px;"></div>
					<script type="text/javascript">
						var ddata = new Array();
						for (let i=0;i<affname.length;i++)
						{
							ddata.push({"name":affname[i]});
						}

						var myChart = echarts.init(document.getElementById('main0'));
					option = {
				    title : {
				        text: 'Reference Papers',
				        textStyle: {
		                            color: 'white',
		                            fontSize: 15
		                        }
				    },
				    toolbox: {
				        show : true,
				        feature : {
				            mark : {show: true},
				            dataView : {show: true, readOnly: false},
				            restore : {show: true},
				            saveAsImage : {show: true}
				        }
				    },
				    series : [
				        {
				            name:'树图',
				            type:'tree',
				            orient: 'horizontal',  // vertical horizontal
				            rootLocation: {x:'center',y:'10%'}, // 根节点位置  {x: 100, y: 'center'}
				            nodePadding: 20,
				            layerPadding: 30,
				            hoverable: false,
				            roam: true,
				            symbol:'circle',
				            symbolSize: 20,
				            itemStyle: {
				                normal: {
				                    color: '#55AA88',
				     //                color: {
									//     type: 'radial',
									//     x: 0,
									//     y: 0,
									//     r: 20,
									//     colorStops: [{
									//         offset: 0, color: 'blue' // 0% 处的颜色
									//     }, {
									//         offset: 1, color: '#69C990' // 100% 处的颜色
									//     }],
									//     globalCoord: false // 缺省为 false
									// },
				                    label: {
				                        show: true,
				                        position: 'below',
				                        formatter: "{b}",
				                        textStyle: {
				                            color: '#C4F6F6',
				                            fontSize: 15
				                        }
				                    },
				                    lineStyle: {
				                        color: '#72E3CC',
				                        type: 'curve' // 'curve'|'broken'|'solid'|'dotted'|'dashed'

				                    }
				                },
				                emphasis: {
				                    color: '#4883b4',
				                    // label: {
				                    //     show: false
				                    // },
				                    borderWidth: 0
				                }
				            },
				            data: [{"name": pname,"children": ddata}]
				        }
				    ]
				};
					myChart.setOption(option);


			</script>

		<?php
				$affed = "SELECT Title from (SELECT PaperID from test.paper_reference where ReferenceID = '7623A9D5') as temp inner join test.papers on papers.PaperID = temp.PaperID";
				$affedresult = mysqli_fetch_all(mysqli_query($link,$affed));
				$affedname = array();
				foreach ($affedresult as $af) {
					array_push($affedname, $af[0]);
				}
				echo "<script type=\"text/javascript\"> var affedname = ".json_encode($affedname).";</script>";

			?>
		<div  id="main1" style="width:1200px;height:800px;"></div>
					<script type="text/javascript">
						var dddata = new Array();
						for (let i=0;i<affedname.length;i++)
						{
							dddata.push({"name":affedname[i]});
						}

						var myChart = echarts.init(document.getElementById('main1'));
					option = {
				    title : {
				        text: 'Citations',
				        textStyle: {
		                            color: 'white',
		                            fontSize: 15
		                        }
				    },
				    toolbox: {
				        show : true,
				        feature : {
				            mark : {show: true},
				            dataView : {show: true, readOnly: false},
				            restore : {show: true},
				            saveAsImage : {show: true}
				        }
				    },
				    series : [
				        {
				            name:'树图',
				            type:'tree',
				            orient: 'RL',  // vertical horizontal
				            rootLocation: {x:'center',y:'10%'}, // 根节点位置  {x: 100, y: 'center'}
				            nodePadding: 20,
				            layerPadding: 30,
				            hoverable: false,
				            roam: true,
				            symbol:'circle',
				            symbolSize: 20,
				            itemStyle: {
				                normal: {
				                    color: '#55AA88',
				                    label: {
				                        show: true,
				                        position: 'left',
				                        formatter: "{b}",
				                        textStyle: {
				                            color: '#C4F6F6',
				                            fontSize: 15
				                        }
				                    },
				                    lineStyle: {
				                        color: '#72E3CC',
				                        type: 'curve' // 'curve'|'broken'|'solid'|'dotted'|'dashed'

				                    }
				                },
				                emphasis: {
				                    color: '#4883b4',
				                    // label: {
				                    //     show: false
				                    // },
				                    borderWidth: 0
				                }
				            },
				            data: [{"name": pname,"children": dddata}]
				        }
				    ]
				};
					myChart.setOption(option);


			</script>
</div>



		<div id = "tab3">
			<div class="homepage home-section text-center">
		        <div class="welcome-text">
					<h2><i class="fa fa-users"></i>  Recommend Information</h2>
				</div>
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
		    while ($index < 8 and $index < $allnum1) {
				$recid = $result1[$index][1];
				$recname = $result1[$index][0];
				$indexi =$index +1;
			    echo "<div class=\"mdui-col-sm-2 mdui-col-md-2\">
			      <div class=\"mdui-card\" style=\"width: 200px;height: 200px;\">
			        <div class=\"mdui-card-media\">
			          <img src=\"images/cc/$indexi.jpg\" style=\"width: 200px;height: 200px;\">
			          <div class=\"mdui-card-media-covered\">
			            <div class=\"mdui-card-primary\">";
			              echo "<div class=\"mdui-card-primary-subtitle\" style=\"text-align: left;\"><a href=\"/paper.php?paper_id=$recid\" style=\"color:#94F3F3;font-size:15px;\">$recname </a></div>";
			              // echo "<div class=\"mdui-card-primary-subtitle\" style=\"text-align: left;\"></div>";
			            echo "</div>
			          </div>
			        </div>
			      </div>
			    </div>";
			    $index +=1;
			}
			while ($index < 8 and $index < $allnum2) {
				$recid = $result2[$index][1];
				$recname = $result2[$index][0];
				$indexi = $index +1;
			    echo "<div class=\"mdui-col-sm-2 mdui-col-md-2\">
			      <div class=\"mdui-card\" style=\"width: 200px;height: 200px;\">
			        <div class=\"mdui-card-media\">
			          <img src=\"images/cc/$indexi.jpg\" style=\"width: 200px;height: 200px;\">
			          <div class=\"mdui-card-media-covered\">
			            <div class=\"mdui-card-primary\">";
			              echo "<div class=\"mdui-card-primary-subtitle\" style=\"text-align: left;\"><a href=\"/paper.php?paper_id=$recid\" style=\"color:#94F3F3\">$recname </a></div>";
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