import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RegistrationComponent } from './registration.component';
import {DirectivesModule} from "../shared/modules/directives.module";
import {FormsModule} from "@angular/forms";

@NgModule({
  imports: [
    CommonModule,
    DirectivesModule,
    FormsModule,
  ],
  exports: [
    RegistrationComponent,
  ],
  declarations: [RegistrationComponent]
})
export class RegistrationModule { }
