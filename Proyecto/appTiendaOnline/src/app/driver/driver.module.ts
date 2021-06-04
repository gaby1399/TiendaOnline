import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DriverRoutingModule } from './driver-routing.module';
import { DriverIndexComponent } from './driver-index/driver-index.component';
import { DriverAllComponent } from './driver-all/driver-all.component';
import { DriverShowComponent } from './driver-show/driver-show.component';
import { DriverCreateComponent } from './driver-create/driver-create.component';
import { DriverUpdateComponent } from './driver-update/driver-update.component';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    DriverIndexComponent,
    DriverAllComponent,
    DriverShowComponent,
    DriverCreateComponent,
    DriverUpdateComponent,
  ],
  imports: [CommonModule, DriverRoutingModule, ReactiveFormsModule],
})
export class DriverModule {}
