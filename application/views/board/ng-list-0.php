<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/asset/css/common.css"/>
<link rel="stylesheet" type="text/css" href="/asset/css/lists.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
</head>
<body>
	<ul>
		<li><a href="/board/lists"><h3>YHH's Board</h3></a></li>
	</ul>

  <h2 class="page_title">게시물 목록</h2>
  <table data-ng-app="board" data-ng-controller="boardLists">
  	<caption>
  		<div>총 게시글 : 1건</div>
  	</caption>
  	<caption align="bottom">
  		<div>현재 1 페이지</div>
  		<a href="/board/write_view"><button>글 쓰기</button></a>
  	</caption>
  	<tr>
  		<th>NO.</th>
  		<th>제목</th>
  		<th>게시자</th>
  		<th>조회수</th>
  	</tr>

    <tr data-ng-repeat="item in lists">
  	    <td data-ng-bind="item.no"></td>
  			<td class="title">
  				<a href="/board/view/22" data-ng-bind="item.title">

  				</a>
  			</td>
  			<td data-ng-bind="item.writer"></td>
  			<td data-ng-bind="item.hit"></td>
  	</tr>

  </table>

</body>
<script>
  var board = angular.module("board",[]);

  board.controller("boardLists",function($scope){
    $scope.lists =  [
                      {no:'1',title:'Norway',writer:'a',hit:4},
                      {no:'2',title:'Sweden',writer:'b',hit:5},
                      {no:'3',title:'Denmark',writer:'c',hit:6}
                    ];
  });
</script>

</html>
