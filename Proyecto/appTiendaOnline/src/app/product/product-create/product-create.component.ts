import { Component, OnInit } from '@angular/core';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormArray,
  FormControl,
} from '@angular/forms';
import { Subject } from 'rxjs';
import { Router } from '@angular/router';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import { takeUntil } from 'rxjs/operators';

@Component({
  selector: 'app-product-create',
  templateUrl: './product-create.component.html',
  styleUrls: ['./product-create.component.css']
})
export class ProductCreateComponent implements OnInit {
classificationList: any;
categoriesList: any;
imageURl:string;
formCreate: FormGroup;
makeSubmit:boolean =false;
error:any;
product: any;
destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private fb:FormBuilder,
    private router: Router,
    private gService:GenericService,
    private notificacion: NotificacionService  ) {
      this.reactiveForm();
  }

  ngOnInit(): void {
  }
  reactiveForm(){
    this.formCreate = this.fb.group({
      description: ['', [Validators.required]],
      quantity: ['', [Validators.required, Validators.pattern('[0-9]+')]],
      price: ['', [Validators.required],Validators.pattern('[0-9]+')],
      state:['',[Validators.required]],
      category: this.fb.array([]),
      category_id: this.fb.array([]),
      classification:  [''],
      classification_id:  [''],
      image: [''],
    });
    this.getCategory();
   this.getClassification();
  }

  listClassification() {
    this.gService
      .list('SmartStore/classification')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        console.log(data);
        this.classificationList = data;
      });
  }

   getCategory() {
    return this.gService.list('SmartStore/category').subscribe(
      (respuesta: any) => {
        (this.categoriesList = respuesta), this.checkboxCategory();
         console.log(respuesta);
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }

   getClassification() {
    return this.gService.list('SmartStore/classification').subscribe(
      (respuesta: any) => {
        (this.classificationList = respuesta);
         console.log(respuesta);
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }

  private comboClassification() {
    this.classificationList.forEach(() => {
      const control = new FormControl(); // primer parámetro valor a asignar
      (this.formCreate.controls.classification=control);
    });
  }

    private checkboxCategory() {
    this.categoriesList.forEach(() => {
      const control = new FormControl(); // primer parámetro valor a asignar
      (this.formCreate.controls.category as FormArray).push(control);
    });
  }
  get category(): FormArray {
    return this.formCreate.get('category') as FormArray;
  }
  get category_id(): FormArray {
    return this.formCreate.get('category_id') as FormArray;
  }


 onCheckChange(idCheck, event) {
    /* seleccionado */
    if (event.target.checked) {
      // agregar un nuevo control en el array de controles de los identificadores
      (this.formCreate.controls.category_id as FormArray).push(
        new FormControl(event.target.value)
      );
    } else {
      /* Deseleccionar*/
      // Buscar el elemento que se le quito la selección
      let i = 0;

      this.category_id.controls.forEach((ctrl: FormControl) => {
        if (idCheck == ctrl.value) {
          // Quitar el elemento deseleccionado del array
          (this.formCreate.controls.category_id as FormArray).removeAt(i);
          return;
        }

        i++;
      });
    }
  }

  onCombobox(id:number) {
    /* seleccionado */
    if (id>0) {
      (this.formCreate.controls.classification=
        new FormControl(id)
      );
      console.log('class: '+id);
    }
  }

 onState(val:number) {
      this.formCreate.controls.state=
      new FormControl(val);
  }

   onFileSelect(event) {
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      this.formCreate.get('image').setValue(file);
      // Vista previa imagen
      const reader = new FileReader();
      reader.onload = () => {
        this.imageURl = reader.result as string;
      };
      reader.readAsDataURL(file);
    }
  }

submitForm() {
    this.makeSubmit = true;

    let formData = new FormData();
    formData = this.gService.toFormData(this.formCreate.value);
    formData.append('_method', 'POST');
    this.gService.create_formdata('SmartStore/product/create', formData).subscribe((respuesta: any) => {
        this.product = respuesta;
        this.router.navigate(['/product/all'], {
          queryParams: { register: 'true' },
        });
         
      });
  }

   onReset() {
    this.formCreate.reset();//limpia todo
  }
  onBack() {
    this.router.navigate(['/product/all']);//regresa a la pagina anterior
  }

   public errorHandling = (control: string, error: string) => {
    return (
      this.formCreate.controls[control].hasError(error) &&
      this.formCreate.controls[control].invalid &&
      (this.makeSubmit || this.formCreate.controls[control].touched)
    );
  };

}
