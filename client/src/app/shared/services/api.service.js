"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = require("@angular/core");
var http_1 = require("@angular/http");
var ApiService = (function () {
    function ApiService(http, router) {
        this.http = http;
        this.router = router;
        this.accessToken = localStorage.getItem('accessToken');
    }
    ApiService.prototype.request = function (route, getParams, data, type) {
        if (data === void 0) { data = {}; }
        if (!this.accessToken) {
            this.router.navigate(['login']);
            return new Promise(function (resolve, reject) {
                reject('Unloginned');
            });
        }
        route = 'http://biogenom.loc/api/' + route;
        var search = new http_1.URLSearchParams();
        search.set('access_token', this.accessToken);
        if (getParams && Object.keys(getParams).length) {
            Object.keys(getParams).forEach(function (key) {
                search.set(key, getParams[key]);
            });
        }
        var headers = new http_1.Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
        var options = new http_1.RequestOptions({ headers: headers, search: search });
        var request;
        switch (type) {
            case 'post':
                request = this.http.post(route, data, options);
                break;
            default:
                request = this.http.get(route, options);
        }
        return new Promise(function (resolve, reject) {
            request
                .subscribe(function (data) {
                console.log(data);
                resolve(data);
            }, function (error) {
                console.log(error);
                reject(error);
            });
        });
    };
    return ApiService;
}());
ApiService = __decorate([
    core_1.Injectable()
], ApiService);
exports.ApiService = ApiService;
