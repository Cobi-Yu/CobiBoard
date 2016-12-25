<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/asset/css/common.css"/>
<link rel="stylesheet" type="text/css" href="/asset/css/lists.css"/>
<link rel="stylesheet" type="text/css" href="/asset/css/style.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
<body data-ng-app="board" data-ng-controller="boardLists">
	<ul>
		<li><a href="/angular/lists"><h3>YHH's Board</h3></a></li>
	</ul>

  <h2 class="page_title">게시물 목록</h2>

  <table>
  	<caption>
  		<div>총 게시글 : {{boardListData.totalCount}}건</div>
  	</caption>
  	<caption align="bottom">
  		<div>현재 1 페이지</div>
  		<a href="/angular/write_view"><button>글 쓰기</button></a>
  	</caption>
  	<tr>
  		<th>NO.</th>
  		<th>제목</th>
  		<th>게시자</th>
  		<th>조회수</th>
  	</tr>

		<tr board-item data-ng-repeat="item in boardListData.list">
		</tr>
  </table>
	<board-list-paging></board-list-paging>

<script src="/asset/js/app.js"></script>
<script src="/asset/js/controller.js"></script>
<script src="/asset/js/directive.js"></script>
<script src="/asset/js/service.js"></script>
</html>
