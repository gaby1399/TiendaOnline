import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DriverAllComponent } from './driver-all/driver-all.component';
import { DriverIndexComponent } from './driver-index/driver-index.component';
import { DriverShowComponent } from './driver-show/driver-show.component';
import { DriverCreateComponent } from './driver-create/driver-create.component';
import { DriverUpdateComponent } from './driver-update/driver-update.component';
import { AuthGuardService } from '../share/auth-guard.service';

const routes: Routes = [
  { path: 'driver', component: DriverIndexComponent, canActivate:[AuthGuardService]},
  { path: 'driver/all', component: DriverAllComponent , canActivate:[AuthGuardService]},
  { path: 'driver/create', component: DriverCreateComponent },
  { path: 'driver/update/:id', component: DriverUpdateComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class DriverRoutingModule {}
