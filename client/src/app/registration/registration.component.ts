import {Component, OnInit, ViewChild} from '@angular/core';
import {FormGroup, FormControl, NgForm} from "@angular/forms";
import {composeAsyncValidators} from "@angular/forms/src/directives/shared";
import {Patient} from "../shared/classes/pacient";

class RegistrationPatient extends Patient {
    password: string;
    promoCode: string;

    constructor(data) {
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

    firstFormChecked: boolean = false;

    patient: RegistrationPatient = new RegistrationPatient({});

    submitted = false;

    active = true;

    /* example : {fio: 'Fio is required'} */
    formErrors = {};

    validationMessages = {
        'fio': {
            'required': 'Fio is required.',
            'minlength': 'Fio must be at least 4 characters long.',
            'maxlength': 'Fio cannot be more than 24 characters long.',
        },
        'email': {
            'required': 'E-Mail is required.'
        },
        'phone': {
            'required': 'phone is required.'
        },
        'birthDay': {
            'required': 'birthDay is required.'
        },
        'birthMonth': {
            'required': 'birthMonth is required.'
        },
        'birthYear': {
            'required': 'birthYear is required.'
        },
        'male': {
            'required': 'male is required.'
        },
        'district_name': {
            'required': 'district_name is required.'
        },
        'password': {
            'required': 'password is required.'
        }
    };

    registrationForm: NgForm;
    @ViewChild('registrationForm') currentForm: NgForm;

    constructor() {
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
        this.onValueChanged();

        this.submitted = true;

        console.log(this.registrationForm.form.valid);
    }

    ngAfterViewChecked() {
        this.formChanged();
    }

    formChanged() {
        this.firstFormChecked = true;

        if (this.currentForm === this.registrationForm) {
            return;
        }
        this.registrationForm = this.currentForm;
    }

    onValueChanged(data?: any) {
        if (!this.registrationForm) {
            return;
        }
        const form = this.registrationForm.form;

        for (const field in this.validationMessages) {
            // clear previous error message (if any)
            this.formErrors[field] = '';
            const control = form.get(field);

            if (control && !control.valid) {
                const messages = this.validationMessages[field];
                for (const key in control.errors) {
                    this.formErrors[field] += messages[key] + ' ';
                }
            }
        }
    }

    ngOnInit() {

    }

}