import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {MemberAreaComponent} from './member-area.component';
import {HeaderModule} from "../header/header.module";
import {LeftNavModule} from "../left-nav/left-nav.module";
import {ContentModule} from "../content/content.module";
import {MaterializeModule} from "angular2-materialize";

@NgModule({
  imports: [
    CommonModule,
    HeaderModule,
    LeftNavModule,
    ContentModule,
    MaterializeModule,
  ],
  exports: [
    MemberAreaComponent,
  ],
  declarations: [MemberAreaComponent]
})
export class MemberAreaModule {
}
