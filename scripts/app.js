//FribeCaddy

var fribaApp = angular.module("fribeCaddy", ['ngRoute', 'ngAnimate']);

fribaApp.config(function($routeProvider, $locationProvider){
   
    $routeProvider
    
    .when('/', {
        templateUrl:'pages/main.php',
        controller: 'mainController'
    })
    
    .when('/laskuri', {
        templateUrl:'pages/laskuri.html',
        controller: 'laskuriController'
    })
    
    .when('/pelaajat', {
        templateUrl:'pages/pelaajat.html',
        controller: 'pelaajatController'
    })
    
    .when('/radat', {
        templateUrl:'pages/radat.html',
        controller: 'radatController'
    })
    
    .when('/myprofile', {
        templateUrl:'pages/myprofile.html',
        controller: 'myprofileController'
    })
     
      $locationProvider.html5Mode(false);
    
});

fribaApp.service('databaseService', function($http) {
    
   this.getCourses = function(radanNimi) {
   
   return $http({
   method: 'GET',
   url: "includes/getRadat.php?rata=" + radanNimi
   }).then(function successCallBack(response){
        return response;
   }, function errorCallback(response) {
          
    
   });
   };

   
   this.getPlayers = function(pelaajanNimi) {
   
   return $http({
   method: 'GET',
   url: "includes/getPelaajat.php?user=" + pelaajanNimi
   }).then(function successCallBack(response){
        return response;
   }, function errorCallback(response) {
          
    
   });
   };
   
   this.getHoles = function(courseNimi) {
    
    return $http({
   method: 'GET',
   url: "includes/getHoles.php?hole=" + courseNimi
   }).then(function successCallBack(response){
        return response;
   }, function errorCallback(response) {
          
    
   });
   };  
   
    this.getMostPlayedCourse = function() {
    
    return $http({
   method: 'GET',
   url: "includes/getMostPlayedCourse.php"
   }).then(function successCallBack(response){
        return response;
   }, function errorCallback(response) {
          
    
   });
   };
   
   this.getTotalThrows = function() {
    
    return $http({
   method: 'GET',
   url: "includes/getTotalThrows.php"
   }).then(function successCallBack(response){
        return response;
   }, function errorCallback(response) {
          
    
   });
   };
   
    this.getAvgScore = function(username) {
    
    return $http({
   method: 'GET',
   url: "includes/getAvgScore.php?username=" + username
   }).then(function successCallBack(response){
        return response;
   }, function errorCallback(response) {
          
    
   });
   };
   
   this.getAvgScoreOnMostPlayed = function(username, course) {
    
    return $http({
   method: 'GET',
   url: "includes/getAvgScore.php?course=" + course +"&username=" + username
   }).then(function successCallBack(response){
        return response;
        
   }, function errorCallback(response) {
          
    
   });
   };
   
   this.insertRound = function(course) {
    
    return $http({
            method: 'POST',
            url: "includes/insertKierros.php",
            data: course
        }).then(function successCallBack(data, status, headers, config){
            console.log(data);
        }, function errorCallback(response) {
          console.log("error");
    
   });
   
   };
    
}); 
    
fribaApp.factory('scoreCardKeeper', function(){
   
   var keeper = {};
   keeper.scoreCards = [];
   keeper.course = {};
   keeper.started = false;
   keeper.finished = false;
   keeper.addScoreCard = function(player){
        keeper.scoreCards.push(player);
        keeper.started=true;
    
   }
   keeper.setCourse = function(id, course, pars, total){
        keeper.course.id = id;
        keeper.course.name = course;
        keeper.course.pars = pars
        keeper.course.total = total;
        
   }
   keeper.getScoreCard = function(){
        return keeper.scoreCards;
   }
    keeper.resetScoreCards = function(){
       keeper.scoreCards = [];
       keeper.started=false;
       keeper.finished=false;
    }
    keeper.checkScores = function(){
        keeper.finished = true;
        for(var i = 0; i < keeper.scoreCards.length; i++){
            var player = keeper.scoreCards[i];
            player.checkScores();
            if (player.finished == false) {
                keeper.finished = false;
            }
        }
    }
    return keeper;
  
    
});    

fribaApp.factory('playerCreator', function(){
    
    var creator = {}
    creator.createPlayer = function(name){
        var player = {};
        player.name = name;
        player.scoreCard = [];
        player.sum;
        player.finished = false;
        player.addScore = function (score, idx) {
            if (score == -1 && player.scoreCard[idx] == 0) {
                //Do nothing
            }
            else {
                player.scoreCard[idx] += score;
               
            }
            player.total();
        }
        player.total = function (){
            var sum = 0;
            for (var i = 0; i < this.scoreCard.length; i++) {
                sum = sum + this.scoreCard[i];
            }
            player.sum = sum;
        }
        player.checkScores = function(){
            player.finished = true;
            for (var i = 0; i < this.scoreCard.length; i++) {
                if (this.scoreCard[i] == 0) {
                    player.finished = false;
                }
            }
        }
        return player;    
    }
    
    return creator;
    
});

fribaApp.factory('playerStats', function(){
    var playerStats = {};
    playerStats.initialized = false;
    playerStats.name;
    playerStats.mostPlayedCourse;
    playerStats.mostPlayedCourseAvg;
    playerStats.Avg;
    playerStats.totalThrows;
    playerStats.setValues = function(name, mostPlayedCourse, mostPlayedCourseAvg, Avg, totalThrows){
        this.name = name;
        this.mostPlayedCourse = mostPlayedCourse;
        this.mostPlayedCourseAvg = mostPlayedCourseAvg;
        this.Avg = Avg;
        this.totalThrows = totalThrows;
        this.initialized = true;
    }
    playerStats.setMostPlayedCourse = function(mstplyed){
        this.mostPlayedCourse = mstplyed;
        this.initialized = true;
    }
    return playerStats;
    
    
});
  
fribaApp.factory('playerList', function(){
    var players = {}
    players.list = [];
    players.listSize = 0;
    players.addPlayer = function(username){
       var player = {name:username, average:0};
       players.list.push(player);
       this.listSize++;
    }
    players.addAverage = function(avg, idx){
        players.list[idx].average = avg;
    }
    players.getList = function() {
        return this.list;
    }
    players.resetList = function(){
        players.list = [];
        this.listSize = 0;
    }
    
    return players;
    
    
});



//MAIN
fribaApp.controller('mainController', ['$scope', function($scope) {
    console.log("main");


}]);

fribaApp.controller('laskuriController', ['$scope', '$route', 'databaseService', 'playerCreator', 'scoreCardKeeper', function($scope, $route, databaseService, playerCreator, scoreCardKeeper) {
    
    var scoreCards = scoreCardKeeper;
    $scope.init;
    $scope.scoreCards = scoreCards.scoreCards;
    $scope.notpickedPlayers = [];
    $scope.pickedPlayers = [];
    $scope.course = scoreCards.course;
        $scope.playerlist;
        $scope.courselist = [];
        $scope.picked;
        $scope.available;
        $scope.pickedCourse;
        $scope.finished = false;
    if (scoreCards.started == false) {
        $scope.init = false;
    }
    else {
        $scope.init = true;
    }
        if ($scope.playerlist == null) {
            databaseService.getPlayers("").then(function(response){
               $scope.playerlist = response.data;
               for (var i = 0; i < response.data.length; i++){
                    $scope.notpickedPlayers.push(response.data[i].name);
               }
                $scope.available = $scope.notpickedPlayers[0];
                
            });
        }
        if ($scope.courselist.length == 0) {
            databaseService.getCourses("").then(function(response){
                for (var i = 0; i < response.data.length; i++) {
                    
                    var course = {}
                    course.id = response.data[i].rata_id;
                    course.nimi = response.data[i].nimi;
                    course.par = response.data[i].par;
                    course.vayla_lkm = response.data[i].vayla_lkm;
                    $scope.courselist.push(course);
                }
            });
        }
   
        
        
        $scope.addPlayer = function(a){
            
                
            if (a=="add" && $scope.pickedPlayers.length < 5 && $scope.available != "") {
                
            var userIdx;
            $scope.pickedPlayers.push($scope.available);
            for(var i = 0; i < $scope.notpickedPlayers.length; i++){
                if ($scope.available == $scope.notpickedPlayers[i]) {
                    userIdx = i;
                }
            }
            $scope.notpickedPlayers.splice(userIdx, 1);
            $scope.available="";
            $scope.picked=$scope.pickedPlayers[0];
            }
            
            if (a=="remove" && $scope.pickedPlayers.length > 0 && $scope.picked != "") {
            var userIdx;
            $scope.notpickedPlayers.push($scope.picked);
            for(var i = 0; i < $scope.pickedPlayers.length; i++){
                if ($scope.picked == $scope.pickedPlayers[i]) {
                    userIdx = i;
                }
            }
            $scope.pickedPlayers.splice(userIdx, 1);
            $scope.picked="";
            }
             
           
                    
        }
            
        
        
        
        $scope.startGame = function (args) {
            if ($scope.pickedPlayers.length > 0 && $scope.pickedCourse != null) {
                    var course = JSON.parse($scope.pickedCourse);
                    for(var i = 0; i < $scope.pickedPlayers.length; i++){
                        var player = playerCreator.createPlayer($scope.pickedPlayers[i]);
                        for(var k = 0; k < course.vayla_lkm; k++){
                            player.scoreCard.push(0);
                        }
                        scoreCards.addScoreCard(player);
                    }
                $scope.init = true;
                databaseService.getHoles(course.nimi).then(function(response){
                    var parArray = [];
                    for (var i = 0; i < response.data.length; i++) {
                        parArray.push(response.data[i].par);  
                    }
                    scoreCards.setCourse(course.id, course.nimi, parArray, course.par);
                    
                });
                
            }
            
            
        }
        
        $scope.finishCourse = function() {
            scoreCards.checkScores();
            if (scoreCards.finished == true) {
                $scope.finished = true;
            }
            else {
                window.alert("Missing scores");
            }
        }
        
        $scope.saveGame = function() {
            console.log($scope.course);
            databaseService.insertRound(scoreCards);
            confirm("Thanks for playing!");
            window.location.reload();
            
        }
        
 
}]);


 //PELAAJAT   
 fribaApp.controller('pelaajatController', ['$scope', '$log', 'databaseService', 'playerList', function($scope, $log, databaseService, playerList) {
    
   $scope.searchString = "";
     
    $scope.searchForPlayer = function searchForPlayer(){
            playerList.resetList();
            databaseService.getPlayers($scope.searchString).then(function(response) {
                console.log(response);
                for (var i = 0; i < response.data.length; i++) {
                    var username = response.data[i].name;
                    playerList.addPlayer(username);
                    var num = response.data[i].average;
                    num = Math.round(num * 100) / 100;
                    playerList.addAverage(num, i);
                    
                }
                
                
                
                
            });
           
            
           
           
            
            
            
            
         $scope.players = playerList.list;
    }
   
    
    
    
   


}]);   
//RADAT
fribaApp.controller('radatController', ['$scope', '$log', 'databaseService', function($scope, $log, databaseService) {

    $scope.searchString = "";
    $scope.searchForCourse = function searchForCourse(){
            databaseService.getCourses($scope.searchString).then(function(response) {
                console.log(response.data);
            $scope.courses = response.data;
            });
    }

   

}]);

//MyProfile Controller

fribaApp.controller('myprofileController', ['$scope', 'databaseService', 'playerStats', function($scope, databaseService, playerStats){
    
        $scope.playerStats = playerStats;
        if (!$scope.playerStats.initialized) {
            
             databaseService.getTotalThrows().then(function(response) {
                
                $scope.playerStats.name = response.data[0].username;
                username = response.data[0].username;
                $scope.playerStats.totalThrows = response.data[0].throws;
                
                databaseService.getAvgScore($scope.playerStats.name).then(function(response) {
                var num = response.data;
                $scope.playerStats.Avg = (Math.round(num * 100) / 100);
                });
                
                databaseService.getMostPlayedCourse().then(function(response) {
                $scope.playerStats.setMostPlayedCourse(response.data[0].nimi);
                    databaseService.getAvgScoreOnMostPlayed( $scope.playerStats.name, $scope.playerStats.mostPlayedCourse).then(function(response) {
                    var num = response.data;
                    $scope.playerStats.mostPlayedCourseAvg = (Math.round(num * 100) / 100);
                    });
                });
                
            });
             
            
            
            
           
            
            
        }
    
    
    
}]);




    
    
    
    
