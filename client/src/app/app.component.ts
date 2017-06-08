import {Component, ViewEncapsulation} from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: [
    'app.component.scss',
    '../../node_modules/ubuntu-fontface/_ubuntu-base.scss',
  ],
  encapsulation: ViewEncapsulation.None

})
export class AppComponent {
  title = 'app';
}
