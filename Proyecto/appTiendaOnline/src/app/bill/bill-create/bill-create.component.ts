import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, SelectControlValueAccessor, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-bill-create',
  templateUrl: './bill-create.component.html',
  styleUrls: ['./bill-create.component.css']
})
export class BillCreateComponent implements OnInit {
  order: any;
  bill: any;
  date= new Date();
  formCreate=this.fb.group({
     userId:  [''],
      orderId:  [''],
      total:  [''],
      driver:  [''],
  });
  driverlist:any;
  makeSubmit:boolean =false;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    public fb: FormBuilder,
    private router: Router,
    private notificacion: NotificacionService,
    private gService: GenericService,
    private route: ActivatedRoute
  ) {const id = +this.route.snapshot.paramMap.get('id');
    //Obtener
    this.obtenerOrder(id); }

  ngOnInit(): void {}

  obtenerOrder(id: any) {
    this.gService
      .get('SmartStore/order', id)
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
         console.log(data);
        this.order = data;

          this.reactiveForm();
      });

  }

   reactiveForm() {
      this.formCreate= this.fb.group({
      userId:new FormControl([this.order.user_id]),
      orderId: new FormControl([this.order.id]),
      total: new FormControl([this.order.subtotal]),
      driver:  ['', [Validators.required, Validators.pattern('[0-9]+')]],
    });
         this.getDriver();
    }


  getDriver() {
    return this.gService.list('SmartStore/driver').subscribe(
      (respuesta: any) => {
        (this.driverlist = respuesta);
         console.log(respuesta);
      } );
  }

  onCombobox(id:number) {
    /* seleccionado */
    if (id>0) {
      (this.formCreate.controls.driver=
       new FormControl(id)
      );
      console.log('driver: '+id);
    }
  }

  ngOnDestroy() {
    this.destroy$.next(true);
    // Desinscribirse
    this.destroy$.unsubscribe();
  }

  submitForm() {
    this.makeSubmit = true;

    let formData = new FormData();
    formData = this.gService.toFormData(this.formCreate.value);
    formData.append('_method', 'POST');
    this.gService.create_formdata('SmartStore/bill/create', formData).subscribe((respuesta: any) => {
        this.bill = respuesta;
        this.notificacion.mensaje('Finalizado','Facturado con exito', 'success');
         this.router.navigate(['/order'], {
          queryParams: { register: 'true' },
        });
      });
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.formCreate.controls[control].hasError(error) &&
      this.formCreate.controls[control].invalid &&
      (this.makeSubmit || this.formCreate.controls[control].touched)
    );
  };

}
