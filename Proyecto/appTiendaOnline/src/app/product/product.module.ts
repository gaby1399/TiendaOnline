import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ProductRoutingModule } from './product-routing.module';
import { ProductIndexComponent } from './product-index/product-index.component';
import { ProductAllComponent } from './product-all/product-all.component';
import { ProductShowComponent } from './product-show/product-show.component';
import { ProductCreateComponent } from './product-create/product-create.component';
import { ProductUpdateComponent } from './product-update/product-update.component';
import { ReactiveFormsModule } from '@angular/forms';//Froms

@NgModule({
  declarations: [ProductIndexComponent, ProductAllComponent, ProductShowComponent, ProductCreateComponent, ProductUpdateComponent],
  imports: [
    CommonModule,
    ProductRoutingModule,
    ReactiveFormsModule//Froms
  ]
})
export class ProductModule { }
