<!DOCTYPE html> 
<html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Search Page</title>
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
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="mdui-v0.4.2/js/mdui.js"></script>
<script src="js/jquery-3.2.1.js"></script>
<style type="text/css">
	body {
		text-align: center;
	}
	h3{
		font-size: 20px;
    	font-family: 'robotolight';
    	color: white;
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
<!-- 	<div class="site-bg"></div>
    <div class="site-bg-overlay"></div> -->
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
		      <i class="fa fa-search"></i>
		      <label>Multi Search</label>
		    </a>
		    <a href="#tab2" class="mdui-ripple mdui-ripple-white">
		      <i class="fa fa-book"></i>
		      <label>Search Title</label>
		    </a>
		    <a href="#tab3" class="mdui-ripple mdui-ripple-white">
		      <i class="fa fa-user"></i>
		      <label>Search Author</label>
		    </a>
		    <a href="#tab4" class="mdui-ripple mdui-ripple-white">
		      <i class="fa fa-users"></i>
		      <label>Search Conference</label>
		    </a>
		  </div>
		</div>

	<div class="mdui-container-fluid">
  		<div id="tab1">
    <div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2>Search Page</h2>
		</div>
	</div>
	<?php
		$multi_search = $_GET["multi_search"];
		$paper_title = $_GET["paper_title"];
		$Authorname = $_GET["Authorname"];
		$Conferencename = $_GET["Conferencename"];
		$perNumber=10; //每页显示的记录数
		$_page =isset($_GET['page'])? $_GET['page'] : 1;
		$_page1=isset($_GET['page1'])? $_GET['page1'] : 1; //获得当前的页面值
		$_page2=isset($_GET['page2'])? $_GET['page2'] : 1;
		$_page3=isset($_GET['page3'])? $_GET['page3'] : 1;
		$start=($_page-1)*$perNumber;
		$start1=($_page1-1)*$perNumber;
		$start2=($_page2-1)*$perNumber;
		$start3=($_page3-1)*$perNumber;
		$previoustips = "previous";
		$nexttips = "next";
		if ($multi_search){
			$ch = curl_init();
			$timeout = 5;
			$query = urlencode(str_replace(' ', '+', $multi_search));
			$url = "http://localhost:8983/solr/PapersSearching/select?indent=on&start=".$start."&rows=".$perNumber."&q=Title:".$query."%20OR%20AuthorName:".$query."%20OR%20ConferenceName:".$query."&wt=json";
			echo "<table>";
			echo "<tr>";
			echo "<td class=\"line1\">";
			echo "RESULT";
			echo "</td>";
			echo "</tr>";
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$result = json_decode(curl_exec($ch), true);
			curl_close($ch);
			echo "<tr><td><table class = \"table2\" border=\"1\" align = center width = 90%>";
			echo "<tr><td><b>Title</b></td><td><b>Authors</b></td><td><b>Conference</b></td></tr>";
			echo "Search for: ".$multi_search;
			echo "<br>";


			$count= $result['response']['numFound']; //获得记录总数
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
				$previous = $_page-1;
                        echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$previous&page1=$_page1&page2=$_page2&page3=$_page3\">$previoustips</a></li>";
			}
			if ($totalPage>10){
				if ($_page <=5){
					for ($i=1;$i<=10;$i++) { //循环显示出页面
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$i&page1=$_page1&page2=$_page2&page3=$_page3\">$i</a></li>";
					}
				}else{
					for ($i=5;$i>=0;$i--) { //循环显示出页面
						$current = $_page-$i;
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$current&page1=$_page1&page2=$_page2&page3=$_page3\">$current</a></li>";
	            	}
	            	for ($i=1;$i<=4;$i++) { //循环显示出页面
						$current = $_page+$i;
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$current&page1=$_page1&page2=$_page2&page3=$_page3\">$current</a></li>";
	            	}
			}}else{
				for ($i=1;$i<=$totalPage;$i++) { //循环显示出页面
                    echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$i&page1=$_page1&page2=$_page2&page3=$_page3\">$i</a></li>";
                }
			}

			if ($_page1<$totalPage) { //如果page小于总页数,显示下一页链接
				$next = $_page+1;
                        echo "<li><a href=\"/search.php?paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$next&page1=$_page1&page2=$_page2&page3=$_page3\">$nexttips</a></li>";
			}
			if ($totalPage != 1){
				echo "</ul>";
				echo "</div>";
			}


			foreach ($result['response']['docs'] as $paper) {
				echo "<tr>";
				echo "<td width = 50%>";
				$title = $paper['Title'];
				$paper_id = $paper['PaperID'];
				echo "<a href=\"/paper.php?paper_id=$paper_id\">$title </a>";
				echo "</td>";

				echo "<td width = 30%>";
				foreach ($paper['AuthorName'] as $idx => $author) {
					$author_id = $paper['AuthorID'][$idx];
					echo "<a href=\"/author.php?author_id=$author_id\">$author; </a>";
				}
				echo "</td>";

				# 请补充针对Conference Name的显示
				echo "<td width = 10%>";
				$conferencename =  $paper['ConferenceName'];
				$conference_id = $paper['ConferenceID'];
				echo "<a href=\"/conference.php?conference_id=$conference_id\">$conferencename </a>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table></td></tr><br><br>";
			echo "</table>";
		}else{
			echo "<h3>No data here!</h3>";
		}
		?>
		</div>
		<div id = "tab2">
		<div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2>Search Page</h2>
		</div>
	</div>
		<?php
		if ($paper_title) {
			$ch = curl_init();
			$timeout = 5;
			$query = urlencode(str_replace(' ', '+', $paper_title));
			$url = "http://localhost:8983/solr/PapersSearching/select?indent=on&start=".$start1."&rows=".$perNumber."&q=Title:".$query."&wt=json";
			echo "<table>";
			echo "<tr>";
			echo "<td class=\"line1\">";
			echo "RESULT";
			echo "</td>";
			echo "</tr>";
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$result = json_decode(curl_exec($ch), true);
			curl_close($ch);
			echo "<tr><td><table class = \"table2\" border=\"1\" align = center width = 90%>";
			echo "<tr><td><b>Title</b></td><td><b>Authors</b></td><td><b>Conference</b></td></tr>";
			echo "Search for Title: ".$paper_title;
			echo "<br>";


			$count= $result['response']['numFound']; //获得记录总数
			if ($count/$perNumber != 0){
				$totalPage = floor($count / $perNumber) +1;
			}else{
				$totalPage = floor($count / $perNumber);
			} //计算出总页数
			if ($totalPage != 1){
				echo "<div class=\"project-pages\">";
				echo "<ul>";
			}
			if ($_page1 != 1) { //页数不等于1
				$previous = $_page1-1;
                        echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$previous&page2=$_page2&page3=$_page3#tab2\">$previoustips</a></li>";
			}
			if ($totalPage>10){
				if ($_page1 <=5){
					for ($i=1;$i<=10;$i++) { //循环显示出页面
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$i&page2=$_page2&page3=$_page3#tab2\">$i</a></li>";
					}
				}else{
					for ($i=5;$i>=0;$i--) { //循环显示出页面
						$current = $_page1-$i;
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$current&page2=$_page2&page3=$_page3#tab2\">$current</a></li>";
	            	}
	            	for ($i=1;$i<=4;$i++) { //循环显示出页面
						$current = $_page1+$i;
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$current&page2=$_page2&page3=$_page3#tab2\">$current</a></li>";
	            	}
			}}else{
				for ($i=1;$i<=$totalPage;$i++) { //循环显示出页面
                    echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$i&page2=$_page2&page3=$_page3#tab2\">$i</a></li>";
                }
			}

			if ($_page1<$totalPage) { //如果page小于总页数,显示下一页链接
				$next = $_page1+1;
                        echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$next&page2=$_page2&page3=$_page3#tab2\">$nexttips</a></li>";
			}
			if ($totalPage != 1){
				echo "</ul>";
				echo "</div>";
			}


			foreach ($result['response']['docs'] as $paper) {
				echo "<tr>";
				echo "<td width = 50%>";
				$title = $paper['Title'];
				$paper_id = $paper['PaperID'];
				echo "<a href=\"/paper.php?paper_id=$paper_id\">$title </a>";
				echo "</td>";

				echo "<td width = 30%>";
				foreach ($paper['AuthorName'] as $idx => $author) {
					$author_id = $paper['AuthorID'][$idx];
					echo "<a href=\"/author.php?author_id=$author_id\">$author; </a>";
				}
				echo "</td>";

				# 请补充针对Conference Name的显示
				echo "<td width = 10%>";
				$conferencename =  $paper['ConferenceName'];
				$conference_id = $paper['ConferenceID'];
				echo "<a href=\"/conference.php?conference_id=$conference_id\">$conferencename </a>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table></td></tr><br><br>";
			echo "</table>";
		}else{
			echo "<h3>No data here!</h3>";
		}
		# 请补充针对AuthorName以及ConferenceName的搜索
		?>


		</div>
		<div id ="tab3">
		<div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2>Search Page</h2>
		</div>
		</div>


		<?php
		if ($Authorname){
			echo "<table>";
			echo "<tr>";
			echo "<td class=\"line1\">";
			echo "RESULT";
			echo "</td>";
			echo "</tr>";
			echo "<tr><td><table class = \"table2\" border=\"1\" align = center width = 90%>";
			echo "Search for Author Name:".$Authorname;
			echo "<br>";
			$ch = curl_init();
			$timeout = 5;
			$query = urlencode($Authorname);
			$url = "http://localhost:8983/solr/PapersSearching/select?indent=on&start=".$start2."&rows=".$perNumber."&q=AuthorName:\"$query\"&wt=json";
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$result = json_decode(curl_exec($ch), true);

			$count= $result['response']['numFound']; //获得记录总数
			if ($count/$perNumber != 0){
				$totalPage = floor($count / $perNumber) +1;
			}else{
				$totalPage = floor($count / $perNumber);
			} //计算出总页数
			if ($totalPage != 1){
				echo "<div class=\"project-pages\">";
				echo "<ul>";
			}
			if ($_page2 != 1) { //页数不等于1
				$previous = $_page2-1;
			echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$previous&page3=$_page3#tab3\">$previoustips </a></li>";
			}
			if ($totalPage>10){
				if ($_page2 <=5){
					for ($i=1;$i<=10;$i++) { //循环显示出页面
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$i&page3=$_page3#tab3\">$i</a></li>";
					}
				}else{
					for ($i=5;$i>=0;$i--) { //循环显示出页面
						$current = $_page2-$i;
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$current&page3=$_page3#tab3\">$current</a></li>";
	            	}
	            	for ($i=1;$i<=4;$i++) { //循环显示出页面
						$current = $_page2+$i;
	                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$current&page3=$_page3#tab3\">$current</a></li>";
	            	}
			}}else{
				for ($i=1;$i<=$totalPage;$i++) { //循环显示出页面
				echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$i&page3=$_page3#tab3\">$i </a></li>";
				}
			}

			if ($_page2<$totalPage) { //如果page小于总页数,显示下一页链接
				$next = $_page2+1; 
			echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$next&page3=$_page3#tab3\">$nexttips </a></li>";
			}
			if ($totalPage != 1){
				echo "</ul>";
				echo "</div>";
			}


			if ($count)
			{
				curl_close($ch);
				echo "<table class=\"table2\" border=\"1\" align = center width = 90%><tr><td><b>Title</b></td><td><b>Authors</b></td><td><b>Conference</b></td></tr>";
				foreach ($result['response']['docs'] as $paper) {
					echo "<tr>";
					echo "<td width = 50%>";
					$title = $paper['Title'];
					$paper_id = $paper['PaperID'];
					echo "<a href=\"/paper.php?paper_id=$paper_id\">$title </a>";
					echo "</td>";

					echo "<td width = 30%>";
					foreach ($paper['AuthorName'] as $idx => $author) {
						$author_id = $paper['AuthorID'][$idx];
						echo "<a href=\"/author.php?author_id=$author_id\">$author; </a>";
					}
					echo "</td>";

					echo "<td width = 10%>";
					$conferencename =  $paper['ConferenceName'];
					$conference_id = $paper['ConferenceID'];
					echo "<a href=\"/conference.php?conference_id=$conference_id\">$conferencename </a>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table></td></tr><br><br>";
				echo "</table>";
			}
			else {
				echo "<br>";
				echo "This Author is not found!<br>";
				echo "</table></table>";
			}
		}else{
			echo "</table></table>";
			echo "<h3>No data here!</h3>";
		}
		?>


		</div>
		<div id ="tab4">
		<div class="homepage home-section text-center">
        <div class="welcome-text">
			<h2>Search Page</h2>
		</div>
		</div>

		<?php
		if ($Conferencename){
			echo "<table>";
			echo "<tr>";
			echo "<td class=\"line1\">";
			echo "RESULT";
			echo "</td>";
			echo "</tr>";
			echo "<tr><td><table class = \"table2\" border=\"1\" align = center width = 90%>";
			echo "Search for Conference: ".$Conferencename;
			echo "<br>";
			$ch = curl_init();
			$timeout = 5;
			$query = urlencode(str_replace(' ', '+', $Conferencename));
			$url = "http://localhost:8983/solr/PapersSearching/select?indent=on&start=".$start3."&rows=".$perNumber."&q=ConferenceName:".$query."&wt=json";

			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$result = json_decode(curl_exec($ch), true);
			curl_close($ch);

			$count= $result['response']['numFound']; //获得记录总数
			if ($count/$perNumber != 0){
				$totalPage = floor($count / $perNumber) +1;
			}else{
				$totalPage = floor($count / $perNumber);
			} //计算出总页数
			if ($count!=0)
			{
			if ($totalPage != 1){
				echo "<div class=\"project-pages\">";
				echo "<ul>";
			}
			if ($_page3 != 1) { //页数不等于1
				$previous = $_page3-1;
			echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$_page2&page3=$previous#tab4\">$previoustips </a></li>";
			}
			if ($_page3 <=5){
				for ($i=1;$i<=10;$i++) { //循环显示出页面
                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$_page2&page3=$i#tab4\">$i</a></li>";
				}
			}else{
				for ($i=5;$i>=0;$i--) { //循环显示出页面
					$current = $_page3-$i;
                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$_page2&page3=$current#tab4\">$current</a></li>";
            	}
            	for ($i=1;$i<=4;$i++) { //循环显示出页面
					$current = $_page3+$i;
                echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$_page1&page2=$_page2&page3=$current#tab4\">$current</a></li>";
            	}
			}
			if ($_page3<$totalPage) { //如果page小于总页数,显示下一页链接
				$next = $_page3+1; 
			echo "<li><a href=\"/search.php?multi_search=$multi_search&paper_title=$paper_title&Authorname=$Authorname&Conferencename=$Conferencename&page=$_page&page1=$next&page2=$_page2&page3=$_page3#tab4\">$nexttips </a></li>";
			}
			if ($totalPage != 1){
				echo "</ul>";
				echo "</div>";
			}

			echo "<table class = \"table2\" border=\"1\" align = center width = 90%><tr><td><b>Title</b></td><td><b>Authors</b></td><td><b>Conference</b></td></tr>";
				foreach ($result['response']['docs'] as $paper){
				echo "<tr>";
				echo "<td width = 50%>";
				$title = $paper['Title'];
				$paper_id = $paper['PaperID'];
				echo "<a href=\"/paper.php?paper_id=$paper_id\">$title </a>";
				echo "</td>";

				echo "<td width = 30%>";
				foreach ($paper['AuthorName'] as $idx => $author) {
					$author_id = $paper['AuthorID'][$idx];
					echo "<a href=\"/author.php?author_id=$author_id\">$author; </a>";
				}
				echo "</td>";

				echo "<td width = 10%>";
				$conferencename =  $paper['ConferenceName'];
				$conference_id = $paper['ConferenceID'];
				echo "<a href=\"/conference.php?conference_id=$conference_id\">$conferencename </a>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table></td></tr><br><br>";
			echo "</table>";
		}else{
			echo "<br>";
			echo "This Conference is not found!<br>";
			echo "</table></table>";
		}
			
		}else{
			echo "<h3>No data here!</h3>";
		}
	?>

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