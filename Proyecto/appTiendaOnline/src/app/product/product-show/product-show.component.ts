import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';


@Component({
  selector: 'app-product-show',
  templateUrl: './product-show.component.html',
  styleUrls: ['./product-show.component.css']
})
export class ProductShowComponent implements OnInit {
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
    this.obtenerProduct(id);
  }
  obtenerProduct(id: any) {
    this.gService
      .get('SmartStore/product', id)
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
