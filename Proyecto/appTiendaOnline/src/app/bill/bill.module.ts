import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';

import { BillRoutingModule } from './bill-routing.module';
import { BillCreateComponent } from './bill-create/bill-create.component';
import { ReactiveFormsModule } from '@angular/forms';
import { BillIndexComponent } from './bill-index/bill-index.component';

@NgModule({
  declarations: [BillCreateComponent, BillIndexComponent],
  imports: [
    CommonModule,
    BillRoutingModule,
    ReactiveFormsModule,
    BrowserModule,
  ]
})
export class BillModule { }
