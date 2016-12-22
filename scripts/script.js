angular
    .module("myModule", [
        'ngAnimate',
        'ngMessages',
        'ngMaterial',
        ])
    .controller("myCtrl", ['$timeout','$scope','$http',function($timeout,$scope,$http) {
        var vm = this;
        vm.images = [
            {path: 'image/Bella.JPG'},
            {path: 'image/Herman.jpg'},
            {path: 'image/Lucy.jpg'},
            {path: 'image/Molly.jpg'},
            {path: 'image/Smoothie.jpg'},
            {path: 'image/Tigger.jpg'},
            {path: 'image/Jimmy.jpg'}
        ];
        vm.currentImage = {};
        vm.helloFun=false;
        vm.show_im=true;
        vm.pic_fun=function(item) {
            vm.currentImage=item;
            vm.show_im=false;
        };
        $http.get('home_json.php').then(function(response){
            vm.myData=response.data.animalDetails;
        });
        vm.addAnimal=false;
        vm.animalArray = {};
        vm.activeAnimal=function(x) {
            vm.animalArray=x;
        }
        vm.user = null;
        vm.users = null;

        vm.loadUsers = function() {

        // Use timeout to simulate a 650ms request.
        return $timeout(function() {

          vm.users =  vm.users  || [
            { id: 1, name: 'Cow' },
            { id: 2, name: 'Goat' },
            { id: 3, name: 'Cat' },
            { id: 4, name: 'Hen' },
            { id: 5, name: 'Duck' }
          ];

        }, 650);
      };
    }])
    .directive('confirmPwd', function($interpolate, $parse) {
      return {
        require: 'ngModel',
        link: function(scope, elem, attr, ngModelCtrl) {

          var pwdToMatch = $parse(attr.confirmPwd);
          var pwdFn = $interpolate(attr.confirmPwd)(scope);

          scope.$watch(pwdFn, function(newVal) {
              ngModelCtrl.$setValidity('password', ngModelCtrl.$viewValue == newVal);
          })

          ngModelCtrl.$validators.password = function(modelValue, viewValue) {
            var value = modelValue || viewValue;
            return value == pwdToMatch(scope);
          };

        }
  }
});
