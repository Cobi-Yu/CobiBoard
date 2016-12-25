angular.module("board").directive('boardItem',function(){
  return {
    templateUrl : '/asset/template/boardItem.html'
  };
});

angular.module("board").directive('boardListPaging',function(){
  return {
    templateUrl : '/asset/template/boardListPaging.html'
  };
});
