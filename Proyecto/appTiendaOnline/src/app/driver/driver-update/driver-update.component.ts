import { Component, OnInit } from '@angular/core';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormArray,
  FormControl,
} from '@angular/forms';
import { Subject } from 'rxjs';
import { Router, ActivatedRoute } from '@angular/router';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import { formatDate } from '@angular/common';

@Component({
  selector: 'app-driver-update',
  templateUrl: './driver-update.component.html',
  styleUrls: ['./driver-update.component.css'],
})
export class DriverUpdateComponent implements OnInit {
  driver: any;
  transportList: any;
  formUpdate: FormGroup;
  destroy$: Subject<boolean> = new Subject<boolean>();
  makeSubmit: boolean = false;
  constructor(
    public fb: FormBuilder,
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {
    //Desde el constructor obtener el identificar de la ruta
    const id = +this.route.snapshot.paramMap.get('id');
    this.getDriver(id);
  }
  getDriver(id: number) {
    this.gService.get('SmartStore/driver', id).subscribe((respuesta: any) => {
      this.driver = respuesta;
      //Obtenida la información del videojuego
      //se construye el formulario
      this.reactiveForm();
    });
  }
  reactiveForm() {
    //Si hay información del videojuego
    if (this.driver) {
      //Cargar la información del videojuego
      //en los controles que conforman el formulario
      this.formUpdate = this.fb.group({
        id: [this.driver.id, [Validators.required]],
        name: [this.driver.name, [Validators.required]],
        phone: [this.driver.phone, [Validators.required]],
        transport: new FormControl([this.driver.transport_id]),
      });
      this.getTransport();
    }
  }
  ngOnInit(): void {}

  getTransport() {
    return this.gService
      .list('SmartStore/transport')
      .subscribe((respuesta: any) => {
        this.transportList = respuesta;
        console.log(respuesta);
      });
  }
  submitForm() {
    this.makeSubmit = true;

    let formData = new FormData();
    formData = this.gService.toFormData(this.formUpdate.value);
    formData.append('_method', 'PATCH');
    this.gService
      .update_formdata('SmartStore/driver', formData)
      .subscribe((respuesta: any) => {
        this.driver = respuesta;
        this.router.navigate(['/driver/all'], {
          queryParams: { update: 'true' },
        });
      });
  }
  onCombobox(id: number) {
    /* seleccionado */
    if (id > 0) {
      this.formUpdate.controls.classification = new FormControl(id);
      console.log('class: ' + id);
    }
  }
  onReset() {
    this.formUpdate.reset();
  }
  onBack() {
    this.router.navigate(['/driver/all']);
  }
  public errorHandling = (control: string, error: string) => {
    return (
      this.formUpdate.controls[control].hasError(error) &&
      this.formUpdate.controls[control].invalid &&
      (this.makeSubmit || this.formUpdate.controls[control].touched)
    );
  };
}
