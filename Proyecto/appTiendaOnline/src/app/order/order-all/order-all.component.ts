import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';

@Component({
  selector: 'app-order-all',
  templateUrl: './order-all.component.html',
  styleUrls: ['./order-all.component.css']
})
export class OrderAllComponent implements OnInit {
datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
     private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService
  ) {
    this.listOrderAll();
  }

  ngOnInit(): void {}
  listOrderAll() {
    this.gService
      .list('SmartStore/order/all')
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
