import { Component, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import { CartService } from 'src/app/share/cart.service';
@Component({
  selector: 'app-product-index',
  templateUrl: './product-index.component.html',
  styleUrls: ['./product-index.component.css']
})
export class ProductIndexComponent implements OnInit {
 datos: any;
 product: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private gService: GenericService,
    private notificacion: NotificacionService,
    private cartService: CartService
  ) {
    this.listProduct();
  }

  ngOnInit(): void {}
  listProduct() {
    this.gService
      .list('SmartStore/product/')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        console.log(data);
        this.datos = data;
      });
  }
  ngOnDestroy() {
    this.destroy$.next(true);
    // Desinscribirse
    this.destroy$.unsubscribe();
  }

  agregarProduct(id: number) {
    this.gService
      .get('SmartStore/product', id)
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
         console.log(data);
        this.product = data;
        this.cartService.addToCart(this.product);
        this.notificacion.mensaje(
          'Orden',
          'Se ha agregado un producto a la orden',
          'success'
        );
      });
  }
}
