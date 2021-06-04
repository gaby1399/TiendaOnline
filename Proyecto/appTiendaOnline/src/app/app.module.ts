import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from "@angular/forms";
import { HttpClientModule,HTTP_INTERCEPTORS } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { CoreModule } from './core/core.module';
import { ShareModule } from './share/share.module';
import { HomeModule } from './home/home.module';
import { UserModule } from './user/user.module';
import { ProductModule } from './product/product.module';
import { DriverModule } from './driver/driver.module';
import { OrderModule } from './order/order.module';
import { HttpErrorInterceptorService } from './share/http-error-interceptor.service';
import { BillModule } from './bill/bill.module';

@NgModule({
  declarations: [
    AppComponent

  ],
  imports: [
    BrowserModule,

    HttpClientModule,

    CoreModule,
    ShareModule,
    FormsModule,
    HomeModule,
    UserModule,
    ProductModule,
    DriverModule,
    OrderModule,
    BillModule,

    AppRoutingModule,

  ],
   providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: HttpErrorInterceptorService,
      multi: true,
    },
  ],
  bootstrap: [AppComponent],

})
export class AppModule { }
