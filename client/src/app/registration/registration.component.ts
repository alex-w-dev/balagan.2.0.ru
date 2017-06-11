import {Component, OnInit, ViewChild} from '@angular/core';
import {FormGroup, FormControl, NgForm} from "@angular/forms";
import {composeAsyncValidators} from "@angular/forms/src/directives/shared";
import {Patient} from "../shared/classes/pacient";

class RegistrationPatient extends Patient {
  password: string;
  promoCode: string;

  constructor (data) {
    super(data);
  }
}

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.scss']
})
export class RegistrationComponent implements OnInit {
  districts = ['Really Smart', 'Super Flexible', 'Weather Changer'];
  birthDays: number[];
  birthMonths: string[];
  birthYears: number[];
  districtNames: string[];

  patient: RegistrationPatient = new RegistrationPatient({});

  submitted = false;

  active = true;

  registrationForm: NgForm;
  @ViewChild('registrationForm') currentForm: NgForm;

  constructor () {
    this.birthDays = [];
    for (let i = 1; i <= 31; i++) {
      this.birthDays.push(i);
    }
    this.birthYears = [];
    for (let i = 1910; i <= 2017; i++) {
      this.birthYears.push(i);
    }
    this.birthMonths = [
      'Январь',
      'Февраль',
      'Март',
      'Апрель',
      'Май',
      'Июнь',
      'Июль',
      'Август',
      'Сентябрь',
      'Октябрь',
      'Ноябрь',
      'Декабрь',
    ];
    this.districtNames = [
      'Российская Федерация',
      'Алтайский край',
      'Алейский район',
    ]
  }


  onSubmit() {
    this.submitted = true;

    console.log(this.registrationForm.form.valid);
  }

  ngAfterViewChecked() {
    this.formChanged();
  }

  formChanged() {
    if (this.currentForm === this.registrationForm) { return; }
    this.registrationForm = this.currentForm;
    if (this.registrationForm) {
      this.registrationForm.valueChanges
        .subscribe(data => this.onValueChanged(data));
    }
  }

  onValueChanged(data?: any) {
    if (!this.registrationForm) { return; }
    const form = this.registrationForm.form;

    for (const field in this.formErrors) {
      // clear previous error message (if any)
      this.formErrors[field] = '';
      const control = form.get(field);

      if (control && control.dirty && !control.valid) {
        const messages = this.validationMessages[field];
        for (const key in control.errors) {
          this.formErrors[field] += messages[key] + ' ';
        }
      }
    }
  }

  formErrors = {
    'name': '',
    'power': ''
  };

  validationMessages = {
    'name': {
      'required':      'Name is required.',
      'minlength':     'Name must be at least 4 characters long.',
      'maxlength':     'Name cannot be more than 24 characters long.',
      'forbiddenName': 'Someone named "Bob" cannot be a hero.'
    },
    'power': {
      'required': 'Power is required.'
    }
  };

  ngOnInit() {

  }

}

class Hero {
  level; name; power; alterEgo;
  constructor(level, name, power, alterEgo = '') {
    Object.assign(this, {level, name, power, alterEgo});
  }
}
