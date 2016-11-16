/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("new Vue({\r\n    el: '#chat',\r\n    data: {\r\n        users: []\r\n    },\r\n    methods: {\r\n        connect: function() {\n            var this$1 = this;\n\r\n            Echo.join('presence_channel')\r\n                .here(function (users) {\r\n                this$1.users = users;\r\n        })\r\n            .joining(function (user) {\r\n                this$1.users.push(user);\r\n        })\r\n            .leaving(function (user) {\r\n                var index = this$1.users.map(function(usr) { return usr.id; }).indexOf(user.id);\r\n            this$1.users.splice(index, 1);\r\n        });\r\n        }\r\n    },\r\n    mounted: function()\r\n    {\r\n        this.connect();\r\n    }\r\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2NoYXQuanM/Nzc1MyJdLCJzb3VyY2VzQ29udGVudCI6WyJuZXcgVnVlKHtcclxuICAgIGVsOiAnI2NoYXQnLFxyXG4gICAgZGF0YToge1xyXG4gICAgICAgIHVzZXJzOiBbXVxyXG4gICAgfSxcclxuICAgIG1ldGhvZHM6IHtcclxuICAgICAgICBjb25uZWN0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgRWNoby5qb2luKCdwcmVzZW5jZV9jaGFubmVsJylcclxuICAgICAgICAgICAgICAgIC5oZXJlKCh1c2VycykgPT4ge1xyXG4gICAgICAgICAgICAgICAgdGhpcy51c2VycyA9IHVzZXJzO1xyXG4gICAgICAgIH0pXHJcbiAgICAgICAgICAgIC5qb2luaW5nKCh1c2VyKSA9PiB7XHJcbiAgICAgICAgICAgICAgICB0aGlzLnVzZXJzLnB1c2godXNlcik7XHJcbiAgICAgICAgfSlcclxuICAgICAgICAgICAgLmxlYXZpbmcoKHVzZXIpID0+IHtcclxuICAgICAgICAgICAgICAgIHZhciBpbmRleCA9IHRoaXMudXNlcnMubWFwKGZ1bmN0aW9uKHVzcikgeyByZXR1cm4gdXNyLmlkOyB9KS5pbmRleE9mKHVzZXIuaWQpO1xyXG4gICAgICAgICAgICB0aGlzLnVzZXJzLnNwbGljZShpbmRleCwgMSk7XHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgfVxyXG4gICAgfSxcclxuICAgIG1vdW50ZWQ6IGZ1bmN0aW9uKClcclxuICAgIHtcclxuICAgICAgICB0aGlzLmNvbm5lY3QoKTtcclxuICAgIH1cclxufSk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvY2hhdC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);