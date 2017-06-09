import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { MemberAreaModule } from "./member-area/member-area.module";
import { AccountComponent } from './account/account.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { LoginComponent } from './login/login.component';

@NgModule({
  declarations: [
    AppComponent,
    AccountComponent,
    PageNotFoundComponent,
    LoginComponent
  ],
  imports: [
    BrowserModule,
    MemberAreaModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
