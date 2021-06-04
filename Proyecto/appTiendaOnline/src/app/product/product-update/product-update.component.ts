import { Component, OnInit } from '@angular/core';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormArray,
  FormControl,
  FormGroupName,
} from '@angular/forms';
import { Subject } from 'rxjs';
import { Router, ActivatedRoute } from '@angular/router';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';


@Component({
  selector: 'app-product-update',
  templateUrl: './product-update.component.html',
  styleUrls: ['./product-update.component.css']
})
export class ProductUpdateComponent implements OnInit {
  product: any;
  imageURl: string;
  categoryList: any;
  stateform:FormControl;
  classifiform:boolean;
  classificationList: any;
  formUpdate:FormGroup;
  /*formUpdate=this.fb.group({
        id:[''],
        description:[''],
        quantity:[''],
        price: [''],
        state:[''],
        classification:[''],
        image:[''],
  });*/
  destroy$: Subject<boolean> = new Subject<boolean>();
  makeSubmit: boolean = false;
  constructor(
    public fb: FormBuilder,
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService,
    private notificacion: NotificacionService,
  ) {
    //Desde el constructor obtener el identificar de la ruta
    const id = +this.route.snapshot.paramMap.get('id');
    this.getProduct(id);
  }

  getProduct(id: number) {
    this.gService.get('SmartStore/product', id).subscribe((respuesta: any) => {
      this.product = respuesta;
       console.log(this.product);

      this.reactiveForm();
    });
  }

  reactiveForm() {



    if (this.product) {

      this.formUpdate= this.fb.group({
        id: new FormControl([this.product.id]),
        description:new FormControl( [this.product.description]),
        quantity: new FormControl([this.product.quantity]),
        price: new FormControl([ this.product.price]),
        state:new FormControl([ this.product.state]),
        //*** Problema si se inicializa con un control, crea uno vacio
        ///*** category: this.fb.array([this.fb.control('')]),
        category: this.fb.array([]),
        category_id: this.fb.array([]),
        classification:new FormControl([this.product.classification_id]),
        image: new FormControl(['']),
      });

      this.imageURl = this.product.image;
       console.log('prod:'+this.product);

        // this.stateView();
         this.getClassification();
           this.getCategory();
       }

    }

  ngOnInit(): void {}

   getClassification() {
    return this.gService.list('SmartStore/classification').subscribe(
      (respuesta: any) => {
        (this.classificationList = respuesta);
         console.log(respuesta);
      } );
  }

  /* stateView() {
      if (this.product.state == 1) {
       (this.formUpdate.controls.state= new FormControl(true));
      }
      this.formUpdate.controls.state= new FormControl(false);
  }*/

 /* private comboClassification() {
     let selected = false;
    this.classificationList.forEach((o) => {
      if (this.product.classification_id == o.id) {
        selected = true;

      }
      const control = new FormControl(selected);
      (this.formUpdate.controls.classification= control);
      this.classifiform=selected;
    });
  }*/

  getCategory() {
    return this.gService
      .list('SmartStore/category')
      .subscribe((respuesta: any) => {
        (this.categoryList = respuesta), this.checkboxCategory();
         console.log(respuesta);
      });
  }
  get category(): FormArray {
    return this.formUpdate.get('category') as FormArray;
  }
  get category_id(): FormArray {
    return this.formUpdate.get('category_id') as FormArray;
  }



  private checkboxCategory() {
       this.categoryList.forEach((o) => {
      let selected = false;
      if (this.product.categories.find((x) => x.id == o.id)) {
        selected = true;
      }
      const control = new FormControl(selected);
      (this.formUpdate.controls.category as FormArray).push(control);

      if (selected) {
        (this.formUpdate.controls.category_id as FormArray).push(new FormControl(o.id));
      }
    });
  }

  onCheckChange(idCheck, event) {
    if (event.target.checked) {
      (this.formUpdate.controls.category_id as FormArray).push(
       new FormControl(event.target.value)
      );
    } else {
      let i = 0;
      this.category_id.controls.forEach((ctrl: FormControl) => {
        if (idCheck == ctrl.value) {
          (this.formUpdate.controls.category_id as FormArray).removeAt(i);
          return;
        }
        i++;
      });
    }
  }

  onCombobox(id:number) {
    /* seleccionado */
    if (id>0) {
      (this.formUpdate.controls.classification=
       new FormControl(id)
      );
      console.log('class: '+id);
    }
  }

  onFileSelect(event) {
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      this.formUpdate.get('image').setValue(file);
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
    formData = this.gService.toFormData(this.formUpdate.value);
    formData.append('_method', 'PATCH');
    this.gService
      .update_formdata('SmartStore/product/update', formData)
      .subscribe((respuesta: any) => {
        this.product = respuesta;
        this.router.navigate(['/product/all'], {
          queryParams: { update: 'true' },
        });
      });
  }
  onReset() {
    this.formUpdate.reset();
  }
  onBack() {
    this.router.navigate(['/product/all']);
  }
  public errorHandling = (control: string, error: string) => {
    return (
      this.formUpdate.controls[control].hasError(error) &&
      this.formUpdate.controls[control].invalid &&
      (this.makeSubmit || this.formUpdate.controls[control].touched)
    );
  };

  onState(val:number) {
      this.formUpdate.controls.state=
      new FormControl(val);
  }
}

