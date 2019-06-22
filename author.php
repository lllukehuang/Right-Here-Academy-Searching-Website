<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Author Page</title>
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
<script src="js/main.js"></script>
<script src="js/echarts.js"></script>
<script src="js/jquery-3.2.1.js"></script>
<style type="text/css">
	body{
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

/*	.div-a{ float:left;width:49%;height: 400px} 
	.div-b{ float:left;width:49%;height: 400px}*/  
</style>
<script type="text/javascript">
        function showImg(){
        document.getElementById("wxImg").style.display='block';
        }
        function hideImg(){
        document.getElementById("wxImg").style.display='none';
        }
        </script>
</head>

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
                            <li><a href="javascript:void(0)" onmouseover="showImg()"><i class = "fa fa-weixin" onclick="hideImg()"></i></a>
                            <div id = "wxImg" style="display:none;width: 100px;height: 100px;padding: 0px;background-color: #fff;border: 1px solid #E5E5E5;overflow: hidden;position: absolute;top: 40px;right: 0px;">
                                <img class="wx" src="qr2.png">
                            </div>
                            </li>
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
		      <label>nearby</label>
		    </a>
		  </div>
		</div>


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

	<div class="mdui-container-fluid">
  		<div id="tab1">
    <div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2><i class="fa fa-user"></i>  Author Homepage</h2>
		</div>
	</div>
	<?php
		$author_id = $_GET["author_id"];
		$link = mysqli_connect("localhost:3306", 'root', '', 'test');
		mysqli_query($link, 'SET NAMES utf8');
		$perNumber = 10;
		$_page = isset($_GET['page'])? $_GET['page'] : 1;
		$start = ($_page-1)*$perNumber;
		$preveoustips = "preveous";
		$nexttips = "next";
		$result = mysqli_query($link, "SELECT AuthorName from authors where AuthorID='$author_id'");
		$author_name = mysqli_fetch_array($result)['AuthorName'];
		if ($author_name != null){
			echo "<h3 style=\"font-family: robotolight;color: white;font-size:20px;\">Name: $author_name</h3>";
		}else{
			echo "<h3 style=\"font-family: robotolight;color: white;font-size:20px;\">Name not found.</h3>";
		}
		$result = mysqli_query($link, "SELECT affiliations.AffiliationID, affiliations.AffiliationName from (select AffiliationID, count(*) as cnt from paper_author_affiliation where AuthorID='$author_id' and AffiliationID is not null group by AffiliationID ) as tmp inner join affiliations on tmp.AffiliationID = affiliations.AffiliationID order by tmp.cnt desc");
		# 请补充对主要机构名的显示
		$affiliation_name = mysqli_fetch_array($result)['AffiliationName'];
		if ($affiliation_name != null){
			echo "<h3 style=\"font-family: robotolight;color: white;font-size:20px;\">Affiliation: $affiliation_name</h3>";
		}
		else{
			echo "<h3 style=\"font-family: robotolight;color: white;font-size:20px;\">No affiliation found.</h3>";
		}

		$tempresult = mysqli_query($link, "SELECT COUNT(*) as number FROM (SELECT PaperID from paper_author_affiliation where AuthorID='$author_id') as tmp");
		$data = mysqli_fetch_array($tempresult);
		if (!$data) {
		printf("Error: %s\n", mysqli_error($link));
		exit();
		}
		$count = $data['number']; // 总查询数
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
		echo "<li><a href=\"/author.php?author_id=$author_id&page=$preveous\">$preveoustips </a></li>";
		}
		// if ($totalPage>10){
		// 	for ($i=1;$i<=min(5,$totalPage);$i++) { //循环显示出页面
		// 	echo "<li><a href=\"/author.php?author_id=$author_id&page=$i\">$i </a></li>";
		// 	}
		// 	echo "<li><a href=\"#\">……</a></li>";
		// 	for ($i=5;$i>=0;$i--){
		// 		$end = $totalPage-$i;
		// 	echo "<li><a href=\"/author.php?author_id=$author_id&page=$end\">$end </a></li>";
		// 	}
		// }else{
		// 	for ($i=1;$i<=$totalPage;$i++) { //循环显示出页面
		// 	echo "<li><a href=\"/author.php?author_id=$author_id&page=$i\">$i </a></li>";
		// 	}
		// }
		if ($totalPage>10){
				if ($_page <=5){
					for ($i=1;$i<=10;$i++) { //循环显示出页面
	                echo "<li><a href=\"/author.php?author_id=$author_id&page=$i\">$i</a></li>";
					}
				}else{
					for ($i=5;$i>=0;$i--) { //循环显示出页面
						$current = $_page-$i;
	                echo "<li><a href=\"/author.php?author_id=$author_id&page=$current\">$current</a></li>";
	            	}
	            	for ($i=1;$i<=4;$i++) { //循环显示出页面
						$current = $_page+$i;
	                echo "<li><a href=\"/author.php?author_id=$author_id&page=$current\">$current</a></li>";
	            	}
			}}else{
				for ($i=1;$i<=$totalPage;$i++) { //循环显示出页面
				echo "<li><a href=\"/author.php?author_id=$author_id&page=$i\">$i </a></li>";
				}
			}
		if ($_page<$totalPage) { //如果page小于总页数,显示下一页链接
			$next = $_page+1; 
		echo "<li><a href=\"/author.php?author_id=$author_id&page=$next\">$nexttips </a></li>";
		}
		if ($totalPage != 1){
				echo "</ul>";
				echo "</div>";
			}


		$sql = "SELECT PaperID from paper_author_affiliation where AuthorID='$author_id' limit ".$start.", $perNumber";
		$result = mysqli_query($link, $sql);
		if ($result) {
			echo "<table>";
			echo "<tr>";
			echo "<td class=\"line1\">";
			echo "RESULT";
			echo "</td>";
			echo "</tr>";
			echo "<tr><td>";
			echo "<table class = \"table2\" border=\"1\" align = center width = 90%><tr><td><b>Title</b></td><td><b>Authors</b></td><td>Conference</b></td></tr>";
			while ($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				$paper_id = $row['PaperID'];
				# 请增加对mysqli_query查询结果是否为空的判断
				if ($paper_id){
					$paper_info = mysqli_fetch_array(mysqli_query($link, "SELECT Title, ConferenceID from Papers where PaperID='$paper_id'"));
					$paper_title = $paper_info['Title'];
					$conf_id = $paper_info['ConferenceID'];
					echo "<td width = 50%><a href=\"/paper.php?paper_id=$paper_id\">$paper_title </a></td>";
				}else{
					echo "not found";
				}

				# 请增加根据paper id在PaperAuthorAffiliations与Authors两个表中进行联合查询，找到根据AuthorSequenceNumber排序的作者列表，并且显示出来的部分
				echo "<td width = 30%>";
				if ($paper_id){
					$author_info = mysqli_query($link, "SELECT AuthorName FROM paper_author_affiliation INNER JOIN authors ON paper_author_affiliation.AuthorID = authors.AuthorID WHERE PaperID = '$paper_id' ORDER BY paper_author_affiliation.AuthorSequence asc");
					if ($author_info){
						while ($obj = mysqli_fetch_object($author_info)) {
							$author_id1 = mysqli_fetch_array(mysqli_query($link, "SELECT AuthorID from authors where AuthorName='$obj->AuthorName'"))['AuthorID'];
							echo "<a href=\"/author.php?author_id=$author_id1\">$obj->AuthorName; </a>";
						}
					}
				}else{
					echo "not found";
				}
				echo "</td>";
				# 请补充根据$conf_id查询conference name并显示的部分
				echo "<td width = 10%>";
				if ($paper_id){
					$conference_info = mysqli_query($link, "SELECT ConferenceName FROM papers INNER JOIN conferences ON papers.ConferenceID = conferences.ConferenceID WHERE PaperID = '$paper_id'");
					$conference_name = mysqli_fetch_array($conference_info);
					$conferencename = $conference_name['ConferenceName'];
					echo "<a href=\"/conference.php?conference_id=$conf_id\">$conferencename </a>";
				}else{
					echo "not found";
				}
				echo "</td>";
				echo "</tr>";
			}
			echo "</table></td></tr><br><br>";
		}
		echo "</table>";


		$totalpaper = "SELECT distinct PaperPublishYear from test.paper_author_affiliation inner join test.papers where paper_author_affiliation.AuthorID = '$author_id' and papers.PaperID = paper_author_affiliation.PaperID order by PaperPublishYear asc";
		// $totalpaper = "SELECT distinct PaperPublishYear from test.paper_author_affiliation inner join test.papers where test.paper_author_affiliation.AuthorID = '811EE217' and test.papers.PaperID = test.paper_author_affiliation.PaperID";
		$total_paper = mysqli_fetch_all(mysqli_query($link,$totalpaper));
		// var_dump($total_paper['PaperPublishYear']);
		$allyear = array();
		foreach ($total_paper as $year) {
			array_push($allyear, $year[0]);
		}
		$a = array();
        foreach ($total_paper as $year )
        {
        	$papersearch = "SELECT count(*) as cnt from paper_author_affiliation inner join papers where papers.PaperPublishYear = $year[0] and paper_author_affiliation.AuthorID = '$author_id' and papers.PaperID = paper_author_affiliation.PaperID"; // 当年一共发表文章数
        	$result = mysqli_fetch_array(mysqli_query($link,$papersearch));
        	$allpaper = $result['cnt'];
        	array_push($a, $allpaper);
        }
        $b = array();
        foreach ($total_paper as $year )
        {
        	$firstsearch = "SELECT count(*) as cnt from paper_author_affiliation inner join papers where papers.PaperPublishYear = $year[0] and paper_author_affiliation.AuthorID = '$author_id' and papers.PaperID = paper_author_affiliation.PaperID and paper_author_affiliation.AuthorSequence = 1";
        	$result = mysqli_fetch_array(mysqli_query($link,$firstsearch));
        	$firstpaper = $result['cnt'];
        	array_push($b, $firstpaper);
        }
        $c = array();
        foreach ($a as $idx=>$num)
        {
        	array_push($c, $a[$idx]-$b[$idx]);
        }
        echo "<script type=\"text/javascript\">var year =".json_encode($allyear).";";
        echo "var total =".json_encode($a).";";
        echo "var first =".json_encode($b).";";
        echo "var nonfirst =".json_encode($c)."; </script>";

        // $all = 0;
        // foreach ($a as $num)
        // {
        // 	$all = $all + $num;
        // }
        // echo $all;


        $confsearch = "SELECT AffiliationName,cnt from  (SELECT AffiliationID, count(*) as cnt from test.paper_author_affiliation where AuthorID='$author_id' and AffiliationID is not null group by AffiliationID order by cnt desc) as temp inner join test.affiliations where temp.AffiliationID = affiliations.AffiliationID";
        $result = mysqli_fetch_all(mysqli_query($link,$confsearch));
        $confname = array();
        $confnum = array();
        foreach ($result as $conf)
        {
        	array_push($confname, $conf[0]);
        	array_push($confnum, $conf[1]);
        }
        echo "<script type=\"text/javascript\">var confname =".json_encode($confname).";";
        echo "var count = $count;";
        echo "var confnum =".json_encode($confnum)."; </script>";
	?>
		</div>

	<div id = "tab2">
	<!-- graph -->
	<div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2><i class="fa fa-pie-chart"></i>  Information Charts</h2>
		</div>
	</div>
	<div class="row">
		<div id="title" style="height:10px;" class="col-md-6">Publication Graph</div>
		<div id="title" style="height:10px;" class="col-md-6">Affiliation Graph</div>
	</div>
	<br/>
<!-- 	<div id="main0" style="width: 800px;height:400px;"> -->
	<div class="row">
		<div class="col-md-6" id="main0" style="height:400px;">
			
		<script type="text/javascript">
			var chart = echarts.init(document.getElementById('main0'), null, {

	                });

	                var labelOption = {
	                    normal: {
	                        show: true,
	                        position: 'insideBottom',
	                        rotate: 90,
	                        textStyle: {
	                            align: 'left',
	                            verticalAlign: 'middle'
	                        }
	                    }
	                };

	                option = {
	                    color: ['#003366', '#006699', '#4cabce', '#e5323e'],
	                    tooltip: {
	                        trigger: 'axis',
	                        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
	                            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
	                        }
	                    },
	                    legend: {
	                    	color: '#33cccc',
	                        data:['Total', 'First Author', 'Not First Author'],
	                        textStyle: {
		                            color: 'white',
		                        }
	                    },
	                    toolbox: {
	                        show: true,
	                        orient: 'vertical',
	                        left: 'right',
	                        top: 'center',
	                        feature: {
	                            mark: {show: true},
	                            dataView: {show: true, readOnly: false},
	                            magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
	                            restore: {show: true},
	                            saveAsImage: {show: true}
	                        }
	                    },
	                    calculable: true,
	                    xAxis: [
	                        {
	                            type: 'category',
	                            axisTick: {show: false},
	                            axisLabel: {
	                    			textStyle: {color: '#33cccc'}
	                    			},
	                            data: year
	                        }
	                    ],
	                    yAxis: [
	                        {
	                        	axisLabel: {
	                    			textStyle: {color: '#33cccc'}
	                    			},
	                            type: 'value'
	                        }
	                    ],
	                    series: [
	                        {
	                            name: 'Total',
	                            type: 'bar',
	                            barGap: 0,
	                            label: labelOption,
	                            data: total
	                        },
	                        {
	                            name: 'First Author',
	                            type: 'bar',
	                            label: labelOption,
	                            data: first
	                        },
	                        {
	                            name: 'Not First Author',
	                            type: 'bar',
	                            label: labelOption,
	                            data: nonfirst
	                        }
	                    ]
	                }

	                chart.setOption(option);
		</script>
		</div>
<!-- 	<div id="main1" style="width: 800px;height:400px;"> -->
	<div class="col-md-6" id = "main1" style="height:400px;">
		<script type="text/javascript">
			var chartdata = new Array();
			for (let i=0;i<confname.length;i++)
			{
				chartdata.push({value:confnum[i], name:confname[i]});
			}

			var chart = echarts.init(document.getElementById('main1'), 'light', {

	                });
			chart.setOption({
				tooltip: {
		            formatter: function(params){
			    		var id = params.dataIndex;
			    		return confname[id]+'<br>Papers: '+ confnum[id];
			    	}
		        },
			    series : [
			        {
			            name: 'Conferences',
			            type: 'pie',
			            radius: '90%',
			            data: chartdata
			        }
			    ],
			    roseType: 'angle'
			})
		</script>
	</div>
</div>

<!-- relation graph -->
<?php
	$coau = "SELECT t.cnt,AuthorName,t.AuthorID from (select AuthorID,count(*) as cnt from (select PaperID from test.paper_author_affiliation where AuthorID = '$author_id') as temp inner join test.paper_author_affiliation on temp.PaperID = paper_author_affiliation.PaperID where paper_author_affiliation.AuthorID != '$author_id' group by AuthorID order by cnt desc) as t inner join test.authors on authors.AuthorID = t.AuthorID";
	$cores = mysqli_fetch_all(mysqli_query($link,$coau));
	$coauname = array();//共同作者名
	$coaunum = array();//共同写作篇数
	$copa = array();//共同作者自己的写作篇数
	$coid = array();
	foreach ($cores as $co)
	{
		$aun = "SELECT count(*) as cnt from test.paper_author_affiliation where AuthorID = '$co[2]'";
		$aupa = mysqli_fetch_array(mysqli_query($link,$aun));
		array_push($coid, $co[2]);
		array_push($copa,$aupa['cnt']);
		array_push($coauname, $co[1]);
		array_push($coaunum, $co[0]);
	}
	echo "<script type=\"text/javascript\">var auname = \"$author_name\";";
	echo "var coauname = ".json_encode($coauname).";";
	echo "var copa =".json_encode($copa).";";
	echo "var auid = \"$author_id\";";
	echo "var count = $count;";
	echo "var coid =".json_encode($coid).";";
	echo "var coaunum = ".json_encode($coaunum).";</script>";
?>

<div id="main3" style="width:1200px;height:800px"></div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main3'));
    var categories = [{name:'Author'},{name:'Co-Author'}];
    var pointdata = new Array();
    var linkdata = new Array();
    pointdata.push({id:auid,name:auname,des:auname+'<br>Papers:'+count,symbolSize:count*2,category:'Author'})
    for (let i=0;i<coauname.length;i++)
    {
    	pointdata.push({id:coid[i],name:coauname[i],des:coauname[i]+'<br>Papers:'+copa[i],symbolSize:copa[i]*2,category:'Co-Author'});
    	linkdata.push({source:auid,target:coid[i],name:'',des:auname+'=>'+coauname[i]+'<br>Coopreration Papers:'+coaunum[i]});
    }
    // alert(JSON.stringify(pointdata));
    // alert(JSON.stringify(linkdata));
    option = {
        // 图的标题
        title: {
            text: 'Author Relation Graph',
            textStyle: {
                        color: 'white',
                        fontSize: 15
                    }
        },
        // 提示框的配置
        tooltip: {
            formatter: function (x) {
                return x.data.des;
            }
        },
        // 工具箱
        toolbox: {
            // 显示工具箱
            show: true,
            feature: {
                mark: {
                    show: true
                },
                // 还原
                restore: {
                    show: true
                },
                // 保存为图片
                saveAsImage: {
                    show: true
                }
            }
        },
        legend: [{
            // selectedMode: 'single',
            data: categories.map(function (a) {
                return a.name;
            }),
            textStyle: {
                            color: 'white',
                            fontSize: 15
                }
        }],
        series: [{
            type: 'graph', // 类型:关系图
            layout: 'force', //图的布局，类型为力导图
            symbolSize: 40, // 调整节点的大小
            roam: true, // 是否开启鼠标缩放和平移漫游。默认不开启。如果只想要开启缩放或者平移,可以设置成 'scale' 或者 'move'。设置成 true 为都开启
            edgeSymbol: ['circle', 'arrow'],
            edgeSymbolSize: [2, 10],
            edgeLabel: {
                normal: {
                    textStyle: {
                        fontSize: 20
                    }
                }
            },
            force: {
                repulsion: 2500,
                edgeLength: [10, 50]
            },
            draggable: true,
            lineStyle: {
                normal: {
                    width: 2,
                    color: '#4DB3B3',
                }
            },
            edgeLabel: {
                normal: {
                    show: true,
                    formatter: function (x) {
                        return x.data.name;
                    }
                }
            },
            label: {
                normal: {
                    show: true,
                    textStyle: {}
                }
            },
 
            
            data: pointdata,
            links: linkdata,
            categories: categories,
        }]
    };
    myChart.setOption(option);
</script>
</div>


<!-- Recommend Papers -->
<?php
	$refp = "SELECT Title,PaperID from (select ReferenceID,count(*) as cnt from (select PaperID from test.paper_author_affiliation inner join test.authors where authors.AuthorID = '$author_id' and authors.AuthorID = paper_author_affiliation.AuthorID) as temp inner join test.paper_reference where paper_reference.ReferenceID = temp.PaperID group by ReferenceID order by cnt desc) as tt inner join test.papers on papers.PaperID = tt.ReferenceID";
	$result = mysqli_fetch_all(mysqli_query($link,$refp));
	$index = 0;
	$allnum = count($result);
?>
<div id = "tab3">
	<div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2><i class="fa fa-users"></i>  Recommend Information</h2>
		</div>
	</div>
<div class="mdui-container">
	<div class="mdui-row">
	<div class="mdui-col-sm-3 mdui-col-md-3">
	  <div class="mdui-card" style="width: 300px;height: 300px;">
	    <div class="mdui-card-media">
	      <img src="images/cc/00.jpg" style="width: 300px;height: 300px;">
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
		    while ($index < 4 and $index < $allnum) {
				$recid = $result[$index][1];
				$recname = $result[$index][0];
				$indexi = $index+1;
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
		    ?>

		  </div>
		</div>

<!-- Recommend Authors -->
<?php
	$refa = "SELECT t.AuthorID,AuthorName from (select AuthorID,count(*) as cnt from (select PaperID from test.paper_author_affiliation where AuthorID = '$author_id') as temp inner join test.paper_author_affiliation on temp.PaperID = paper_author_affiliation.PaperID where paper_author_affiliation.AuthorID != '$author_id' group by AuthorID order by cnt desc) as t inner join test.authors on authors.AuthorID = t.AuthorID";
	$result = mysqli_fetch_all(mysqli_query($link,$refa));
	$index = 0;
	$allnum = count($result);
?>

<div class="mdui-container">
	<div class="mdui-row">
	<div class="mdui-col-sm-3 mdui-col-md-3">
	  <div class="mdui-card" style="width: 300px;height: 300px;">
	    <div class="mdui-card-media">
	      <img src="images/cc/11.jpg" style="width: 300px;height: 300px;">
	      <div class="mdui-card-media-covered">
	        <div class="mdui-card-primary">
	          <div class="mdui-card-primary-title" style="text-align: left;">Recommend Authors</div>
	          <div class="mdui-card-primary-subtitle" style="text-align: left;">You may also want to know:</div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<?php
		    while ($index < 4 and $index < $allnum) {
				$recaid = $result[$index][0];
				$recaname = $result[$index][1];
				$indexi = $index+4;
			    echo "<div class=\"mdui-col-sm-2 mdui-col-md-2\">
			      <div class=\"mdui-card\" style=\"width: 200px;height: 200px;\">
			        <div class=\"mdui-card-media\">
			          <img src=\"images/cc/$indexi.jpg\" style=\"width: 200px;height: 200px;\">
			          <div class=\"mdui-card-media-covered\">
			            <div class=\"mdui-card-primary\">";
			              echo "<div class=\"mdui-card-primary-subtitle\" style=\"text-align: left;\"><a href=\"/author.php?author_id=$recaid\" style=\"color:#94F3F3;font-size:15px;\">$recaname </a></div>";
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