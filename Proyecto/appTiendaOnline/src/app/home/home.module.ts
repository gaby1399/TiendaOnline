import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { HomeRoutingModule } from './home-routing.module';
import { IndexComponent } from './index/index.component';
import { AboutUsComponent } from './about-us/about-us.component';


@NgModule({
  declarations: [IndexComponent, AboutUsComponent],
  imports: [
    CommonModule,
    HomeRoutingModule
  ]
})
export class HomeModule { }
