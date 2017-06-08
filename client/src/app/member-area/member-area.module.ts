import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {MemberAreaComponent} from './member-area.component';
import {HeaderModule} from "../header/header.module";
import {LeftNavModule} from "../left-nav/left-nav.module";
import {ContentModule} from "../content/content.module";
import {FooterModule} from "../footer/footer.module";
import {MaterializeModule} from "../materializecss/materizalizecss.module";


@NgModule({
  imports: [
    CommonModule,
    HeaderModule,
    LeftNavModule,
    ContentModule,
    FooterModule,
    MaterializeModule
  ],
  exports: [
    MemberAreaComponent,
  ],
  declarations: [MemberAreaComponent]
})
export class MemberAreaModule {
}
