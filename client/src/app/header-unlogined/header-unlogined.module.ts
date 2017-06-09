import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {HeaderUnloginedComponent} from './header-unlogined.component';
import {MaterializeModule} from "../materializecss/materizalizecss.module";

@NgModule({
  imports: [
    CommonModule,
  ],
  exports: [
    HeaderUnloginedComponent,
  ],
  declarations: [HeaderUnloginedComponent]
})
export class HeaderUnloginedModule { }
