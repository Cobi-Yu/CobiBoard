<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/asset/css/common.css"/>
<link rel="stylesheet" type="text/css" href="/asset/css/lists.css"/>
<link rel="stylesheet" type="text/css" href="/asset/css/style.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
<body data-ng-app="board" data-ng-controller="boardLists" data-ng-init="getBoardList(1)">
	<ul>
		<li><a href="/angular/lists"><h3>YHH's Board</h3></a></li>
	</ul>

  <h2 class="page_title">게시물 목록</h2>

  <table>
  	<caption>
  		<div ng-click="change()">총 게시글 : 1건</div>
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

		<tr data-ng-repeat="item in boardLists">
			<td data-ng-bind="item.board_id"></td>
			<td class="title">
			  <a href="/board/view/{{item.board_id}}" data-ng-bind="item.title"></a>
			</td>
			<td data-ng-bind="item.writer">
			</td>
			<td data-ng-bind="item.hit">
			</td>
		</tr>
  </table>

	<div class="gt-paging" style="padding-top:60px">
	    <span class="gt-paging-inner" data-ng-repeat="page in pagingData.pagingArray">
		    <a class="gt-paging-num" src="void(0)" data-ng-click='getBoardList(page)'>{{page}}</a>
	    </span>
	</div>

<script>
  var app = angular.module("board",[]);

	app.factory('boardFactory',['$http',function($http){
		var contentUnit = 5;
		var pageUnit = 3;
		var totalCount = 0;
		return {
			getBoardList : function (reqPage){
				return $http({
								method:'GET',
								url : '/angular/get_board',
								params : {page : reqPage}
							}).success(function(data){
								totalCount=parseInt(data.count);
							});
			},
			getPagingData : function (reqPage){
				var pagingData = new Object();
				var totalPage = Math.ceil(totalCount/contentUnit);	//전체 페이지 수
				var beginPage =(Math.floor((reqPage-1)/pageUnit) * pageUnit) + 1; //페이징 리스트 시작
				var endPage = (beginPage + pageUnit - 1) < totalPage ? beginPage + pageUnit -1 : Math.ceil(totalCount/contentUnit); //페이징 리스트 끝

				pagingData.begin = 1;	//첫 페이지
				pagingData.last = totalPage; //마지막 페이지
				pagingData.prev = reqPage-1 < 1 ? 1 : reqPage-1;	//이전 페이지
				pagingData.next = reqPage+1 > totalPage ? totalPage : reqPage + 1;	//다음 페이지
				pagingData.nextGroup = Math.ceil(totalPage/pageUnit) != Math.ceil(reqPage/pageUnit);
				pagingData.prevGroup = Math.ceil(reqPage/pageUnit)!=1;
				pagingData.pagingArray = new Array();
				for (var i = beginPage; i <= endPage; i++) {
		        pagingData.pagingArray.push(i);
		    }

				console.log(pagingData);
				return pagingData;
			}
		}
	}]);

  app.controller("boardLists",['$scope','boardFactory',function($scope,boardFactory){
			$scope.getBoardList = function(reqPage){
				boardFactory.getBoardList(reqPage).success(function(data){
					$scope.boardLists = data.list;
					$scope.pagingData = boardFactory.getPagingData(reqPage);
				});
			};

	}]);

</script>

</html>
