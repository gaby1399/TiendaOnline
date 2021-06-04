import { Component, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-driver-index',
  templateUrl: './driver-index.component.html',
  styleUrls: ['./driver-index.component.css']
})
export class DriverIndexComponent implements OnInit {
datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {
    this.listDriver();
  }

  ngOnInit(): void {}
  listDriver() {
    this.gService
      .list('SmartStore/driver/')
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
}
