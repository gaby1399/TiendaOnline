import { Component, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-bill-index',
  templateUrl: './bill-index.component.html',
  styleUrls: ['./bill-index.component.css']
})
export class BillIndexComponent implements OnInit {
  idorder:number;
  order:any;
datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
      private router: Router,
    private gService: GenericService,
    private notificacion: NotificacionService,
   ) {
     this.listBill();
   }

  ngOnInit(): void {
  }

obtenerOrder() {
    this.gService
      .get('SmartStore/order', this.idorder)
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
         console.log(data);
        this.order = data;
      });
  }

listBill() {
    this.gService
      .list('SmartStore/bill/')
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

   onCheckChange(idfact, event) {
    if (event.target.checked) {
     let update={state:0,id:idfact};
      this.gService
        .create('SmartStore/bill/update', update)
        .subscribe((respuesta: any) => {
          this.notificacion.mensaje(
            'Factura',
            'Finalizada',
            'success'
          )
        });
     this.router.navigate(['/order']);
    }
  }
}
