angular.module("board").controller('boardLists',['$scope','boardService',function($scope,boardService){
  $scope.boardListData = boardService.getBoardListData();
  boardService.changePage(1);
  $scope.changePage = function(reqPage){
    if(isNaN(reqPage)){ //reqPage가 숫자라면
      reqPage = boardService.getChangePageByArrow(reqPage);
    }
    boardService.changePage(reqPage);
  };
}]);

angular.module("board").controller('boardDetail',['$scope','boardDetailService',function($scope,boardDetailService){
  boardDetailService.getBoardData(16);
  $scope.boardDetailData = boardDetailService.getBoardDetailData();
  $scope.insertReply = function(replyData){
    replyData.board_id = $scope.boardDetailData.board_data.board_id;
    boardDetailService.insertReply(replyData);
  };
}]);
