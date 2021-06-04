import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
@Component({
  selector: 'app-driver-all',
  templateUrl: './driver-all.component.html',
  styleUrls: ['./driver-all.component.css'],
})
export class DriverAllComponent implements OnInit {
  datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService,
    private noti:NotificacionService,
  ) {
    this.listDriverAll();
  }

  ngOnInit(): void {}
  listDriverAll() {
    this.gService
      .list('SmartStore/driver/all')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        console.log(data);
        this.datos = data;
      });
  }
  changeStatus() {
    for (let index = 0; index < 3; index++) {
      if (this.datos[index].status == 1) {
        this.datos[index].status = 'Activo';
      } else {
        this.datos[index].status = 'Desactivado';
      }
    }
  }
  ngOnDestroy() {
    this.destroy$.next(true);
    // Desinscribirse
    this.destroy$.unsubscribe();
  }
  crearDriver() {
    this.router.navigate(['/driver/create'], {
      relativeTo: this.route,
    });
  }
  updateDriver(id: number) {
    this.router.navigate(['/driver/update', id], {
      relativeTo: this.route,
    });
  }

   onCheckChange(idDriver, event) {
    if (!event.target.checked) {
     let update={state:0,id:idDriver};
      this.gService
        .create('SmartStore/driver/updateState', update)
        .subscribe((respuesta: any) => {
        });
    }
    if (event.target.checked) {
     let update={state:1,id:idDriver};
      this.gService
        .create('SmartStore/driver/updateState', update)
        .subscribe((respuesta: any) => {
        });
    }
     this.noti.mensaje('Estado','Actualizado', 'success');
  }

}
