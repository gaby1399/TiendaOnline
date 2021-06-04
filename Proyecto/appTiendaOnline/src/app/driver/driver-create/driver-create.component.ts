import { Component, OnInit } from '@angular/core';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormArray,
  FormControl,
  ValidatorFn,
  AbstractControl,
  ValidationErrors,
} from '@angular/forms';
import { Subject } from 'rxjs';
import { Router } from '@angular/router';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import { takeUntil } from 'rxjs/operators';

@Component({
  selector: 'app-driver-create',
  templateUrl: './driver-create.component.html',
  styleUrls: ['./driver-create.component.css'],
})
export class DriverCreateComponent implements OnInit {
  driver: any;
  error: any;

  transportList: any;
  makeSubmit: boolean = false;
  formCreate: FormGroup;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    public fb: FormBuilder,
    private router: Router,
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {
    this.reactiveForm();
  }

  reactiveForm() {
    this.formCreate = this.fb.group({
      id: ['',
        [
          Validators.required,
          Validators.pattern('[0-9]+'),
          Validators.maxLength(9),
          Validators.minLength(9),
        ],
      ],
      name: ['', [Validators.required]],
      phone: [
        '',
        [
          Validators.required,
          Validators.pattern('[0-9]+'),
          Validators.maxLength(8),
          Validators.minLength(8),
        ],
      ],
      transport: [''],
      transport_id: [''],
    });
    this.getTransport();
  }


  listTransport() {
    this.gService
      .list('SmartStore/transport')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        console.log(data);
        this.transportList = data;
      });
  }
  getTransport() {
    return this.gService.list('SmartStore/transport').subscribe(
      (respuesta: any) => {
        this.transportList = respuesta;
        console.log(respuesta);
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }
  ngOnInit(): void {}
  /*
  getstatus() {
    return this.gService.list('driver/status').subscribe(
      (respuesta: any) => {
        (this.statusL = respuesta), this.checkboxstatus();
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }
  get status(): FormArray {
    return this.formCreate.get('status') as FormArray;
  }

  private checkboxstatus() {
    this.statusL.forEach(() => {
      const control = new FormControl(); // primer parámetro valor a asignar
      (this.formCreate.controls.status as FormArray).push(control);
    });
  }
  */
  submitForm() {
    this.makeSubmit = true;
    let formData = new FormData();
    formData = this.gService.toFormData(this.formCreate.value);
    console.log(this.formCreate.value);
    formData.append('_method', 'POST');
    this.gService
      .create_formdata('SmartStore/driver', formData)
      .subscribe((respuesta: any) => {
        this.driver = respuesta;
        this.router.navigate(['/driver/all'], {
          queryParams: { register: 'true' },
        });

      });
  }
  onReset() {
    this.formCreate.reset();
  }
  onBack() {
    this.router.navigate(['/driver/all']);
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.formCreate.controls[control].hasError(error) &&
      this.formCreate.controls[control].invalid &&
      (this.makeSubmit || this.formCreate.controls[control].touched)
    );
  };

}
