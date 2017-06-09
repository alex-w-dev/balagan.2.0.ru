import { Injectable } from '@angular/core';
import {Http, RequestOptions, Headers, URLSearchParams} from "@angular/http";
import {Router} from "@angular/router";

@Injectable()
export class ApiService {

  accessToken: string;

  constructor(
    private http: Http,
    private router: Router
  ) {
    this.accessToken = localStorage.getItem('accessToken');
  }

  request(route: string, getParams?: any, data: any = {}, type?: 'get'|'post'): Promise<any> {
    if (! this.accessToken ) {
      this.router.navigate(['login']);
      return new Promise ((resolve, reject) => {
        reject('Unloginned');
      })
    }

    route = 'http://biogenom.loc/api/' + route;

    let search = new URLSearchParams();
    search.set('access_token', this.accessToken);

    if (getParams && Object.keys(getParams).length) {
      Object.keys(getParams).forEach(key => {
        search.set(key, getParams[key]);
      });
    }


    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
    let options = new RequestOptions({ headers: headers, search: search });


    let request;
    switch (type) {
      case 'post':
        request = this.http.post(route, data, options);
        break;
      default:
        request = this.http.get(route, options);
    }


    return new Promise((resolve, reject) => {
      request
        .subscribe((data) => {
        console.log(data);
          resolve(data);
        }, (error) => {
          console.log(error);
          reject(error);
        })
    });
  }

}
