angular.module("board").factory('boardDetailService',function($http,$httpParamSerializerJQLike){
  var boardDetailService = {
    boardDetailData : {
      board_data : {},
      reply_data : []
    },

    getBoardDetailData : function(){
      return boardDetailService.boardDetailData;
    },

    getBoardData : function(board_id){
      $http({
        method:'GET',
        url : '/angular/get_board_info',
        params : {board_id : board_id}
      }).success(function(data){
        angular.copy(data,boardDetailService.boardDetailData);
      });
    },

    insertReply : function(replyData){
      console.log(replyData);
      $http({
        method:'POST',
        url : '/reply/write/'+replyData.board_id,
        data : replyData,
      }).success(function(data){
        boardDetailService.boardDetailData.reply_data.push(data);
        console.log(data);
      });
    },

    deleteReply : function(){

    },
  };
  return boardDetailService;
});

angular.module("board").factory('boardService',function($http){
  var pageUnit = 3;
  var contentUnit = 5;
  var boardService = {
    boardListData : {
      list : [],
      paging : [],
      currentPage : 1,
      totalCount : 0,
      nextBool : true,
      prevBool : true
    },
    getBoardListData : function(){
      return boardService.boardListData;
    },

    changePage : function(reqPage){
      $http({
        method:'GET',
        url : '/angular/get_board',
        params : {page : reqPage}
      }).success(function(data){
        var pageCount = Math.ceil(data.count/contentUnit); //전체 페이지 수
        var beginPage =(Math.floor((reqPage-1)/pageUnit) * pageUnit) + 1 ; //페이징 리스트 시작
        var endPage = (beginPage + pageUnit - 1) < pageCount ? beginPage + pageUnit -1: (pageCount) ; //페이징 리스트 끝

        boardService.boardListData.paging.length=0; //배열 초기화
        for(var i=beginPage; i<=endPage;i++){ //페이지 리스트 push
          boardService.boardListData.paging.push(i);
        }
        console.log(boardService.boardListData.paging);

        angular.copy(data.list,boardService.boardListData.list);  //게시판 리스트 데이터 설정
        boardService.boardListData.currentPage = reqPage; //현재 페이지 설정
        boardService.boardListData.totalCount = data.count; //게시물 총 개수 설정
        boardService.boardListData.nextBool = Math.ceil(pageCount/pageUnit) != Math.ceil(reqPage/pageUnit);//이전 페이징 출력 여부 설정
        boardService.boardListData.prevBool = Math.ceil(reqPage/pageUnit)!=1; //이후 페이징 출력 여부 설정
      });
    },

    getChangePageByArrow : function(option){
      var changePageNum = 1;
      switch(option){
        case 'begin':
          changePageNum = 1;
          break;
        case 'prev':
          changePageNum = Math.ceil((boardService.boardListData.currentPage/pageUnit)-1)*pageUnit;
          break;
        case 'next':
          changePageNum = Math.ceil(boardService.boardListData.currentPage/pageUnit)*pageUnit+1;
          break;
        case 'last':
          changePageNum = Math.ceil(boardService.boardListData.totalCount/contentUnit);
          break;
        default :
          changePageNum = 1;
          break;
      }
      boardService.changePage(changePageNum);
    }
  };
  return boardService;
});
