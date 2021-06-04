import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { OrderAllComponent } from './order-all/order-all.component';
import { OrderIndexComponent } from './order-index/order-index.component';
import { OrderShowComponent } from './order-show/order-show.component';
import { OrderAddComponent } from './order-add/order-add.component';
import { AuthGuardService } from '../share/auth-guard.service';
const routes: Routes = [
  { path: 'order/add', component: OrderAddComponent, canActivate:[AuthGuardService]},
  { path: 'order', component: OrderIndexComponent, canActivate:[AuthGuardService]},
  { path: 'order/all', component: OrderAllComponent, canActivate:[AuthGuardService]},
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class OrderRoutingModule { }
