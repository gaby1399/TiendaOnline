import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { CartService, ItemCart } from 'src/app/share/cart.service';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-order-add',
  templateUrl: './order-add.component.html',
  styleUrls: ['./order-add.component.css']
})
export class OrderAddComponent implements OnInit {
  items: ItemCart[] = [];
  total = 0;
  iv = 0;
  deliverycost = 0;
  date = new Date();
  time = new Date();
  qtyItems = 0;
  deliveryList: any;
  delivery=0;
  verdelivery:number;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private cartService: CartService,
    private noti: NotificacionService,
    private gService: GenericService,
    private router: Router
  ) {

  }

  ngOnInit(): void {
    this.items = this.cartService.getItems();
    this.iv=this.cartService.getTotal()*0.15;
    this.total = this.cartService.getTotal()+this.deliverycost + this.iv;
    this.cartService.countItems.subscribe((value) => {
      this.qtyItems = value;
    });
     this.listDelivery();
  }


  listDelivery() {
   return this.gService.list('SmartStore/delivery').subscribe(
      (respuesta: any) => {
        (this.deliveryList = respuesta);
         console.log(respuesta);
      } );
  }


  private impuesto(){
    let totalSin=this.total-this.deliverycost-this.iv;
    if(this.cartService.getTotal()!=totalSin){
      this.iv=this.cartService.getTotal()*0.15;
    }
  }

  actualizarCantidad(item: any) {
    this.cartService.addToCart(item);
    this.impuesto();
   this.total = this.cartService.getTotal() + this.deliverycost + this.iv;
  }

  eliminarItem(item: any) {
    this.cartService.removeFromCart(item);
     this.impuesto();
     this.total = this.cartService.getTotal() + this.deliverycost + this.iv;
    this.noti.mensaje('Orden', 'El producto ha sido eliminado de la orden', 'warning');
  }
  ordenar() {
    if (this.qtyItems > 0) {
      //let details = { details: this.cartService.getItems()};
      let details = {
        details: this.cartService.getItems(),
        total:this.total,
        cost:this.deliverycost,
        iv:this.iv,
        delivery:this.verdelivery,
      };
      this.gService
        .create('SmartStore/order', details)
        .subscribe((respuesta: any) => {
         if(this.verdelivery==1){
             this.noti.mensaje(
            'Orden',
            'Orden registrada satisfactoriamente',
            'success'
          );
         }

          if(this.verdelivery==2){
             this.noti.mensaje(
            'Orden',
            'Orden registrada y facturada satisfactoriamente',
            'success'
          );
         }
          this.items = this.cartService.getItems();
          this.impuesto();
          this.total = this.cartService.getTotal() + this.deliverycost + this.iv;
        });
    } else {
      this.noti.mensaje('Orden', 'Agregue un producto a la orden', 'warning');
    }
     this.cartService.deleteCart();
     this.cartService.getItems();
     this.cartService.countItems.subscribe((value) => {
      this.qtyItems = 0;
    });
  }

  selectDelivery() {
    this.deliverycost=0;
      this.verdelivery= this.delivery;

      console.log(this.verdelivery);

        if(this.verdelivery==1){
            this.deliverycost = 2500;
         }

    this.total = this.cartService.getTotal() + this.deliverycost + this.iv;
  }

}
