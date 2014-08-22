var app = angular.module('devpanel', ['ngRoute']);

app.config(function($routeProvider) {
  $routeProvider.
  when('/', {
    templateUrl: '/views/home/home.ng',
    controller: 'HomeCtrl'
  }).
  when('/sites', {
    templateUrl: '/views/home/sites.ng',
    controller: 'SitesCtrl'
  }).
  when('/unassigned_folders', {
    templateUrl: '/views/home/unassigned_folders.ng',
    controller: 'UnassignedFoldersCtrl'
  }).
  when('/databases', {
    templateUrl: '/views/home/databases.ng',
    controller: 'DatabasesCtrl'
  }).
  when('/database_tables', {
    templateUrl: '/views/home/database_tables.ng',
    controller: 'DatabasesCtrl'
  }).
  when('/autos', {
    templateUrl: '/views/home/autos.ng',
    controller: 'NetworkInterfacesCtrl'
  }).
  when('/interfaces', {
    templateUrl: '/views/home/interfaces.ng',
    controller: 'NetworkInterfacesCtrl'
  }).

  when('/servers', {
    templateUrl: '/views/home/servers.ng',
    controller: 'ServersCtrl'
  }).
 /* when('/server/mysql', {
    templateUrl: '/views/home/mysql.ng',
    controller: 'MySQLCtrl'
  }).
  when('/server/apache', {
    templateUrl: '/views/home/apache.ng',
    controller: 'ApacheCtrl'
  }).
  when('/server/mongo', {
    templateUrl: '/views/home/mongo.ng',
    controller: 'MongoCtrl'
  }).
  when('/server/postgresql', {
    templateUrl: '/views/home/postgresql.ng',
    controller: 'PostgresqlCtrl'
  }).
  when('/server/nginx', {
    templateUrl: '/views/home/nginx.ng',
    controller: 'NginxCtrl'
  }).
  when('/server/nodejs', {
    templateUrl: '/views/home/nodejs.ng',
    controller: 'NodeJSCtrl'
  }).
*/
  otherwise({
    redirectTo: '/'
  });
});


app.controller('Tabs', function ($scope,$rootScope){
  $rootScope.active='home';
  $scope.active='home';
  $scope.tabs = [
  { id: "home", title: "Home"},
  { id: "sites", title: "Sites"},
  { id: "unassigned_folders", title: "Unassigned Folders"},
  { id: "autos", title: "Autos"},
  { id: "interfaces", title: "Network Interfaces"},
  { id: "databases", title: "Databases"},
  { id: "database_tables", title: "Database Tables"},
  { id: "servers", title: "Servers",
/*  subs: [
  { id: "mysql", title: "MySql"},
  { id: "apache", title: "Apache"},
  { id: "mongo", title: "Mongo"},
  { id: "postgresql", title: "Postgresql"},
  { id: "nginx", title: "Nginx"},
  { id: "nodejs", title: "Node.js"},
  ]*/
},
];
});

app.controller('TestCtrl', function ($http,$rootScope, $scope, $location, $routeParams) {
});

app.controller('HomeCtrl', function ($scope,readme) {
  readme.list(function(json_list) {
    $scope.readme = json_list.data.readme;
  });
});

app.controller('SitesCtrl', function ($scope, sites){
  sites.list(function(json_list) {
    $scope.sites = json_list.data;
  });
});

app.controller('UnassignedFoldersCtrl', function ($scope, unassigned_folders){
  unassigned_folders.list(function(json_list) {
    $scope.unassigned_folders = json_list.data;
  });
});

app.controller('DatabasesCtrl', function ($scope, databases, database_tables){
  databases.list(function(json_list) {
    $scope.databases = json_list.data;
  });

  database_tables.list(function(json_list) {
    $scope.database_tables = json_list.data;
  });
});

app.controller('NetworkInterfacesCtrl', function ($scope, network_interfaces,$rootScope){
  network_interfaces.list(function(json_list) {
   $scope.autos = json_list.data.autos;
   $scope.interfaces = json_list.data.interfaces;
   $scope.primary_ip = json_list.data.ip;
   $scope.primary_auto = json_list.data.primary_auto;

   $rootScope.primary_ip = json_list.data.ip;
   $rootScope.primary_auto = json_list.data.primary_auto;
 });
});

app.controller('ServersCtrl', function ($scope, servers){
  servers.list(function(json_list) {
   // console.log(json_list.data);
    $scope.servers = json_list.data;
  });

});

app.factory('readme', function($http){
  return {
    list: function (callback){
      $http({
        method: 'GET',
        url: '/api/readme',
        cache: true
      }).success(callback);
    }
  }
});

app.factory('sites', function($http){
  return {
    list: function (callback){
      $http({
        method: 'GET',
        url: '/api/sites',
        cache: true
      }).success(callback);
    }
  }
});

app.factory('unassigned_folders', function($http){
  return {
    list: function (callback){
      $http({
        method: 'GET',
        url: '/api/unassigned_folders',
        cache: true
      }).success(callback);
    }
  }
});

app.factory('databases', function($http){
  return {
    list: function (callback){
      $http({
        method: 'GET',
        url: '/api/databases',
        cache: true
      }).success(callback);
    }
  }
});

app.factory('database_tables', function($http){
  return {
    list: function (callback){
      $http({
        method: 'GET',
        url: '/api/database_tables',
        cache: true
      }).success(callback);
    }
  }
});

app.factory('network_interfaces', function($http){
  return {
    list: function (callback){
      $http({
        method: 'GET',
        url: '/api/network_interfaces',
        cache: true
      }).success(callback);
    }
  }
});

app.factory('servers', function($http){
  return {
    list: function (callback){
      $http({
        method: 'GET',
        url: '/api/servers',
        cache: true
      }).success(callback);
    }
  }
});

/*
app.factory('server', function($http){
  return {
    mysql: function (callback){
      $http({
        method: 'GET',
        url: '/api/server/mysql',
        cache: true
      }).success(callback);
    },
    apache: function (callback){
      $http({
        method: 'GET',
        url: '/api/server/apache',
        cache: true
      }).success(callback);
    }
  }
});
*/
/* type: mysql,apache2,mongo,nginx,postgresql */
  /*  app.factory('server', function($http,type){
        return {
          types: function (callback){
            $http({
              method: 'GET',
              url: '/api/server',
              cache: true
            }).success(callback);
          },
        return {
          list: function (callback){
            $http({
              method: 'GET',
              url: '/api/server/'+type,
              cache: true
            }).success(callback);
          }
          }
      });
*/
