import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuardService } from '../share/auth-guard.service';
import { BillCreateComponent } from './bill-create/bill-create.component';
import { BillIndexComponent } from './bill-index/bill-index.component';

const routes: Routes = [ { path: 'bill/:id', component: BillCreateComponent},{ path: 'bill', component: BillIndexComponent, canActivate:[AuthGuardService]}
];
@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class BillRoutingModule { }
