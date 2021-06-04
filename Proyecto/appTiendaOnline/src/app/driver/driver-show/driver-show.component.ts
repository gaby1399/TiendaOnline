import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';

@Component({
  selector: 'app-driver-show',
  templateUrl: './driver-show.component.html',
  styleUrls: ['./driver-show.component.css']
})
export class DriverShowComponent implements OnInit {
datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private gService: GenericService,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    //Obtener el id
    let id = +this.route.snapshot.paramMap.get('id');
    //Obtener
    this.obtenerDriver(id);
  }
  obtenerDriver(id: any) {
    this.gService
      .get('SmartStore/driver', id)
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        // console.log(data);
        this.datos = data;
      });
  }
  ngOnDestroy() {
    this.destroy$.next(true);
    // Desinscribirse
    this.destroy$.unsubscribe();
  }
}
