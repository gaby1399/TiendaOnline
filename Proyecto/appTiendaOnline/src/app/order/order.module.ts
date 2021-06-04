import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { OrderRoutingModule } from './order-routing.module';
import { OrderShowComponent } from './order-show/order-show.component';
import { OrderAllComponent } from './order-all/order-all.component';
import { OrderAddComponent } from './order-add/order-add.component';
import { OrderIndexComponent } from './order-index/order-index.component';


@NgModule({
  declarations: [
    OrderAddComponent,
    OrderAllComponent,OrderIndexComponent,OrderShowComponent
  ],
  imports: [CommonModule, OrderRoutingModule,FormsModule,ReactiveFormsModule],
})
export class OrderModule {}
